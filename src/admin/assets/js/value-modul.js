$(document).ready(function () {
  $(".buttonModul").click(function (e) {
    e.preventDefault();
    let modulID = $(this).data("id");
    console.log(modulID);
    $.ajax({
      url: "../config/get-data-modul.php",
      method: "GET",
      data: {
        modul_id: modulID,
      },
      success: function (data) {
        console.log(data);
        let modulData = JSON.parse(data);
        console.log(modulData);

        if (modulData.success === false) {
          alert(modulData.message);
        } else {
          $("#suntingIDModul").val(modulData.ID_Modul);
          $("#suntingFileModul").text(modulData.File_Modul);
          $("#suntingTanggalTerbitModul").val(modulData.Tanggal_Terbit_Modul);
          $("#suntingNamaModul").val(modulData.Nama_Modul);
          $("#suntingJudulModul").val(modulData.Judul_Modul);
          $("#suntingDeskripsiModul").val(modulData.Deskripsi_Modul);
          $("#suntingModul").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanModul").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-modul.php",
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
              window.location.href = "../pages/data-modul.php";
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
        $("#suntingModul").modal("hide");
      },
    });
  });
});
