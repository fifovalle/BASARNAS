$(document).ready(function () {
  $(".buttonLihatGarjasWanitaSitUp1").click(function (e) {
    e.preventDefault();
    let garjasWanitaSitUp1ID = $(this).data("id");
    console.log(garjasWanitaSitUp1ID);

    $.ajax({
      url: "../config/get-garjas-wanita-situp1-data.php",
      method: "GET",
      data: {
        garjas_wanita_situp1_id: garjasWanitaSitUp1ID,
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
          $("#lihatJumlahSitUp1WanitaGP").text(penggunaData.Jumlah_Sit_Up_Kaki_Lurus_Wanita);
          $("#lihatNilaiSitUp1WanitaGP").text(penggunaData.Nilai_Sit_Up_Kaki_Lurus_Wanita);
          $("#lihatGarjasWanitaSitUp1").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
