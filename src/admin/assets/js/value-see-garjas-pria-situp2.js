$(document).ready(function () {
  $(".buttonLihatGarjasPriaSitup2").click(function (e) {
    e.preventDefault();
    let garjasPriaSitUp2ID = $(this).data("id");
    console.log(garjasPriaSitUp2ID);

    $.ajax({
      url: "../config/get-garjas-pria-situp2-data.php",
      method: "GET",
      data: {
        garjas_pria_situp2_id: garjasPriaSitUp2ID,
      },
      success: function (data) {
        console.log(data);
        let garjasPriaSitUp2Data = JSON.parse(data);
        console.log(garjasPriaSitUp2Data);

        if (garjasPriaSitUp2Data.success === false) {
          alert(garjasPriaSitUp2Data.message);
        } else {
          $("#lihatNamaPenggunaPriaSitUp2").text(garjasPriaSitUp2Data.Nama_Lengkap_Pengguna);
          $("#lihatNIPPenggunaPriaSitUp2Td").text(garjasPriaSitUp2Data.NIP_Pengguna);
          $("#lihatFotoPenggunaPriaSitUp2Td").attr("src", "../uploads/" + garjasPriaSitUp2Data.Foto_Pengguna);
          $("#lihatNamaLengkapPriaSitUp2Td").text(garjasPriaSitUp2Data.Nama_Lengkap_Pengguna);
          $("#lihatTanggalLahirPriaSitUp2Td").text(garjasPriaSitUp2Data.Tanggal_Lahir_Pengguna);
          $("#lihatJabatanPriaSitUp2Td").text(garjasPriaSitUp2Data.Jabatan_Pengguna);
          $("#lihatJenisKelaminPriaSitUp2Td").text(garjasPriaSitUp2Data.Jenis_Kelamin_Pengguna);
          $("#lihatNoTeleponPriaSitUp2Td").text(garjasPriaSitUp2Data.No_Telepon_Pengguna);
          $("#lihatUmurPriaSitUp2Td").text(garjasPriaSitUp2Data.Umur_Pengguna);
          $("#lihatJumlahPriaSitUp2Td").text(garjasPriaSitUp2Data.Jumlah_Sit_Up_Kaki_Di_Tekuk_Pria);
          $("#lihatNilaiPriaSitUp2Td").text(garjasPriaSitUp2Data.Nilai_Sit_Up_Kaki_Di_Tekuk_Pria);
          $("#tanggalPelaksanaanSitUp2PriaTd").text(garjasPriaSitUp2Data.Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk);
          $("#lihatGarjasPriaSitUp2").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
