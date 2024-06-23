$(document).ready(function () {
  $(".buttonLihatWanitaJalan").click(function (e) {
    e.preventDefault();
    let garjasTestJalanWanitaID = $(this).data("id");
    console.log(garjasTestJalanWanitaID);

    $.ajax({
      url: "../config/get-garjas-wanita-jalan-data.php",
      method: "GET",
      data: {
        test_wanita_jalan_id: garjasTestJalanWanitaID,
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
          $("#lihatWaktuTesJalanWanitaGW").text(penggunaData.Waktu_Jalan_Wanita);
          $("#lihatNilaiTesJalanWanitaGW").text(penggunaData.Nilai_Jalan_Wanita);
          $("#lihatGarjasWanitaJalan").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
