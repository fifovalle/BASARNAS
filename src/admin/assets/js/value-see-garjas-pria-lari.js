$(document).ready(function () {
  $(".buttonLihatGarjasTesLariPria").click(function (e) {
    e.preventDefault();
    let garjasTestLariPriaID = $(this).data("id");
    console.log(garjasTestLariPriaID);

    $.ajax({
      url: "../config/get-garjas-pria-lari-data.php",
      method: "GET",
      data: {
        test_pria_lari_id: garjasTestLariPriaID,
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
          $("#lihatPotoPenggunaTd").attr("src", "../uploads/" + penggunaData.Foto_Pengguna);
          $("#lihatNamaPenggunaTd").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaTd").text(penggunaData.Tanggal_Lahir_Pengguna);
          $("#lihatAlamatPenggunaTd").text(penggunaData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaTd").text(penggunaData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaTd").text(penggunaData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaTd").text(penggunaData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaTd").text(penggunaData.Umur_Pengguna);
          $("#lihatWaktuTesLariPriaTd").text(penggunaData.Waktu_Lari_Pria);
          $("#lihatNilaiTesLariPriaTd").text(penggunaData.Nilai_Lari_Pria);
          $("#tanggalPelaksanaanTesLariPriaTd").text(penggunaData.Tanggal_Pelaksanaan_Tes_Lari_Pria);
          $("#lihatGarjasPriaLari").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
