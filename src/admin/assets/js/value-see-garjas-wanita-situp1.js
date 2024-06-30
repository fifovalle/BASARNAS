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
          $("#lihatNIPPenggunaGW").text(penggunaData.NIP_Pengguna);
          $("#lihatPotoPenggunaGW").attr("src", "../uploads/" + penggunaData.Foto_Pengguna);
          $("#lihatNamaPenggunaGW").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaGW").text(penggunaData.Tanggal_Lahir_Pengguna);
          $("#lihatAlamatPenggunaGW").text(penggunaData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaGW").text(penggunaData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaGW").text(penggunaData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaGW").text(penggunaData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaGW").text(penggunaData.Umur_Pengguna);
          $("#lihatJumlahSitUp1WanitaGW").text(penggunaData.Jumlah_Sit_Up_Kaki_Lurus_Wanita);
          $("#lihatNilaiSitUp1WanitaGW").text(penggunaData.Nilai_Sit_Up_Kaki_Lurus_Wanita);
          $("#tanggalPelaksanaanSitUp1WanitaGW").text(penggunaData.Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Wanita);
          $("#lihatGarjasWanitaSitUp1").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
