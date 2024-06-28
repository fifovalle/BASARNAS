$(document).ready(function () {
  $(".buttonPengguna").click(function (e) {
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
          $("#suntingNIPPengguna").val(penggunaData.NIP_Pengguna);
          $("#suntingNamaPengguna").val(penggunaData.Nama_Lengkap_Pengguna);
          $("#suntingTanggalLahirPengguna").val(
            penggunaData.Tanggal_Lahir_Pengguna
          );
          $("#suntingJabatanPengguna").val(penggunaData.Jabatan_Pengguna);
          $("#suntingJenisKelaminPengguna").val(
            penggunaData.Jenis_Kelamin_Pengguna
          );
          $("#suntingNomorTelpPengguna").val(penggunaData.No_Telepon_Pengguna);
          $("#suntingPengguna").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanPengguna").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-user.php",
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
              window.location.href = "../pages/data-user.php";
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
        $("#suntingPengguna").modal("hide");
      },
    });
  });
});
