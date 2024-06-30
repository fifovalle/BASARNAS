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
        let garjasWanitaShuttleRunData = JSON.parse(data);
        console.log(garjasWanitaShuttleRunData);

        if (garjasWanitaShuttleRunData.success === false) {
          alert(garjasWanitaShuttleRunData.message);
        } else {
          let nipNama = garjasWanitaShuttleRunData.NIP_Pengguna + " - " + garjasWanitaShuttleRunData.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#SuntingGarjasWanitaShuttleRunID").val(garjasWanitaShuttleRunData.ID_Wanita_Shuttle_Run);
          $("#suntingJumlahShuttleRunGarjasWanita").val(garjasWanitaShuttleRunData.Jumlah_Shuttle_Run_Wanita);
          $("#suntingTanggalPelaksanaanShuttleRunGarjasWanita").val(garjasWanitaShuttleRunData.Tanggal_Pelaksanaan_Shuttle_Run_Wanita);
          $("#suntingGarjasWanitaShuttleRun").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasWanitaShuttleRun").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-wanita-shuttlerun.php",
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
              window.location.href = "../pages/data-garjas-wanita-shuttlerun.php";
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
