$(document).ready(function () {
  $(".buttonLihatAbsensi").click(function (e) {
    e.preventDefault();
    let absensiID = $(this).data("id");
    console.log(absensiID);

    $.ajax({
      url: "../config/get-absence-data.php",
      method: "GET",
      data: {
        absensi_id: absensiID,
      },
      success: function (data) {
        console.log(data);
        let absensiData = JSON.parse(data);
        console.log(absensiData);

        if (absensiData.success === false) {
          alert(absensiData.message);
        } else {
          $("#lihatNamaPengguna").text(absensiData.Nama_Lengkap_Pengguna);
          $("#lihatNIPPenggunaTd").text(absensiData.NIP_Pengguna);
          $("#lihatPotoPenggunaTd").attr(
            "src",
            "../uploads/" + absensiData.Foto_Pengguna
          );
          $("#lihatNamaPenggunaTd").text(absensiData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaTd").text(
            absensiData.Tanggal_Lahir_Pengguna
          );
          $("#lihatAlamatPenggunaTd").text(absensiData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaTd").text(absensiData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaTd").text(
            absensiData.Jenis_Kelamin_Pengguna
          );
          $("#lihatNoTelpPenggunaTd").text(absensiData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaTd").text(absensiData.Umur_Pengguna);
          $("#lihatTanggalAbsensiTd").text(absensiData.Tanggal_Absensi);
          $("#lihatHariAbsensiTd").text(absensiData.Hari_Absensi);
          $("#lihaStatusAbsensiTd").text(absensiData.Status_Absensi);
          $("#lihatAbsensi").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
