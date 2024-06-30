$(document).ready(function () {
  $(".buttonLihatGarjasPriaChinUp").click(function (e) {
    e.preventDefault();
    let garjasChinUpPriaID = $(this).data("id");
    console.log(garjasChinUpPriaID);

    $.ajax({
      url: "../config/get-garjas-pria-chin-up-data.php",
      method: "GET",
      data: {
        garjas_pria_chinup_id: garjasChinUpPriaID,
      },
      success: function (data) {
        console.log(data);
        let garjasPriaPushUpData = JSON.parse(data);
        console.log(garjasPriaPushUpData);

        if (garjasPriaPushUpData.success === false) {
          alert(garjasPriaPushUpData.message);
        } else {
          $("#lihatNamaPengguna").text(garjasPriaPushUpData.Nama_Lengkap_Pengguna);
          $("#lihatNIPPenggunaChinUpTd").text(garjasPriaPushUpData.NIP_Pengguna);
          $("#lihatPotoPenggunaChinUpTd").attr("src", "../uploads/" + garjasPriaPushUpData.Foto_Pengguna);
          $("#lihatNamaPenggunaChinUpTd").text(garjasPriaPushUpData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaChinUpTd").text(garjasPriaPushUpData.Tanggal_Lahir_Pengguna);
          $("#lihatAlamatPenggunaChinUpTd").text(garjasPriaPushUpData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaChinUpTd").text(garjasPriaPushUpData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaChinUpTd").text(garjasPriaPushUpData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaChinUpTd").text(garjasPriaPushUpData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaChinUpTd").text(garjasPriaPushUpData.Umur_Pengguna);
          $("#lihatJumlahPushUpPriaChinUpTd").text(garjasPriaPushUpData.Jumlah_Chin_Up_Pria);
          $("#lihatNilaiPushUpPriaChinUpTd").text(garjasPriaPushUpData.Nilai_Chin_Up_Pria);
          $("#tanggalPelaksanaanChinUpPriaTd").text(garjasPriaPushUpData.Tanggal_Pelaksanaan_Chin_Up_Pria);
          $("#lihatGarjasPriaChinUp").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
