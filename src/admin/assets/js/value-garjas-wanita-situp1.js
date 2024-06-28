$(document).ready(function () {
  $(".buttonGarjasWanitaSitUp1").click(function (e) {
    e.preventDefault();
    let garjasWanitaSitUp1ID = $(this).data("id");
    console.log(garjasWanitaSitUp1ID);
    $.ajax({
      url: "../config/get-garjas-wanita-situp1-data.php",
      method: "GET",
      data: {
        garjas_wanita_situp1_id: garjasWanitaSitUp1ID,
      },
      success: function (data) {
        console.log(data);
        let garjasSitUp1WanitaData = JSON.parse(data);
        console.log(garjasSitUp1WanitaData);

        if (garjasSitUp1WanitaData.success === false) {
          alert(garjasSitUp1WanitaData.message);
        } else {
          let nipNama =
            garjasSitUp1WanitaData.NIP_Pengguna +
            " - " +
            garjasSitUp1WanitaData.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#SuntingGarjasWanitaSitUp1ID").val(
            garjasSitUp1WanitaData.ID_Wanita_Sit_Up_Kaki_Lurus
          );
          $("#suntingJumlahSitUp1GarjasWanita").val(
            garjasSitUp1WanitaData.Jumlah_Sit_Up_Kaki_Lurus_Wanita
          );
          $("#suntingTanggalPelaksanaanSitUp1GarjasWanita").val(
            garjasSitUp1WanitaData.Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Wanita
          );
          $("#suntingGarjasWanitaSitUp1").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasWanitaSitUp1").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-wanita-situp1.php",
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
