$(document).ready(function () {
  $(".buttonGarjasTesLariWanita").click(function (e) {
    e.preventDefault();
    let garjasWanitaTestLariID = $(this).data("id");
    console.log(garjasWanitaTestLariID);
    $.ajax({
      url: "../config/get-garjas-wanita-lari-data.php",
      method: "GET",
      data: {
        test_wanita_lari_id: garjasWanitaTestLariID,
      },
      success: function (data) {
        console.log(data);
        let garjasWanitaTestLariData = JSON.parse(data);
        console.log(garjasWanitaTestLariData);

        if (garjasWanitaTestLariData.success === false) {
          alert(garjasWanitaTestLariData.message);
        } else {
          let nipNama =
            garjasWanitaTestLariData.NIP_Pengguna +
            " - " +
            garjasWanitaTestLariData.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#SuntingGarjasWanitaLariID").val(
            garjasWanitaTestLariData.ID_Lari_Wanita
          );
          $("#suntingWaktuGarjasWanitaLari").val(
            garjasWanitaTestLariData.Waktu_Lari_Wanita
          );
          $("#suntingTanggalPelaksanaanGarjasWanitaLari").val(
            garjasWanitaTestLariData.Tanggal_Pelaksanaan_Tes_Lari_Wanita
          );
          $("#suntingGarjasWanitaLari").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasWanitaLari").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-wanita-lari.php",
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
              window.location.href = "../pages/data-garjas-wanita-lari.php";
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
        $("#suntingGarjasWanitaLari").modal("hide");
      },
    });
  });
});
