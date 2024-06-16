$(document).ready(function () {
  $(".buttonLihatGarjasWanitaSitUp2").click(function (e) {
    e.preventDefault();
    let garjasWanitaSitUp2ID = $(this).data("id");
    console.log(garjasWanitaSitUp2ID);

    $.ajax({
      url: "../config/get-garjas-wanita-situp2-data.php",
      method: "GET",
      data: {
        garjas_wanita_situp2_id: garjasWanitaSitUp2ID,
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
          $("#lihatJumlahSitUp2WanitaGP").text(
            penggunaData.Jumlah_Sit_Up_Kaki_Di_Tekuk_Wanita
          );
          $("#lihatNilaiSitUp2WanitaGP").text(
            penggunaData.Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita
          );
          $("#lihatGarjasWanitaSitUp2").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
