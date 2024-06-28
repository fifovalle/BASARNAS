$(document).ready(function () {
  $(".buttonLihatAdmin").click(function (e) {
    e.preventDefault();
    let adminNIP = $(this).data("id");
    console.log(adminNIP);
    $.ajax({
      url: "../config/get-admin-data.php",
      method: "GET",
      data: {
        admin_nip: adminNIP,
      },
      success: function (data) {
        console.log(data);
        let adminData = JSON.parse(data);
        console.log(adminData);

        if (adminData.success === false) {
          alert(adminData.message);
        } else {
          $("#lihatNamaAdmin").text(adminData.Nama_Lengkap_Admin);
          $("#lihatNIPAdmin").text(adminData.NIP_Admin);
          $("#lihatPotoAdmin").attr(
            "src",
            "../uploads/" + adminData.Foto_Admin
          );
          $("#lihatNamaAdminTd").text(adminData.Nama_Lengkap_Admin);
          $("#lihatTglLahirAdminTd").text(adminData.Tanggal_Lahir_Admin);
          $("#lihatPeranAdminTd").text(adminData.Peran_Admin);
          $("#lihatJabatanAdminTd").text(adminData.Jabatan_Admin);
          $("#lihatJenisKelaminAdminTd").text(adminData.Jenis_Kelamin_Admin);
          $("#lihatNoTelpAdminTd").text(adminData.No_Telepon_Admin);
          $("#lihatUmurAdminTd").text(adminData.Umur_Admin);
          $("#lihatAdmin").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
