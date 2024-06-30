$(document).ready(function () {
  $(".buttonLihatGarjasPriaSitup1").click(function (e) {
    e.preventDefault();
    let garjasPriaSitUp1ID = $(this).data("id");
    console.log(garjasPriaSitUp1ID);

    $.ajax({
      url: "../config/get-garjas-pria-situp1-data.php",
      method: "GET",
      data: {
        garjas_pria_situp1_id: garjasPriaSitUp1ID,
      },
      success: function (data) {
        console.log(data);
        let garjasSitUp1Data = JSON.parse(data);
        console.log(garjasSitUp1Data);

        if (garjasSitUp1Data.success === false) {
          alert(garjasSitUp1Data.message);
        } else {
          $("#lihatNamaPenggunaSitUp1").text(garjasSitUp1Data.Nama_Lengkap_Pengguna);
          $("#lihatNIPPenggunaSitUp1Td").text(garjasSitUp1Data.NIP_Pengguna);
          $("#lihatFotoPenggunaSitUp1Td").attr("src", "../uploads/" + garjasSitUp1Data.Foto_Pengguna);
          $("#lihatNamaLengkapSitUp1Td").text(garjasSitUp1Data.Nama_Lengkap_Pengguna);
          $("#lihatTanggalLahirSitUp1Td").text(garjasSitUp1Data.Tanggal_Lahir_Pengguna);
          $("#lihatJabatanSitUp1Td").text(garjasSitUp1Data.Jabatan_Pengguna);
          $("#lihatJenisKelaminSitUp1Td").text(garjasSitUp1Data.Jenis_Kelamin_Pengguna);
          $("#lihatNoTeleponSitUp1Td").text(garjasSitUp1Data.No_Telepon_Pengguna);
          $("#lihatUmurSitUp1Td").text(garjasSitUp1Data.Umur_Pengguna);
          $("#lihatJumlahSitUp1Td").text(garjasSitUp1Data.Jumlah_Sit_Up_Kaki_Lurus_Pria);
          $("#lihatNilaiSitUp1Td").text(garjasSitUp1Data.Nilai_Sit_Up_Kaki_Lurus_Pria);
          $("#tanggalPelaksanaanSitUp1PriaTd").text(garjasSitUp1Data.Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Pria);
          $("#lihatGarjasPriaSitUp1").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
