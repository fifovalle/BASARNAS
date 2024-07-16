$(document).ready(function () {
  $(".buttonLihatPriaJalan").click(function (e) {
    e.preventDefault();
    let garjasTestJalanPriaID = $(this).data("id");
    console.log(garjasTestJalanPriaID);

    $.ajax({
      url: "../config/get-garjas-pria-jalan-data.php",
      method: "GET",
      data: {
        test_pria_jalan_id: garjasTestJalanPriaID,
      },
      success: function (data) {
        console.log(data);
        let penggunaData = JSON.parse(data);
        console.log(penggunaData);

        if (penggunaData.success === false) {
          alert(penggunaData.message);
        } else {
          $("#lihatNamaPengguna").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatNIPPenggunaTd").text(penggunaData.NIP_Pengguna);
          $("#lihatPotoPenggunaTd").attr(
            "src",
            "../uploads/" + penggunaData.Foto_Pengguna
          );
          $("#lihatNamaPenggunaTd").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaTd").text(
            penggunaData.Tanggal_Lahir_Pengguna
          );
          $("#lihatAlamatPenggunaTd").text(penggunaData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaTd").text(penggunaData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaTd").text(
            penggunaData.Jenis_Kelamin_Pengguna
          );
          $("#lihatNoTelpPenggunaTd").text(penggunaData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaTd").text(penggunaData.Umur_Pengguna);
          $("#lihatWaktuTesJalanPriaTd").text(penggunaData.Waktu_Jalan_Pria);
          $("#lihatNilaiTesJalanPriaTd").text(penggunaData.Nilai_Jalan_Pria);
          $("#tanggalPelaksanaanTesJalanPriaTd").text(
            penggunaData.Tanggal_Pelaksanaan_Tes_Jalan_Pria
          );
          const statusClasses = {
            Ditinjau: "badge bg-warning text-white",
            Diterima: "badge bg-success text-white",
            Ditolak: "badge bg-danger text-white",
          };

          const statusText = penggunaData.Status_Jalan_Pria;
          const statusClass = statusClasses[statusText] || "";

          $("#statusTesJalanPriaTd").text(statusText);
          $("#statusTesJalanPriaTd").attr("class", statusClass);
          $("#lihatGarjasPriaJalan").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
