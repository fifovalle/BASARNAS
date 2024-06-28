$(document).ready(function () {
  $(".buttonGarjasWanitaChinUp").click(function (e) {
    e.preventDefault();
    let garjasWanitaChinUpID = $(this).data("id");
    console.log(garjasWanitaChinUpID);
    $.ajax({
      url: "../config/get-garjas-wanita-chinup-data.php",
      method: "GET",
      data: {
        garjas_wanita_chinup_id: garjasWanitaChinUpID,
      },
      success: function (data) {
        console.log(data);
        let garjasWanitaChinUpData = JSON.parse(data);
        console.log(garjasWanitaChinUpData);

        if (garjasWanitaChinUpData.success === false) {
          alert(garjasWanitaChinUpData.message);
        } else {
          let nipNama =
            garjasWanitaChinUpData.NIP_Pengguna +
            " - " +
            garjasWanitaChinUpData.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#SuntingGarjasWanitaChinUpID").val(
            garjasWanitaChinUpData.ID_Wanita_Chin_Up
          );
          $("#suntingJumlahChinUpGarjasWanita").val(
            garjasWanitaChinUpData.Jumlah_Chin_Up_Wanita
          );
          $("#suntingTanggalPelaksanaanChinUpGarjasWanita").val(
            garjasWanitaChinUpData.Tanggal_Pelaksanaan_Chin_Up_Wanita
          );
          $("#suntingGarjasWanitaChinUp").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasWanitaChinUp").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-wanita-chinup.php",
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
              window.location.href = "../pages/data-garjas-wanita-chinup.php";
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
        $("#suntingGarjasWanitaChinUp").modal("hide");
      },
    });
  });
});
