document.addEventListener("DOMContentLoaded", function () {
    const fasilitasSelect = document.querySelector("select[name='fasilitas']");
    const deckSelect = document.getElementById("deck-select");
    const deckContainer = document.getElementById("deck-container");
    const jumlahInput = document.getElementById("jumlah-orang");
    const plusBtn = document.getElementById("plus-btn");
    const minusBtn = document.getElementById("minus-btn");
    const tambahanHarga = document.getElementById("tambahan-harga");
    const totalHarga = document.getElementById("total-harga");

    let hargaDasar = 0;
    let defaultOrang = 0;
    let maxOrang = 0;
    let hargaPerOrang = 0;

    const fasilitasData = {
        "Pineus Tilu I": { deck: 9, default: 4, max: 6, harga: 100000, extra: 100000 },
        "Pineus Tilu II": { deck: 9, default: 4, max: 6, harga: 100000, extra: 100000 },
        "Pineus Tilu III VIP (Tenda)": { deck: 9, default: 5, max: 9, harga: 150000, extra: 150000 },
        "Pineus Tilu III VIP (Kabin)": { deck: 1, default: 2, max: 5, harga: 150000, extra: 150000 },
        "Pineus Tilu IV": { deck: 21, default: 4, max: 6, harga: 100000, extra: 100000 }
    };

    fasilitasSelect.addEventListener("change", () => {
        const selected = fasilitasSelect.value;

        if (!selected || !fasilitasData[selected]) {
            deckContainer.classList.add("hidden");
            return;
        }

        const data = fasilitasData[selected];
        hargaDasar = data.harga;
        defaultOrang = data.default;
        maxOrang = data.max;
        hargaPerOrang = data.extra;

        jumlahInput.value = defaultOrang;
        renderDeckOptions(data.deck);
        updateHarga();
    });

    function renderDeckOptions(jumlah) {
        deckSelect.innerHTML = "";
        for (let i = 1; i <= jumlah; i++) {
            const option = document.createElement("option");
            option.value = `Deck ${i}`;
            option.textContent = `Deck ${i}`;
            deckSelect.appendChild(option);
        }
        deckContainer.classList.remove("hidden");
    }

    plusBtn.addEventListener("click", () => {
        const jumlahSekarang = parseInt(jumlahInput.value);
        if (jumlahSekarang < maxOrang) {
            jumlahInput.value = jumlahSekarang + 1;
            updateHarga();
        }
    });

    minusBtn.addEventListener("click", () => {
        const jumlahSekarang = parseInt(jumlahInput.value);
        if (jumlahSekarang > 1) {
            jumlahInput.value = jumlahSekarang - 1;
            updateHarga();
        }
    });

    jumlahInput.addEventListener("change", () => {
        let val = parseInt(jumlahInput.value);
        if (isNaN(val) || val < 1) val = 1;
        if (val > maxOrang) val = maxOrang;
        jumlahInput.value = val;
        updateHarga();
    });

    function updateHarga() {
        const jumlahOrang = parseInt(jumlahInput.value);
        let tambahan = 0;
        if (jumlahOrang > defaultOrang) {
            tambahan = (jumlahOrang - defaultOrang) * hargaPerOrang;
        }
        tambahanHarga.textContent = `Rp ${tambahan.toLocaleString("id-ID")}`;
        totalHarga.textContent = `Rp ${(hargaDasar + tambahan).toLocaleString("id-ID")}`;
    }
});