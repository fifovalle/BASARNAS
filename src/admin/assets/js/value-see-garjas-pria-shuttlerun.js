$(document).ready(function () {
  $(".buttonlihatGarjasPriaShuttleRun").click(function (e) {
    e.preventDefault();
    let garjasPriaShuttleRunID = $(this).data("id");
    console.log(garjasPriaShuttleRunID);

    $.ajax({
      url: "../config/get-garjas-pria-shuttlerun-data.php",
      method: "GET",
      data: {
        garjas_pria_shuttlerun_id: garjasPriaShuttleRunID,
      },
      success: function (data) {
        console.log(data);
        let garjasPriaShuttleRunData = JSON.parse(data);
        console.log(garjasPriaShuttleRunData);

        if (garjasPriaShuttleRunData.success === false) {
          alert(garjasPriaShuttleRunData.message);
        } else {
          $("#lihatNamaPengguna").text(garjasPriaShuttleRunData.Nama_Lengkap_Pengguna);
          $("#lihatNIPPenggunaShuttleRunPriaTd").text(garjasPriaShuttleRunData.NIP_Pengguna);
          $("#lihatPotoPenggunaShuttleRunPriaTd").attr("src", "../uploads/" + garjasPriaShuttleRunData.Foto_Pengguna);
          $("#lihatNamaPenggunaShuttleRunPriaTd").text(garjasPriaShuttleRunData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaShuttleRunPriaTd").text(garjasPriaShuttleRunData.Tanggal_Lahir_Pengguna);
          $("#lihatAlamatPenggunaTd").text(garjasPriaShuttleRunData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaShuttleRunPriaTd").text(garjasPriaShuttleRunData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaShuttleRunPriaTd").text(garjasPriaShuttleRunData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaShuttleRunPriaTd").text(garjasPriaShuttleRunData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaShuttleRunPriaTd").text(garjasPriaShuttleRunData.Umur_Pengguna);
          $("#lihatWaktuShuttleRunPriaTd").text(garjasPriaShuttleRunData.Waktu_Shuttle_Run_Pria);
          $("#lihatNilaiShuttleRunPriaTd").text(garjasPriaShuttleRunData.Nilai_Shuttle_Run_Pria);
          $("#tanggalPelaksanaanShuttleRunPriaTd").text(garjasPriaShuttleRunData.Tanggal_Pelaksanaan_Shuttle_Run_Pria);
          $("#lihatGarjasPriaShuttleRun").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
