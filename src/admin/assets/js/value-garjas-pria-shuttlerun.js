$(document).ready(function () {
  $(".buttonGarjasPriaShuttleRun").click(function (e) {
    e.preventDefault();
    let garjasPriaShuttleRun = $(this).data("id");
    console.log(garjasPriaShuttleRun);
    $.ajax({
      url: "../config/get-garjas-pria-shuttlerun-data.php",
      method: "GET",
      data: {
        garjas_pria_shuttlerun_id: garjasPriaShuttleRun,
      },
      success: function (data) {
        console.log(data);
        let garjasPriaShuttleRunData = JSON.parse(data);
        console.log(garjasPriaShuttleRunData);

        if (garjasPriaShuttleRunData.success === false) {
          alert(garjasPriaShuttleRunData.message);
        } else {
          let nipNama = garjasPriaShuttleRunData.NIP_Pengguna + " - " + garjasPriaShuttleRunData.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#editGarjasPriaShuttleRunPriaID").val(garjasPriaShuttleRunData.ID_Shuttle_Run_Pria);
          $("#suntingWaktuShuttleRunAdmin").val(garjasPriaShuttleRunData.Waktu_Shuttle_Run_Pria);
          $("#suntingTanggalPelaksanaanShuttleRunPengguna").val(garjasPriaShuttleRunData.Tanggal_Pelaksanaan_Shuttle_Run_Pria);
          $("#suntingGarjasPriaShuttleRun").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasPriaShuttleRun").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-pria-shuttlerun.php",
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
              window.location.href = "../pages/data-garjas-pria-shuttlerun.php";
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
        $("#suntingGarjasPriaShuttleRun").modal("hide");
      },
    });
  });
});
