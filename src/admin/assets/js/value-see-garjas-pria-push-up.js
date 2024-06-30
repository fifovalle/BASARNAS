$(document).ready(function () {
  $(".buttonLihatGarjasPriaPushUp").click(function (e) {
    e.preventDefault();
    let garjasPriaPushUpID = $(this).data("id");
    console.log(garjasPriaPushUpID);

    $.ajax({
      url: "../config/get-garjas-pria-push-up-data.php",
      method: "GET",
      data: {
        garjas_pria_pushup_id: garjasPriaPushUpID,
      },
      success: function (data) {
        console.log(data);
        let garjasPriaPushUpData = JSON.parse(data);
        console.log(garjasPriaPushUpData);

        if (garjasPriaPushUpData.success === false) {
          alert(garjasPriaPushUpData.message);
        } else {
          $("#lihatNamaPengguna").text(garjasPriaPushUpData.Nama_Lengkap_Pengguna);
          $("#lihatNIPPenggunaTd").text(garjasPriaPushUpData.NIP_Pengguna);
          $("#lihatPotoPenggunaTd").attr("src", "../uploads/" + garjasPriaPushUpData.Foto_Pengguna);
          $("#lihatNamaPenggunaTd").text(garjasPriaPushUpData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaTd").text(garjasPriaPushUpData.Tanggal_Lahir_Pengguna);
          $("#lihatAlamatPenggunaTd").text(garjasPriaPushUpData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaTd").text(garjasPriaPushUpData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaTd").text(garjasPriaPushUpData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaTd").text(garjasPriaPushUpData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaTd").text(garjasPriaPushUpData.Umur_Pengguna);
          $("#lihatJumlahPushUpPriaTd").text(garjasPriaPushUpData.Jumlah_Push_Up_Pria);
          $("#lihatNilaiPushUpPriaTd").text(garjasPriaPushUpData.Nilai_Push_Up_Pria);
          $("#tanggalPelaksanaanPushUpPriaTd").text(garjasPriaPushUpData.Tanggal_Pelaksanaan_Push_Up_Pria);
          $("#lihatGarjasPriaPushUp").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
