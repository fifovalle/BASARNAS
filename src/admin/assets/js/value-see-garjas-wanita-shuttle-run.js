$(document).ready(function () {
  $(".buttonLihatGarjasWanitaShuttleRun").click(function (e) {
    e.preventDefault();
    let garjasWanitaShuttleRunID = $(this).data("id");
    console.log(garjasWanitaShuttleRunID);

    $.ajax({
      url: "../config/get-garjas-wanita-shuttlerun-data.php",
      method: "GET",
      data: {
        garjas_wanita_shuttlerun_id: garjasWanitaShuttleRunID,
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
          $("#lihatJumlahShuttleRunWanitaGW").text(penggunaData.Jumlah_Shuttle_Run_Wanita);
          $("#lihatNilaiShuttleRunWanitaGW").text(penggunaData.Nilai_Shuttle_Run_Wanita);
          $("#tanggalPelaksanaanShuttleRunWanitaGW").text(penggunaData.Tanggal_Pelaksanaan_Shuttle_Run_Wanita);
          $("#lihatGarjasWanitaShuttleRun").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
