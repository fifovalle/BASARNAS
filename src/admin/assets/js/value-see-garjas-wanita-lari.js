$(document).ready(function () {
  $(".buttonLihatGarjasTesLariWanita").click(function (e) {
    e.preventDefault();
    let garjasTestLariWanitaID = $(this).data("id");
    console.log(garjasTestLariWanitaID);

    $.ajax({
      url: "../config/get-garjas-wanita-lari-data.php",
      method: "GET",
      data: {
        test_wanita_lari_id: garjasTestLariWanitaID,
      },
      success: function (data) {
        console.log(data);
        let penggunaData = JSON.parse(data);
        console.log(penggunaData);

        if (penggunaData.success === false) {
          alert(penggunaData.message);
        } else {
          $("#lihatNamaPengguna").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatNIPPenggunaGW").text(penggunaData.NIP_Pengguna);
          $("#lihatPotoPenggunaGW").attr("src", "../uploads/" + penggunaData.Foto_Pengguna);
          $("#lihatNamaPenggunaGW").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaGW").text(penggunaData.Tanggal_Lahir_Pengguna);
          $("#lihatAlamatPenggunaGW").text(penggunaData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaGW").text(penggunaData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaGW").text(penggunaData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaGW").text(penggunaData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaGW").text(penggunaData.Umur_Pengguna);
          $("#lihatWaktuTesLariWanitaGW").text(penggunaData.Waktu_Lari_Wanita);
          $("#lihatNilaiTesLariWanitaGW").text(penggunaData.Nilai_Lari_Wanita);
          $("#tanggalPelaksanaanTesLariWanitaGW").text(penggunaData.Tanggal_Pelaksanaan_Tes_Lari_Wanita);
          $("#lihatGarjasWanitaLari").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
