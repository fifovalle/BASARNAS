$(document).ready(function () {
  $(".buttonPriaJalan").click(function (e) {
    e.preventDefault();
    let garjasPriaTestJalanID = $(this).data("id");
    console.log(garjasPriaTestJalanID);
    $.ajax({
      url: "../config/get-garjas-pria-jalan-data.php",
      method: "GET",
      data: {
        test_pria_jalan_id: garjasPriaTestJalanID,
      },
      success: function (data) {
        console.log(data);
        let garjasPriaTestJalanData = JSON.parse(data);
        console.log(garjasPriaTestJalanData);

        if (garjasPriaTestJalanData.success === false) {
          alert(garjasPriaTestJalanData.message);
        } else {
          let nipNama =
            garjasPriaTestJalanData.NIP_Pengguna +
            " - " +
            garjasPriaTestJalanData.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#SuntingGarjasPriaJalanID").val(
            garjasPriaTestJalanData.ID_Jalan_Pria
          );
          $("#suntingWaktuGarjasPriaJalan").val(
            garjasPriaTestJalanData.Waktu_Jalan_Pria
          );
          $("#suntingTanggalPelaksanaanGarjasPriaJalan").val(
            garjasPriaTestJalanData.Tanggal_Pelaksanaan_Tes_Jalan_Pria
          );
          $("#suntingGarjasPriaJalan").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasPriaJalan").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-pria-jalan.php",
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
              window.location.href = "../pages/data-garjas-pria-jalan.php";
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
        $("#suntingGarjasPriaJalan").modal("hide");
      },
    });
  });
});
