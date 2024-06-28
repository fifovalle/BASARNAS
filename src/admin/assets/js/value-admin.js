$(document).ready(function () {
  $(".buttonAdmin").click(function (e) {
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
          $("#suntingNIPAdmin").val(adminData.NIP_Admin);
          $("#suntingNamaAdmin").val(adminData.Nama_Lengkap_Admin);
          $("#suntingTanggalLahirAdmin").val(adminData.Tanggal_Lahir_Admin);
          $("#suntingPeranAdmin").val(adminData.Peran_Admin);
          $("#suntingJabatanAdmin").val(adminData.Jabatan_Admin);
          $("#suntingJenisKelaminAdmin").val(adminData.Jenis_Kelamin_Admin);
          $("#suntingNomorTelpAdmin").val(adminData.No_Telepon_Admin);
          $("#suntingAdmin").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanAdmin").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-admin.php",
      method: "POST",
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function (xhr) {
        console.log("Mengirim data ke server:", formData);
      },
      success: function (response) {
        console.log("Respon dari server:", response);
        let responseData = JSON.parse(response);
        if (responseData.success) {
          Swal.fire({
            icon: "success",
            title: "Sukses!",
            text: responseData.message,
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
          }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
              window.location.href = "../pages/data-admin.php";
            }
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: responseData.message,
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
          });
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Terjadi kesalahan saat mengirim permintaan.",
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
        });
      },
      complete: function () {
        $("#suntingAdmin").modal("hide");
      },
    });
  });
});
