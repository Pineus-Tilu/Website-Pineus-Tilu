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

    // Inisialisasi flatpickr untuk tanggal kunjungan
    let fp = flatpickr("#tanggal-kunjungan", {
        minDate: "today",
        disable: [],
        dateFormat: "Y-m-d",
        allowInput: false,
    });

    // Fungsi untuk mengupdate pilihan deck
    function updateDeckOptions() {
        if (!fasilitasSelect) return;
        
        const selected = fasilitasSelect.value;
        const units = areaUnits[selected] || [];
        
        if (units.length > 0) {
            deckSelect.innerHTML = units
                .map(
                    (u) =>
                        `<option value="${u.unit_name}">${u.unit_name}</option>`
                )
                .join("");
            deckContainer.classList.remove("hidden");
            deckSelect.required = true;
        } else {
            deckSelect.innerHTML = "";
            deckContainer.classList.add("hidden");
            deckSelect.required = false;
        }
        
        if (tanggalInput) tanggalInput.value = "";
        updateDisabledDates();
        updateMaxPeople();
        updateHarga();
        updateDetailReservasi();
    }

    // Fungsi untuk mengupdate tanggal yang tidak bisa dipilih
    function updateDisabledDates() {
        if (!deckSelect || !fp) return;
        
        const deck = deckSelect.value;
        const booked = bookedDates?.[deck] || [];
        fp.set("disable", booked);
        
        if (tanggalInput) tanggalInput.value = "";
    }

    // Fungsi untuk mengupdate maksimal jumlah orang
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

    // Fungsi untuk menentukan musim berdasarkan tanggal
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

    // Fungsi untuk mengupdate harga
    function updateHarga() {
        const fasilitas = fasilitasSelect ? fasilitasSelect.value : "";
        const deck = deckSelect ? deckSelect.value : "";
        const tanggal = tanggalInput ? tanggalInput.value : "";
        const season = getSeason(tanggal);
        const jumlah = jumlahOrangInput ? parseInt(jumlahOrangInput.value) || 1 : 1;

        let harga = 0,
            defaultPeople = 1,
            extra = 0;
            
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
        
        // Update hidden input untuk total harga
        const totalHargaInput = document.getElementById("total-harga-input");
        if (totalHargaInput) totalHargaInput.value = total;
        
        // Update detail reservasi
        updateDetailReservasi();
    }

    // Fungsi untuk mengupdate detail reservasi
    function updateDetailReservasi() {
        // Update tanggal check-in dan check-out
        const tanggalKunjungan = tanggalInput ? tanggalInput.value : "";
        const detailCheckin = document.getElementById('detail-checkin');
        const detailCheckout = document.getElementById('detail-checkout');
        
        if (detailCheckin) detailCheckin.textContent = tanggalKunjungan || '-';
        
        // Check-out sehari setelah check-in
        if (tanggalKunjungan && detailCheckout) {
            const checkinDate = new Date(tanggalKunjungan);
            const checkoutDate = new Date(checkinDate);
            checkoutDate.setDate(checkinDate.getDate() + 1);
            
            const checkoutStr = checkoutDate.toISOString().split('T')[0];
            detailCheckout.textContent = checkoutStr;
        } else if (detailCheckout) {
            detailCheckout.textContent = '-';
        }
        
        // Update area
        const area = fasilitasSelect ? fasilitasSelect.value : "";
        const detailArea = document.getElementById('detail-area');
        if (detailArea) detailArea.textContent = area || '-';
        
        // Update deck
        const deck = deckSelect ? deckSelect.value : "";
        const detailDeck = document.getElementById('detail-deck');
        if (detailDeck) detailDeck.textContent = deck || '-';
        
        // Update jumlah orang
        const jumlah = jumlahOrangInput ? jumlahOrangInput.value : "";
        const detailJumlah = document.getElementById('detail-jumlah');
        if (detailJumlah) detailJumlah.textContent = jumlah || '-';
        
        // Update data pengunjung
        const nama = namaInput ? namaInput.value : "";
        const detailNama = document.getElementById('detail-nama');
        if (detailNama) detailNama.textContent = nama || '-';
        
        const telepon = teleponInput ? teleponInput.value : "";
        const detailTelepon = document.getElementById('detail-telepon');
        if (detailTelepon) detailTelepon.textContent = telepon || '-';
        
        const email = emailInput ? emailInput.value : "";
        const detailEmail = document.getElementById('detail-email');
        if (detailEmail) detailEmail.textContent = email || '-';
        
        // Update harga
        updateHargaDetail();
    }
    
    // Fungsi untuk mengupdate harga di detail
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
        
        // Update hidden input
        const totalHargaInput = document.getElementById("total-harga-input");
        if (totalHargaInput) totalHargaInput.value = total;
    }

    // Event listeners
    if (fasilitasSelect) {
        fasilitasSelect.addEventListener("change", updateDeckOptions);
    }
    
    if (deckSelect) {
        deckSelect.addEventListener("change", function () {
            updateDisabledDates();
            updateMaxPeople();
            updateHarga();
        });
    }
    
    if (tanggalInput) {
        tanggalInput.addEventListener("change", updateHarga);
        tanggalInput.addEventListener("keydown", function (e) {
            e.preventDefault();
        });
    }

    // Event listeners untuk plus/minus jumlah orang
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

    // Event listeners untuk input pengunjung
    if (namaInput) namaInput.addEventListener('input', updateDetailReservasi);
    if (teleponInput) teleponInput.addEventListener('input', updateDetailReservasi);
    if (emailInput) emailInput.addEventListener('input', updateDetailReservasi);

    // Validasi form saat submit
    if (form) {
        form.addEventListener("submit", function (e) {
            const deck = deckSelect ? deckSelect.value : "";
            const tanggal = tanggalInput ? tanggalInput.value : "";
            const booked = bookedDates?.[deck] || [];
            
            if (booked.includes(tanggal)) {
                alert("Tanggal ini sudah dipesan untuk deck tersebut. Silakan pilih tanggal lain.");
                if (tanggalInput) tanggalInput.value = "";
                e.preventDefault();
                return;
            }
            
            // Validasi form lengkap
            if (!fasilitasSelect.value || !deckSelect.value || !tanggalInput.value) {
                alert("Mohon lengkapi semua data reservasi.");
                e.preventDefault();
                return;
            }

            // Validasi total harga
            const totalHarga = document.getElementById("total-harga-input").value;
            if (!totalHarga || totalHarga <= 0) {
                alert("Terjadi kesalahan dalam kalkulasi harga. Mohon refresh halaman dan coba lagi.");
                e.preventDefault();
                return;
            }

            // Tampilkan loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = "Memproses...";
            }
        });
    }

    // Inisialisasi awal
    updateDeckOptions();
    updateDisabledDates();
    updateMaxPeople();
    updateHarga();
    updateDetailReservasi();
});
