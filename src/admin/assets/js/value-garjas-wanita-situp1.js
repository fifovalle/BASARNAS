$(document).ready(function () {
  $(".buttonGarjasWanitaSitUp1").click(function (e) {
    e.preventDefault();
    let garjasID = $(this).data("id");
    console.log(garjasID);
    $.ajax({
      url: "../config/get-garjas-wanita-situp1-data.php",
      method: "GET",
      data: {
        garjas_id: garjasID,
      },
      success: function (data) {
        console.log(data);
        let garjasSitUp1WanitaData = JSON.parse(data);
        console.log(garjasSitUp1WanitaData);

        if (garjasSitUp1WanitaData.success === false) {
          alert(garjasSitUp1WanitaData.message);
        } else {
          $("#editGarjasSitUp1WanitaID").val(
            garjasSitUp1WanitaData.ID_Pengguna
          );
          $("#suntingNIPPengguna").val(garjasSitUp1WanitaData.NIP_Pengguna);
          $("#suntingJumlahSitUp1GarjasWanita").val(
            garjasSitUp1WanitaData.Jumlah_Sit_Up_Kaki_Lurus_Wanita
          );
          $("#suntingGarjasWanitaSitUp1").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasWanitaSitUp1").submit(function (e) {
    e.preventDefault();

    let formData = new FormData($(this)[0]);

    $.ajax({
      url: "../config/edit-garjas-wanita-situp1.php",
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
              window.location.href = "../pages/data-garjas-wanita-situp1.php";
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
        $("#suntingGarjasWanitaSitUp1").modal("hide");
      },
    });
  });
});
