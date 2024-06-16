$(document).ready(function () {
  $(".buttonLihatGarjasWanitaChinUp").click(function (e) {
    e.preventDefault();
    let garjasWanitaChinUpID = $(this).data("id");
    console.log(garjasWanitaChinUpID);

    $.ajax({
      url: "../config/get-garjas-wanita-chinup-data.php",
      method: "GET",
      data: {
        garjas_wanita_chinup_id: garjasWanitaChinUpID,
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
          $("#lihatPotoPenggunaGP").attr(
            "src",
            "../uploads/" + penggunaData.Foto_Pengguna
          );
          $("#lihatNamaPenggunaGP").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaGP").text(
            penggunaData.Tanggal_Lahir_Pengguna
          );
          $("#lihatAlamatPenggunaGP").text(penggunaData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaGP").text(penggunaData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaGP").text(
            penggunaData.Jenis_Kelamin_Pengguna
          );
          $("#lihatNoTelpPenggunaGP").text(penggunaData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaGP").text(penggunaData.Umur_Pengguna);
          $("#lihatJumlahChinUpWanitaGP").text(
            penggunaData.Jumlah_Chin_Up_Wanita
          );
          $("#lihatNilaiChinUpWanitaGP").text(
            penggunaData.Nilai_Chin_Up_Wanita
          );
          $("#lihatGarjasWanitaChinUp").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
