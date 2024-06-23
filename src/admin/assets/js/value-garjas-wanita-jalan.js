$(document).ready(function () {
  $(".buttonWanitaJalan").click(function (e) {
    e.preventDefault();
    let garjasWanitaTestJalanID = $(this).data("id");
    console.log(garjasWanitaTestJalanID);
    $.ajax({
      url: "../config/get-garjas-wanita-jalan-data.php",
      method: "GET",
      data: {
        test_wanita_jalan_id: garjasWanitaTestJalanID,
      },
      success: function (data) {
        console.log(data);
        let garjasWanitaTestJalanData = JSON.parse(data);
        console.log(garjasWanitaTestJalanData);

        if (garjasWanitaTestJalanData.success === false) {
          alert(garjasWanitaTestJalanData.message);
        } else {
          let nipNama = garjasWanitaTestJalanData.NIP_Pengguna + " - " + garjasWanitaTestJalanData.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#SuntingGarjasWanitaJalanID").val(garjasWanitaTestJalanData.ID_Jalan_Wanita);
          $("#suntingWaktuGarjasWanitaJalan").val(garjasWanitaTestJalanData.Waktu_Jalan_Wanita);
          $("#suntingGarjasWanitaJalan").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasWanitaJalan").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-wanita-jalan.php",
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
              window.location.href = "../pages/data-garjas-wanita-jalan.php";
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
        $("#suntingGarjasWanitaJalan").modal("hide");
      },
    });
  });
});
