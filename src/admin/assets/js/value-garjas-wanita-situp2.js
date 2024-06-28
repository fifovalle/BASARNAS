$(document).ready(function () {
  $(".buttonGarjasWanitaSitUp2").click(function (e) {
    e.preventDefault();
    let garjasWanitaSitUp2ID = $(this).data("id");
    console.log(garjasWanitaSitUp2ID);
    $.ajax({
      url: "../config/get-garjas-wanita-situp2-data.php",
      method: "GET",
      data: {
        garjas_wanita_situp2_id: garjasWanitaSitUp2ID,
      },
      success: function (data) {
        console.log(data);
        let garjasSitUp2WanitaData = JSON.parse(data);
        console.log(garjasSitUp2WanitaData);

        if (garjasSitUp2WanitaData.success === false) {
          alert(garjasSitUp2WanitaData.message);
        } else {
          let nipNama =
            garjasSitUp2WanitaData.NIP_Pengguna +
            " - " +
            garjasSitUp2WanitaData.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#SuntingGarjasWanitaSitUp2ID").val(
            garjasSitUp2WanitaData.ID_Wanita_Sit_Up_Kaki_Di_Tekuk
          );
          $("#suntingJumlahSitUp2GarjasWanita").val(
            garjasSitUp2WanitaData.Jumlah_Sit_Up_Kaki_Di_Tekuk_Wanita
          );
          $("#suntingTanggalPelaksanaanSitUp2GarjasWanita").val(
            garjasSitUp2WanitaData.Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk_Wanita
          );
          $("#suntingGarjasWanitaSitUp2").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasWanitaSitUp2").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-wanita-situp2.php",
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
              window.location.href = "../pages/data-garjas-wanita-situp2.php";
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
        $("#suntingGarjasWanitaSitUp2").modal("hide");
      },
    });
  });
});
