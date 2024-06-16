$(document).ready(function () {
  $(".buttonLihatGarjasWanitaPushUp").click(function (e) {
    e.preventDefault();
    let garjasWanitaPushUpID = $(this).data("id");
    console.log(garjasWanitaPushUpID);
    $.ajax({
      url: "../config/get-garjas-wanita-push-up-data.php",
      method: "GET",
      data: {
        garjas_wanita_push_up_id: garjasWanitaPushUpID,
      },
      success: function (data) {
        console.log(data);
        let garjasWanitaPushUpData = JSON.parse(data);
        console.log(garjasWanitaPushUpData);

        if (garjasWanitaPushUpData.success === false) {
          alert(garjasWanitaPushUpData.message);
        } else {
          $("#lihatNamaPengguna").text(garjasWanitaPushUpData.Nama_Lengkap_Pengguna);
          $("#lihatNIPPenggunaGP").text(garjasWanitaPushUpData.NIP_Pengguna);
          $("#lihatPotoPenggunaGP").attr("src", "../uploads/" + garjasWanitaPushUpData.Foto_Pengguna);
          $("#lihatNamaPenggunaGP").text(garjasWanitaPushUpData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaGP").text(garjasWanitaPushUpData.Tanggal_Lahir_Pengguna);
          $("#lihatAlamatPenggunaGP").text(garjasWanitaPushUpData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaGP").text(garjasWanitaPushUpData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaGP").text(garjasWanitaPushUpData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaGP").text(garjasWanitaPushUpData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaGP").text(garjasWanitaPushUpData.Umur_Pengguna);
          $("#lihatJumlahPushUpWanitaGP").text(garjasWanitaPushUpData.Jumlah_Push_Up_Wanita);
          $("#lihatNilaiPushUpWanitaGP").text(garjasWanitaPushUpData.Nilai_Push_Up_Wanita);
          $("#lihatGarjasWanitaPushUp").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
