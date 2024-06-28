$(document).ready(function () {
  $(".buttonGarjasTestLariPria").click(function (e) {
    e.preventDefault();
    let garjasPriaTestLariID = $(this).data("id");
    console.log(garjasPriaTestLariID);
    $.ajax({
      url: "../config/get-garjas-pria-lari-data.php",
      method: "GET",
      data: {
        test_pria_lari_id: garjasPriaTestLariID,
      },
      success: function (data) {
        console.log(data);
        let garjasPriaTestLariData = JSON.parse(data);
        console.log(garjasPriaTestLariData);

        if (garjasPriaTestLariData.success === false) {
          alert(garjasPriaTestLariData.message);
        } else {
          let nipNama =
            garjasPriaTestLariData.NIP_Pengguna +
            " - " +
            garjasPriaTestLariData.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#SuntingGarjasPriaLariID").val(
            garjasPriaTestLariData.ID_Lari_Pria
          );
          $("#suntingWaktuGarjasPriaLari").val(
            garjasPriaTestLariData.Waktu_Lari_Pria
          );
          $("#suntingTanggalPelaksanaanGarjasPriaLari").val(
            garjasPriaTestLariData.Tanggal_Pelaksanaan_Tes_Lari_Pria
          );
          $("#suntingGarjasPriaLari").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasPriaLari").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-pria-lari.php",
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
              window.location.href = "../pages/data-garjas-pria-lari.php";
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
        $("#suntingGarjasPriaLari").modal("hide");
      },
    });
  });
});
