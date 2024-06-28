$(document).ready(function () {
  $(".buttonLihatPengguna").click(function (e) {
    e.preventDefault();
    let penggunaNIP = $(this).data("id");
    console.log(penggunaNIP);
    $.ajax({
      url: "../config/get-user-data.php",
      method: "GET",
      data: {
        pengguna_nip: penggunaNIP,
      },
      success: function (data) {
        console.log(data);
        let penggunaData = JSON.parse(data);
        console.log(penggunaData);

        if (penggunaData.success === false) {
          alert(penggunaData.message);
        } else {
          $("#lihatNamaPengguna").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatNIPPengguna").text(penggunaData.NIP_Pengguna);
          $("#lihatPotoPengguna").attr(
            "src",
            "../uploads/" + penggunaData.Foto_Pengguna
          );
          $("#lihatNamaPenggunaTd").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaTd").text(
            penggunaData.Tanggal_Lahir_Pengguna
          );
          $("#lihatJabatanPenggunaTd").text(penggunaData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaTd").text(
            penggunaData.Jenis_Kelamin_Pengguna
          );
          $("#lihatNoTelpPenggunaTd").text(penggunaData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaTd").text(penggunaData.Umur_Pengguna);
          $("#lihatPengguna").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
