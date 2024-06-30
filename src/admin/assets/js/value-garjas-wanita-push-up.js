$(document).ready(function () {
  $(".buttonGarjasWanitaPushUp").click(function (e) {
    e.preventDefault();
    let garjasWanitaPushUpID = $(this).data("id");
    console.log(garjasWanitaPushUpID);
    $.ajax({
      url: "../config/get-garjas-wanita-push-up-data.php",
      method: "GET",
      data: {
        garjas_wanita_push_up_id: garjasWanitaPushUpID,
      },
      success: function (data) {
        console.log(data);
        let garjasWanitaPushUpData = JSON.parse(data);
        console.log(garjasWanitaPushUpData);

        if (garjasWanitaPushUpData.success === false) {
          alert(garjasWanitaPushUpData.message);
        } else {
          let nipNama = garjasWanitaPushUpData.NIP_Pengguna + " - " + garjasWanitaPushUpData.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#SuntingGarjasWanitaPushUpID").val(garjasWanitaPushUpData.ID_Wanita_Push_Up);
          $("#suntingJumlahPushUpGarjasWanita").val(garjasWanitaPushUpData.Jumlah_Push_Up_Wanita);
          $("#suntingTanggalPelaksanaanPushUpGarjasWanita").val(garjasWanitaPushUpData.Tanggal_Pelaksanaan_Push_Up_Wanita);
          $("#suntingGarjasWanitaPushUp").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasWanitaPushUp").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-wanita-push-up.php",
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
              window.location.href = "../pages/data-garjas-wanita-pushup.php";
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
        $("#suntingGarjasWanitaPushUp").modal("hide");
      },
    });
  });
});
