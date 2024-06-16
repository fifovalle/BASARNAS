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
          $("#lihatNIPPenggunaGP").text(penggunaData.NIP_Pengguna);
          $("#lihatPotoPenggunaGP").attr("src", "../uploads/" + penggunaData.Foto_Pengguna);
          $("#lihatNamaPenggunaGP").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaGP").text(penggunaData.Tanggal_Lahir_Pengguna);
          $("#lihatAlamatPenggunaGP").text(penggunaData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaGP").text(penggunaData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaGP").text(penggunaData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaGP").text(penggunaData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaGP").text(penggunaData.Umur_Pengguna);
          $("#lihatJumlahShuttleRunWanitaGP").text(penggunaData.Jumlah_Shuttle_Run_Wanita);
          $("#lihatNilaiShuttleRunWanitaGP").text(penggunaData.Nilai_Shuttle_Run_Wanita);
          $("#lihatGarjasWanitaShuttleRun").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
