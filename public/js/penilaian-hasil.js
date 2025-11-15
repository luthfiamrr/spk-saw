function initPenilaianHasil(detailData, kriteriaData, hasilData) {
    window.showDetail = function (karyawanId) {
        var modal = document.getElementById("detailModal");
        var modalContent = document.getElementById("modalContent");
        var modalTitle = document.getElementById("modalTitle");

        var hasilKaryawan = hasilData.find(function (h) {
            return h.karyawan_id == karyawanId;
        });
        var nilaiKaryawan = detailData[karyawanId] || [];

        if (!hasilKaryawan) {
            alert("Data tidak ditemukan");
            return;
        }

        modalTitle.textContent =
            "Detail Penilaian - " + hasilKaryawan.karyawan.nama_lengkap;

        var html =
            '<div class="mb-4 p-4 bg-blue-50 rounded-lg">' +
            '<div class="grid grid-cols-2 gap-4">' +
            "<div>" +
            '<p class="text-sm text-gray-600">Ranking</p>' +
            '<p class="text-2xl font-bold text-blue-600">#' +
            hasilKaryawan.ranking +
            "</p>" +
            "</div>" +
            "<div>" +
            '<p class="text-sm text-gray-600">Skor Akhir</p>' +
            '<p class="text-2xl font-bold text-blue-600">' +
            parseFloat(hasilKaryawan.skor_akhir).toFixed(4) +
            "</p>" +
            "</div>" +
            "</div>" +
            "</div>" +
            '<table class="min-w-full divide-y divide-gray-200">' +
            '<thead class="bg-gray-50">' +
            "<tr>" +
            '<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kriteria</th>' +
            '<th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Bobot</th>' +
            '<th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Nilai Mentah</th>' +
            '<th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Tipe</th>' +
            "</tr>" +
            "</thead>" +
            '<tbody class="bg-white divide-y divide-gray-200">';

        for (var i = 0; i < nilaiKaryawan.length; i++) {
            var nilai = nilaiKaryawan[i];
            var kriteria = nilai.kriteria;
            var tipeClass =
                kriteria.tipe == "benefit"
                    ? "bg-green-100 text-green-800"
                    : "bg-red-100 text-red-800";

            html +=
                "<tr>" +
                '<td class="px-4 py-3 text-sm text-gray-900">' +
                kriteria.kode_kriteria +
                " - " +
                kriteria.nama_kriteria +
                "</td>" +
                '<td class="px-4 py-3 text-center text-sm text-gray-900">' +
                (kriteria.bobot * 100).toFixed(0) +
                "%</td>" +
                '<td class="px-4 py-3 text-center text-sm font-bold text-blue-600">' +
                parseFloat(nilai.nilai_mentah).toFixed(2) +
                "</td>" +
                '<td class="px-4 py-3 text-center text-sm">' +
                '<span class="px-2 py-1 text-xs rounded-full ' +
                tipeClass +
                '">' +
                kriteria.tipe +
                "</span>" +
                "</td>" +
                "</tr>";
        }

        html +=
            "</tbody>" +
            "</table>" +
            '<div class="mt-4 p-4 bg-gray-50 rounded-lg">' +
            '<p class="text-sm text-gray-600 mb-2"><strong>Rumus SAW:</strong></p>' +
            '<p class="text-sm text-gray-700">V<sub>i</sub> = Σ(W<sub>j</sub> × R<sub>ij</sub>)</p>' +
            '<p class="text-xs text-gray-500 mt-2">' +
            "Keterangan:<br>" +
            "V<sub>i</sub> = Skor akhir karyawan<br>" +
            "W<sub>j</sub> = Bobot kriteria<br>" +
            "R<sub>ij</sub> = Nilai ternormalisasi (Benefit: X/Max | Cost: Min/X)" +
            "</p>" +
            "</div>";

        modalContent.innerHTML = html;
        modal.classList.remove("hidden");
    };

    window.closeModal = function () {
        document.getElementById("detailModal").classList.add("hidden");
    };

    window.onclick = function (event) {
        var modal = document.getElementById("detailModal");
        if (event.target == modal) {
            window.closeModal();
        }
    };
}
