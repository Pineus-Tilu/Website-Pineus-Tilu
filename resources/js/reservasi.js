document.addEventListener("DOMContentLoaded", function () {
    const fasilitasSelect = document.getElementById("fasilitas-select");
    const deckContainer = document.getElementById("deck-container");
    const deckSelect = document.getElementById("deck-select");
    const tanggalInput = document.getElementById("tanggal-kunjungan");
    const areaUnits = window.areaUnits || {};
    const bookedDates = window.bookedDates || {};

    // Inisialisasi flatpickr untuk tanggal kunjungan
    let fp = flatpickr("#tanggal-kunjungan", {
        minDate: "today",
        disable: [],
        dateFormat: "Y-m-d",
        allowInput: false,
    });

    function updateDeckOptions() {
        if (!fasilitasSelect) return; // Cegah error jika elemen tidak ada
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
        tanggalInput.value = "";
        updateDisabledDates();
        updateMaxPeople();
        updateHarga();
    }

    function updateDisabledDates() {
        if (!deckSelect) return; // Cegah error jika elemen tidak ada
        const deck = deckSelect.value;
        const booked = bookedDates?.[deck] || [];
        fp.set("disable", booked);
        if (tanggalInput) tanggalInput.value = "";
    }

    function updateMaxPeople() {
        if (!fasilitasSelect || !deckSelect) return;
        const fasilitas = fasilitasSelect.value;
        const deck = deckSelect.value;
        const jumlahOrangInput = document.getElementById("jumlah-orang");
        let maxPeople = 10;
        if (fasilitas && deck && window.prices?.[fasilitas]?.[deck]) {
            maxPeople = window.prices[fasilitas][deck].max_people || 10;
        }
        jumlahOrangInput.max = maxPeople;
        if (parseInt(jumlahOrangInput.value) > maxPeople) {
            jumlahOrangInput.value = maxPeople;
        }
    }

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

    function updateHarga() {
        const fasilitas = fasilitasSelect ? fasilitasSelect.value : "";
        const deck = deckSelect ? deckSelect.value : "";
        const tanggal = tanggalInput ? tanggalInput.value : "";
        const season = getSeason(tanggal);

        const jumlahOrangInput = document.getElementById("jumlah-orang");
        const jumlah = jumlahOrangInput ? parseInt(jumlahOrangInput.value) || 1 : 1;

        let harga = 0,
            defaultPeople = 1,
            extra = 0;
        if (
            fasilitas &&
            deck &&
            tanggal &&
            window.prices?.[fasilitas]?.[deck]
        ) {
            const priceData = window.prices[fasilitas][deck];
            harga = priceData[season] || 0;
            defaultPeople = priceData.default_people || 1;
            extra = priceData.extra_charge || 0;
        }
        let extraTotal = 0;
        if (jumlah > defaultPeople) {
            extraTotal = (jumlah - defaultPeople) * extra;
        }
        let total = harga + extraTotal;
        const hargaDeckInput = document.getElementById("harga_deck");
        if (hargaDeckInput) hargaDeckInput.value = total;
        const tambahanHarga = document.getElementById("tambahan-harga");
        if (tambahanHarga) tambahanHarga.innerText = "Rp " + extraTotal.toLocaleString("id-ID");
        const totalHarga = document.getElementById("total-harga");
        if (totalHarga) totalHarga.innerHTML =
            '<span class="font-semibold">Total</span><br>Rp ' +
            total.toLocaleString("id-ID");
    }

    // Event listeners
    if (fasilitasSelect)
        fasilitasSelect.addEventListener("change", updateDeckOptions);
    if (deckSelect)
        deckSelect.addEventListener("change", function () {
            updateDisabledDates();
            updateMaxPeople();
            updateHarga();
        });
    if (tanggalInput) {
        tanggalInput.addEventListener("change", updateHarga);
        tanggalInput.addEventListener("keydown", function (e) {
            e.preventDefault();
        });
    }

    // Jumlah orang plus/minus
    const minusBtn = document.getElementById("minus-btn");
    const plusBtn = document.getElementById("plus-btn");
    const jumlahOrangInput = document.getElementById("jumlah-orang");
    if (minusBtn && plusBtn && jumlahOrangInput) {
        plusBtn.onclick = () => {
            let max = parseInt(jumlahOrangInput.max) || 10;
            if (parseInt(jumlahOrangInput.value) < max)
                jumlahOrangInput.value++;
            updateHarga();
        };
        minusBtn.onclick = () => {
            if (jumlahOrangInput.value > 1) jumlahOrangInput.value--;
            updateHarga();
        };
        jumlahOrangInput.addEventListener("input", updateHarga);
    }
    if (minusBtn) {
        minusBtn.addEventListener("click", () => {
            if (jumlahOrangInput.value > 1) jumlahOrangInput.value--;
            updateHarga();
        });
    }

    // Inisialisasi awal
    updateDeckOptions();
    updateDisabledDates();
    updateMaxPeople();
    updateHarga();

    // Validasi form
    const form = document.querySelector("form");
    if (form) {
        form.addEventListener("submit", function (e) {
            const deck = deckSelect.value;
            const booked = bookedDates?.[deck] || [];
            if (booked.includes(tanggalInput.value)) {
                alert(
                    "Tanggal ini sudah dipesan untuk deck tersebut. Silakan pilih tanggal lain."
                );
                tanggalInput.value = "";
                e.preventDefault();
            }
        });
    }
});
