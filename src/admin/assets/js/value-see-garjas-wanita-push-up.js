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
          $("#lihatNIPPenggunaGW").text(garjasWanitaPushUpData.NIP_Pengguna);
          $("#lihatPotoPenggunaGW").attr("src", "../uploads/" + garjasWanitaPushUpData.Foto_Pengguna);
          $("#lihatNamaPenggunaGW").text(garjasWanitaPushUpData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaGW").text(garjasWanitaPushUpData.Tanggal_Lahir_Pengguna);
          $("#lihatAlamatPenggunaGW").text(garjasWanitaPushUpData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaGW").text(garjasWanitaPushUpData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaGW").text(garjasWanitaPushUpData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaGW").text(garjasWanitaPushUpData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaGW").text(garjasWanitaPushUpData.Umur_Pengguna);
          $("#lihatJumlahPushUpWanitaGW").text(garjasWanitaPushUpData.Jumlah_Push_Up_Wanita);
          $("#lihatNilaiPushUpWanitaGW").text(garjasWanitaPushUpData.Nilai_Push_Up_Wanita);
          $("#tanggalPelaksanaanPushUpWanitaGW").text(garjasWanitaPushUpData.Tanggal_Pelaksanaan_Push_Up_Wanita);
          $("#lihatGarjasWanitaPushUp").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
