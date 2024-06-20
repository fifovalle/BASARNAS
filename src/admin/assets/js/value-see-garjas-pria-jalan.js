$(document).ready(function () {
  $(".buttonLihatPriaJalan").click(function (e) {
    e.preventDefault();
    let priaJalanID = $(this).data("id");
    console.log(priaJalanID);
    $.ajax({
      url: "../config/get-data-pria-jalan.php",
      method: "GET",
      data: {
        pria_jalan_id: priaJalanID,
      },
      success: function (data) {
        console.log(data);
        let terampilData = JSON.parse(data);
        console.log(terampilData);

        if (terampilData.success === false) {
          alert(terampilData.message);
        } else {
          $("#lihatNamaAdmin").text(terampilData.Nama_Lengkap_Pengguna);
          $("#lihatNIPAdmin").text(terampilData.NIP_Pengguna);
          $("#lihatPotoAdmin").attr(
            "src",
            "../uploads/" + terampilData.Foto_Pengguna
          );
          $("#lihatNamaAdminTd").text(terampilData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirAdminTd").text(terampilData.Tanggal_Lahir_Pengguna);
          $("#lihatAlamatAdminTd").text(terampilData.Alamat_Pengguna);
          $("#lihatJabatanAdminTd").text(terampilData.Jabatan_Pengguna);
          $("#lihatJenisKelaminAdminTd").text(
            terampilData.Jenis_Kelamin_Pengguna
          );
          $("#lihatNoTelpAdminTd").text(terampilData.No_Telepon_Pengguna);
          $("#lihatUmurAdminTd").text(terampilData.Umur_Pengguna);
          $("#lihatWaktuJalanKakiAdminTd").text(terampilData.Waktu_Jalan_Pria);
          $("#lihatNilaiJalanKakiAdminTd").text(terampilData.Nilai_Jalan_Pria);

          $("#lihatGarjasPriaJalan").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
