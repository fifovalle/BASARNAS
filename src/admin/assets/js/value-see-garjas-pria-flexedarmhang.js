$(document).ready(function () {
  $(".buttonlihatGarjasPriaFlexedArmHang").click(function (e) {
    e.preventDefault();
    let garjasPriaFlexedArmHangID = $(this).data("id");
    console.log(garjasPriaFlexedArmHangID);

    $.ajax({
      url: "../config/get-garjas-pria-flexedarmhang-data.php",
      method: "GET",
      data: {
        garjas_pria_flexedarmhang_id: garjasPriaFlexedArmHangID,
      },
      success: function (data) {
        console.log(data);
        let garjasPriaFlexedArmHangData = JSON.parse(data);
        console.log(garjasPriaFlexedArmHangData);

        if (garjasPriaFlexedArmHangData.success === false) {
          alert(garjasPriaFlexedArmHangData.message);
        } else {
          $("#lihatNamaPengguna").text(garjasPriaFlexedArmHangData.Nama_Lengkap_Pengguna);
          $("#lihatNIPPenggunaPriaFlexedArmHangTd").text(garjasPriaFlexedArmHangData.NIP_Pengguna);
          $("#lihatPotoPenggunaPriaFlexedArmHangTd").attr("src", "../uploads/" + garjasPriaFlexedArmHangData.Foto_Pengguna);
          $("#lihatNamaPenggunaPriaFlexedArmHangTd").text(garjasPriaFlexedArmHangData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaPriaFlexedArmHangTd").text(garjasPriaFlexedArmHangData.Tanggal_Lahir_Pengguna);
          $("#lihatAlamatPenggunaTd").text(garjasPriaFlexedArmHangData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaPriaFlexedArmHangTd").text(garjasPriaFlexedArmHangData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaPriaFlexedArmHangTd").text(garjasPriaFlexedArmHangData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaPriaFlexedArmHangTd").text(garjasPriaFlexedArmHangData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaPriaFlexedArmHangTd").text(garjasPriaFlexedArmHangData.Umur_Pengguna);
          $("#lihatWaktuPriaFlexedArmHangTd").text(garjasPriaFlexedArmHangData.Waktu_Menggantung_Pria);
          $("#lihatNilaiPriaFlexedArmHangTd").text(garjasPriaFlexedArmHangData.Nilai_Menggantung_Pria);
          $("#tanggalPelaksanaanFlexedArmHangPriaTd").text(garjasPriaFlexedArmHangData.Tanggal_Pelaksanaan_Pria_Menggantung);
          $("#lihatGarjasPriaFlexedArmHang").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
