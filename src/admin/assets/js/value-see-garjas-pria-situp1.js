$(document).ready(function () {
  $(".buttonLihatGarjasPriaSitup1").click(function (e) {
    e.preventDefault();
    let garjasPriaSitUpID = $(this).data("id");
    console.log(garjasPriaSitUpID);

    $.ajax({
      url: "../config/get-garjas-pria-situp1-data.php",
      method: "GET",
      data: {
        garjas_pria_situp_id: garjasPriaSitUpID,
      },
      success: function (data) {
        console.log(data);
        let garjasSitUp1Data = JSON.parse(data);
        console.log(garjasSitUp1Data);

        if (garjasSitUp1Data.success === false) {
          alert(garjasSitUp1Data.message);
        } else {
          $("#lihatNamaPenggunaSitUp1").text(
            garjasSitUp1Data.Nama_Lengkap_Pengguna
          );
          $("#lihatNIPPenggunaSitUp1").text(garjasSitUp1Data.NIP_Pengguna);
          $("#lihatFotoPenggunaSitUp1").attr(
            "src",
            "../uploads/" + garjasSitUp1Data.Foto_Pengguna
          );
          $("#lihatNamaLengkapSitUp1").text(
            garjasSitUp1Data.Nama_Lengkap_Pengguna
          );
          $("#lihatTanggalLahirSitUp1").text(
            garjasSitUp1Data.Tanggal_Lahir_Pengguna
          );
          $("#lihatJabatanSitUp1").text(garjasSitUp1Data.Jabatan_Pengguna);
          $("#lihatJenisKelaminSitUp1").text(
            garjasSitUp1Data.Jenis_Kelamin_Pengguna
          );
          $("#lihatNoTeleponSitUp1").text(garjasSitUp1Data.No_Telepon_Pengguna);
          $("#lihatUmurSitUp1").text(garjasSitUp1Data.Umur_Pengguna);
          $("#lihatJumlahSitUp1").text(
            garjasSitUp1Data.Jumlah_Sit_up_Kaki_lurus_Pria
          );
          $("#lihatNilaiSitUp1").text(
            garjasSitUp1Data.Nilai_Sit_Up_Kaki_Lurus_Pria
          );
          $("#lihatGarjasPriaSitUp1").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
