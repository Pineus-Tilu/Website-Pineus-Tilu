document.addEventListener("DOMContentLoaded", function () {
    const fasilitasSelect = document.getElementById("fasilitas-select");
    const deckContainer = document.getElementById("deck-container");
    const deckSelect = document.getElementById("deck-select");
    const tanggalInput = document.getElementById("tanggal-kunjungan");
    const jumlahOrangInput = document.getElementById("jumlah-orang");
    const minusBtn = document.getElementById("minus-btn");
    const plusBtn = document.getElementById("plus-btn");
    const namaInput = document.getElementById('nama-input');
    const teleponInput = document.getElementById('telepon-input');
    const emailInput = document.getElementById('email-input');
    const form = document.getElementById('reservasi-form');
    
    const areaUnits = window.areaUnits || {};
    const bookedDates = window.bookedDates || {};
    const prices = window.prices || {};

    // Waktu dan tanggal setup
    const now = new Date();
    const currentHour = now.getHours();
    const today = new Date().toLocaleDateString('en-CA');
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    const tomorrowDate = tomorrow.toLocaleDateString('en-CA');
    
    const minDate = currentHour >= 12 ? tomorrowDate : today;
    const isPastCutoff = currentHour >= 12;

    // Fungsi untuk mendapatkan tanggal yang sudah dibooking
    function getCurrentDisabledDates() {
        const currentArea = fasilitasSelect ? fasilitasSelect.value : "";
        const currentDeck = deckSelect ? deckSelect.value : "";
        let disabledDates = [];
        
        if (currentArea && currentDeck) {
            const uniqueKey = currentArea + " - " + currentDeck;
            
            if (bookedDates.hasOwnProperty(uniqueKey)) {
                disabledDates = [...bookedDates[uniqueKey]];
            }
        }
        
        return [...new Set(disabledDates)].sort();
    }

    // Global reference untuk disabled dates
    let currentDisabledDates = [];

    // Inisialisasi flatpickr
    let fp = flatpickr("#tanggal-kunjungan", {
        minDate: minDate,
        dateFormat: "Y-m-d",
        allowInput: false,
        clickOpens: false,
        enableTime: false,
        disableMobile: true,
        onReady: function() {
            addValidationMessage();
        },
        onChange: function(selectedDates, dateStr) {
            updateHarga();
        },
        disable: [
            function(date) {
                const dateStr = date.toLocaleDateString('en-CA');
                const currentArea = fasilitasSelect ? fasilitasSelect.value : "";
                const currentDeck = deckSelect ? deckSelect.value : "";
                
                // Disable jika area/deck belum dipilih
                if (!currentArea || !currentDeck) {
                    return true;
                }
                
                // Disable hanya jika tanggal sudah dibooking
                return currentDisabledDates.includes(dateStr);
            }
        ],
        // ✅ Kembalikan styling untuk tanggal yang disabled
        onDayCreate: function(dObj, dStr, fp, dayElem) {
            const year = dayElem.dateObj.getFullYear();
            const month = String(dayElem.dateObj.getMonth() + 1).padStart(2, '0');
            const day = String(dayElem.dateObj.getDate()).padStart(2, '0');
            const dateStr = `${year}-${month}-${day}`;
            
            // Jika tanggal ini disabled karena sudah dibooking
            if (currentDisabledDates.includes(dateStr)) {
                // Tambahkan styling merah untuk tanggal yang sudah dibooking
                dayElem.style.backgroundColor = '#fecaca'; // bg-red-200
                dayElem.style.color = '#dc2626'; // text-red-600
                dayElem.style.fontWeight = 'bold';
                dayElem.style.cursor = 'not-allowed';
                dayElem.classList.add('booked-date');
                
                // Tambahkan tooltip atau pesan saat hover
                dayElem.title = `Tanggal ${dateStr} sudah dipesan`;
                
                // Event listener untuk pesan saat diklik
                dayElem.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    alert(`❌ Tanggal ${dateStr} sudah dipesan. Silakan pilih tanggal lain.`);
                }, true);
            }
        }
    });

    // Fungsi validasi message
    function addValidationMessage() {
        const existingMessage = document.getElementById('tanggal-validation-message');
        if (existingMessage) {
            existingMessage.remove();
        }
        
        const messageDiv = document.createElement('div');
        messageDiv.id = 'tanggal-validation-message';
        messageDiv.className = 'mt-1 text-sm text-red-600 font-typewriter';
        messageDiv.innerHTML = '⚠️ Pilih area dan deck terlebih dahulu sebelum memilih tanggal';
        tanggalInput.parentNode.appendChild(messageDiv);
    }

    function removeValidationMessage() {
        const messageDiv = document.getElementById('tanggal-validation-message');
        if (messageDiv) {
            messageDiv.remove();
        }
    }

    // Toggle date input
    function toggleDateInput() {
        const area = fasilitasSelect ? fasilitasSelect.value : "";
        const deck = deckSelect ? deckSelect.value : "";
        
        if (area && deck && deck !== "") {
            fp.set('clickOpens', true);
            tanggalInput.disabled = false;
            tanggalInput.classList.remove('bg-gray-100', 'cursor-not-allowed');
            tanggalInput.classList.add('cursor-pointer', 'bg-white');
            tanggalInput.placeholder = 'Klik untuk memilih tanggal';
            removeValidationMessage();
            fp.set('minDate', minDate);
        } else {
            fp.set('clickOpens', false);
            tanggalInput.disabled = true;
            tanggalInput.classList.add('bg-gray-100', 'cursor-not-allowed');
            tanggalInput.classList.remove('cursor-pointer', 'bg-white');
            tanggalInput.placeholder = 'Pilih area dan deck terlebih dahulu';
            tanggalInput.value = "";
            addValidationMessage();
        }
    }

    // Update deck options
    function updateDeckOptions() {
        if (!fasilitasSelect) return;
        
        const selected = fasilitasSelect.value;
        const units = areaUnits[selected] || [];
        
        if (selected) {
            deckContainer.classList.remove("hidden");
            deckSelect.required = true;
            
            if (units.length > 0) {
                deckSelect.innerHTML = '<option value="" disabled selected>Pilih Deck</option>' + 
                    units.map(u => `<option value="${u.unit_name}">${u.unit_name}</option>`).join("");
            } else {
                deckSelect.innerHTML = '<option value="" disabled selected>Tidak ada deck tersedia</option>';
            }
        } else {
            deckContainer.classList.add("hidden");
            deckSelect.required = false;
            deckSelect.innerHTML = '<option value="" disabled selected>Pilih Deck</option>';
        }
        
        deckSelect.selectedIndex = 0;
        
        toggleDateInput();
        updateDisabledDates();
        updateMaxPeople();
        updateHarga();
        updateDetailReservasi();
    }

    // Update disabled dates
    function updateDisabledDates() {
        const area = fasilitasSelect ? fasilitasSelect.value : "";
        const deck = deckSelect ? deckSelect.value : "";
        
        // Clear tanggal input
        if (tanggalInput) tanggalInput.value = "";
        
        // Update disabled dates
        currentDisabledDates = getCurrentDisabledDates();
        
        // Force redraw calendar
        setTimeout(() => {
            fp.redraw();
        }, 100);
        
        // Update info message
        updateInfoMessage(area, deck);
    }

    function updateInfoMessage(area, deck) {
        const debugInfo = document.getElementById('debug-info');
        if (debugInfo) debugInfo.remove();
        
        if (area && deck) {
            const debugDiv = document.createElement('div');
            debugDiv.id = 'debug-info';
            debugDiv.className = 'mt-1 text-xs text-blue-600 font-typewriter';
            
            if (isPastCutoff) {
                debugDiv.innerHTML = `⏰ Pemesanan hari ini sudah ditutup (lewat jam 12:00). Minimum tanggal: ${tomorrowDate}`;
            } else if (currentDisabledDates.length > 0) {
                debugDiv.innerHTML = `🔍 Beberapa tanggal sudah terisi untuk ${area} - ${deck}`;
            } else {
                debugDiv.innerHTML = `✅ Semua tanggal tersedia untuk ${area} - ${deck}`;
            }
            
            tanggalInput.parentNode.appendChild(debugDiv);
        }
    }

    // Update max people
    function updateMaxPeople() {
        if (!fasilitasSelect || !deckSelect || !jumlahOrangInput) return;
        
        const fasilitas = fasilitasSelect.value;
        const deck = deckSelect.value;
        let maxPeople = 10;
        
        if (fasilitas && deck && prices?.[fasilitas]?.[deck]) {
            maxPeople = prices[fasilitas][deck].max_people || 10;
        }
        
        jumlahOrangInput.max = maxPeople;
        if (parseInt(jumlahOrangInput.value) > maxPeople) {
            jumlahOrangInput.value = maxPeople;
        }
    }

    // Season calculation
    function getSeason(dateStr) {
        if (!dateStr) return "weekday";
        
        const [year, month, day] = dateStr.split("-").map(Number);
        const d = new Date(year, month - 1, day);
        const highseasonStart = new Date(year, 5, 20);
        const highseasonEnd = new Date(year, 6, 10);
        
        if (d >= highseasonStart && d <= highseasonEnd) return "highseason";
        
        const dayOfWeek = d.getDay();
        if (dayOfWeek === 5 || dayOfWeek === 6) return "weekend";
        
        return "weekday";
    }

    // Update harga
    function updateHarga() {
        const fasilitas = fasilitasSelect ? fasilitasSelect.value : "";
        const deck = deckSelect ? deckSelect.value : "";
        const tanggal = tanggalInput ? tanggalInput.value : "";
        const season = getSeason(tanggal);
        const jumlah = jumlahOrangInput ? parseInt(jumlahOrangInput.value) || 1 : 1;

        let harga = 0, defaultPeople = 1, extra = 0;
            
        if (fasilitas && deck && tanggal && prices?.[fasilitas]?.[deck]) {
            const priceData = prices[fasilitas][deck];
            harga = priceData[season] || 0;
            defaultPeople = priceData.default_people || 1;
            extra = priceData.extra_charge || 0;
        }
        
        let extraTotal = 0;
        if (jumlah > defaultPeople) {
            extraTotal = (jumlah - defaultPeople) * extra;
        }
        
        let total = harga + extraTotal;
        
        const totalHargaInput = document.getElementById("total-harga-input");
        if (totalHargaInput) totalHargaInput.value = total;
        
        updateDetailReservasi();
    }

    // Update detail reservasi
    function updateDetailReservasi() {
        const tanggalKunjungan = tanggalInput ? tanggalInput.value : "";
        const detailCheckin = document.getElementById('detail-checkin');
        const detailCheckout = document.getElementById('detail-checkout');
        
        if (detailCheckin) detailCheckin.textContent = tanggalKunjungan || '-';
        
        if (tanggalKunjungan && detailCheckout) {
            const checkinDate = new Date(tanggalKunjungan);
            const checkoutDate = new Date(checkinDate);
            checkoutDate.setDate(checkinDate.getDate() + 1);
            
            const checkoutStr = checkoutDate.toLocaleDateString('en-CA');
            detailCheckout.textContent = checkoutStr;
        } else if (detailCheckout) {
            detailCheckout.textContent = '-';
        }
        
        // Update other details
        const area = fasilitasSelect ? fasilitasSelect.value : "";
        const detailArea = document.getElementById('detail-area');
        if (detailArea) detailArea.textContent = area || '-';
        
        const deck = deckSelect ? deckSelect.value : "";
        const detailDeck = document.getElementById('detail-deck');
        if (detailDeck) detailDeck.textContent = deck || '-';
        
        const jumlah = jumlahOrangInput ? jumlahOrangInput.value : "";
        const detailJumlah = document.getElementById('detail-jumlah');
        if (detailJumlah) detailJumlah.textContent = jumlah || '-';
        
        const nama = namaInput ? namaInput.value : "";
        const detailNama = document.getElementById('detail-nama');
        if (detailNama) detailNama.textContent = nama || '-';
        
        const telepon = teleponInput ? teleponInput.value : "";
        const detailTelepon = document.getElementById('detail-telepon');
        if (detailTelepon) detailTelepon.textContent = telepon || '-';
        
        const email = emailInput ? emailInput.value : "";
        const detailEmail = document.getElementById('detail-email');
        if (detailEmail) detailEmail.textContent = email || '-';
        
        updateHargaDetail();
    }
    
    function updateHargaDetail() {
        const fasilitas = fasilitasSelect ? fasilitasSelect.value : "";
        const deck = deckSelect ? deckSelect.value : "";
        const tanggal = tanggalInput ? tanggalInput.value : "";
        const jumlah = jumlahOrangInput ? parseInt(jumlahOrangInput.value) || 1 : 1;
        
        const hargaDasar = document.getElementById('harga-dasar');
        const tambahanHarga = document.getElementById('tambahan-harga');
        const totalHarga = document.getElementById('total-harga');
        
        if (!fasilitas || !deck || !tanggal) {
            if (hargaDasar) hargaDasar.textContent = 'Rp 0';
            if (tambahanHarga) tambahanHarga.textContent = 'Rp 0';
            if (totalHarga) totalHarga.textContent = 'Rp 0';
            return;
        }
        
        const season = getSeason(tanggal);
        let harga = 0, defaultPeople = 1, extra = 0;
        
        if (prices && prices[fasilitas] && prices[fasilitas][deck]) {
            const priceData = prices[fasilitas][deck];
            harga = priceData[season] || 0;
            defaultPeople = priceData.default_people || 1;
            extra = priceData.extra_charge || 0;
        }
        
        let extraTotal = 0;
        if (jumlah > defaultPeople) {
            extraTotal = (jumlah - defaultPeople) * extra;
        }
        
        let total = harga + extraTotal;
        
        if (hargaDasar) hargaDasar.textContent = 'Rp ' + harga.toLocaleString('id-ID');
        if (tambahanHarga) tambahanHarga.textContent = 'Rp ' + extraTotal.toLocaleString('id-ID');
        if (totalHarga) totalHarga.textContent = 'Rp ' + total.toLocaleString('id-ID');
        
        const totalHargaInput = document.getElementById("total-harga-input");
        if (totalHargaInput) totalHargaInput.value = total;
    }

    // Event listeners
    if (fasilitasSelect) {
        fasilitasSelect.addEventListener("change", function() {
            updateDeckOptions();
        });
    }
    
    if (deckSelect) {
        deckSelect.addEventListener("change", function () {
            toggleDateInput();
            updateDisabledDates();
            updateMaxPeople();
            updateHarga();
        });
    }
    
    if (tanggalInput) {
        tanggalInput.addEventListener("keydown", function (e) {
            e.preventDefault();
        });
        
        tanggalInput.addEventListener("click", function(e) {
            const area = fasilitasSelect ? fasilitasSelect.value : "";
            const deck = deckSelect ? deckSelect.value : "";
            
            if (!area) {
                alert("❌ Silakan pilih area terlebih dahulu");
                e.preventDefault();
                return false;
            }
            
            if (!deck) {
                alert("❌ Silakan pilih deck terlebih dahulu");
                e.preventDefault();
                return false;
            }
        });
    }

    // Plus/minus buttons
    if (minusBtn && plusBtn && jumlahOrangInput) {
        plusBtn.addEventListener("click", function() {
            let max = parseInt(jumlahOrangInput.max) || 10;
            if (parseInt(jumlahOrangInput.value) < max) {
                jumlahOrangInput.value = parseInt(jumlahOrangInput.value) + 1;
                updateHarga();
            }
        });
        
        minusBtn.addEventListener("click", function() {
            if (parseInt(jumlahOrangInput.value) > 1) {
                jumlahOrangInput.value = parseInt(jumlahOrangInput.value) - 1;
                updateHarga();
            }
        });
        
        jumlahOrangInput.addEventListener("input", updateHarga);
    }

    // Input listeners
    if (namaInput) namaInput.addEventListener('input', updateDetailReservasi);
    if (teleponInput) teleponInput.addEventListener('input', updateDetailReservasi);
    if (emailInput) emailInput.addEventListener('input', updateDetailReservasi);

    // Form validation
    if (form) {
        form.addEventListener("submit", function (e) {
            const area = fasilitasSelect ? fasilitasSelect.value : "";
            const deck = deckSelect ? deckSelect.value : "";
            const tanggal = tanggalInput ? tanggalInput.value : "";
            
            if (!area || !deck || !tanggal) {
                alert("❌ Mohon lengkapi semua field yang diperlukan.");
                e.preventDefault();
                return;
            }
            
            // Check cut-off time
            if (tanggal === today && isPastCutoff) {
                alert("❌ Pemesanan untuk hari ini sudah ditutup (lewat jam 12:00). Silakan pilih tanggal besok atau setelahnya.");
                e.preventDefault();
                return;
            }
            
            // Check if date is booked
            if (currentDisabledDates.includes(tanggal)) {
                alert(`❌ Tanggal ${tanggal} sudah dipesan untuk ${area} - ${deck}. Silakan pilih tanggal lain.`);
                e.preventDefault();
                return;
            }

            const totalHarga = document.getElementById("total-harga-input").value;
            if (!totalHarga || totalHarga <= 0) {
                alert("❌ Terjadi kesalahan dalam kalkulasi harga. Mohon refresh halaman dan coba lagi.");
                e.preventDefault();
                return;
            }

            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = "Memproses...";
                
                setTimeout(() => {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = "Pesan Sekarang";
                    }
                }, 10000);
            }
        });
    }

    // Initialize
    updateDeckOptions();
    toggleDateInput();
    updateDisabledDates();
    updateMaxPeople();
    updateHarga();
    updateDetailReservasi();
});
