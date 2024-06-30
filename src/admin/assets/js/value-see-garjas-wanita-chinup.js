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
          $("#lihatNIPPenggunaGW").text(penggunaData.NIP_Pengguna);
          $("#lihatPotoPenggunaGW").attr("src", "../uploads/" + penggunaData.Foto_Pengguna);
          $("#lihatNamaPenggunaGW").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaGW").text(penggunaData.Tanggal_Lahir_Pengguna);
          $("#lihatAlamatPenggunaGW").text(penggunaData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaGW").text(penggunaData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaGW").text(penggunaData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaGW").text(penggunaData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaGW").text(penggunaData.Umur_Pengguna);
          $("#lihatJumlahChinUpWanitaGW").text(penggunaData.Jumlah_Chin_Up_Wanita);
          $("#lihatNilaiChinUpWanitaGW").text(penggunaData.Nilai_Chin_Up_Wanita);
          $("#tanggalPelaksanaanChinUpWanitaGW").text(penggunaData.Tanggal_Pelaksanaan_Chin_Up_Wanita);
          $("#lihatGarjasWanitaChinUp").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
