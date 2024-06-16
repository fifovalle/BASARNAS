$(document).ready(function () {
  $(".buttonGarjasWanitaShuttleRun").click(function (e) {
    e.preventDefault();
    let garjasWanitaShuttleRunID = $(this).data("id");
    console.log(garjasWanitaShuttleRunID);
    $.ajax({
      url: "../config/get-garjas-wanita-shuttlerun-data.php",
      method: "GET",
      data: {
        garjas_wanita_shuttlerun_id: garjasWanitaShuttleRunID,
      },
      success: function (data) {
        console.log(data);
        let garjasPriaPushUpData = JSON.parse(data);
        console.log(garjasPriaPushUpData);

        if (garjasPriaPushUpData.success === false) {
          alert(garjasPriaPushUpData.message);
        } else {
          $("#editGarjasWanitaShuttleRunID").val(
            garjasPriaPushUpData.ID_Push_Up_Pria
          );
          $("#suntingNIPPengguna").val(garjasPriaPushUpData.NIP_Pengguna);
          $("#suntingJumlahShuttleRunGarjasWanita").val(
            garjasPriaPushUpData.Jumlah_Push_Up_Pria
          );
          $("#suntingGarjasWanitaShuttleRun").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasWanitaShuttleRun").submit(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-wanita-shuttle-run.php",
      method: "POST",
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function () {
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
              window.location.href =
                "../pages/data-garjas-wanita-shuttlerun.php";
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
        $("#suntingGarjasWanitaShuttleRun").modal("hide");
      },
    });
  });
});