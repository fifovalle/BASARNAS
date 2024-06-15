$(document).ready(function () {
  $(".buttonLihatGarjasWanitaPushUp").click(function (e) {
    e.preventDefault();
    let garjasWanitaPushUpID = $(this).data("id");
    console.log(garjasWanitaPushUpID);

    $.ajax({
      url: "../config/get-garjas-wanita-push-up-data.php",
      method: "GET",
      data: {
        garjas_wanita_situp1_id: garjasWanitaPushUpID,
      },
      success: function (data) {
        console.log(data);
        let penggunaData = JSON.parse(data);
        console.log(penggunaData);

        if (penggunaData.success === false) {
          alert(penggunaData.message);
        } else {
          $("#lihatNamaPengguna").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatNIPPenggunaGP").text(penggunaData.NIP_Pengguna);
          $("#lihatPotoPenggunaGP").attr("src", "../uploads/" + penggunaData.Foto_Pengguna);
          $("#lihatNamaPenggunaGP").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaGP").text(penggunaData.Tanggal_Lahir_Pengguna);
          $("#lihatAlamatPenggunaGP").text(penggunaData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaGP").text(penggunaData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaGP").text(penggunaData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaGP").text(penggunaData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaGP").text(penggunaData.Umur_Pengguna);
          $("#lihatJumlahPushUpWanitaGP").text(penggunaData.Jumlah_Push_Up_Wanita);
          $("#lihatNilaiPushUpWanitaGP").text(penggunaData.Nilai_Push_Up_Wanita);
          $("#lihatGarjasWanitaPushUp").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
