$(document).ready(function () {
  $(".buttonGarjasPriaPushUp").click(function (e) {
    e.preventDefault();
    let garjasPushUpPria = $(this).data("id");
    console.log(garjasPushUpPria);
    $.ajax({
      url: "../config/get-garjas-pria-push-up-data.php",
      method: "GET",
      data: {
        garjas_pria_pushup_id: garjasPushUpPria,
      },
      success: function (data) {
        console.log(data);
        let garjasPriaPushUpData = JSON.parse(data);
        console.log(garjasPriaPushUpData);

        if (garjasPriaPushUpData.success === false) {
          alert(garjasPriaPushUpData.message);
        } else {
          let nipNama =
            garjasPriaPushUpData.NIP_Pengguna +
            " - " +
            garjasPriaPushUpData.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#editGarjasPriaPushUpID").val(
            garjasPriaPushUpData.ID_Push_Up_Pria
          );
          $("#suntingJumlahPushUpGarjasPria").val(
            garjasPriaPushUpData.Jumlah_Push_Up_Pria
          );
          $("#suntingTanggalPelaksanaanPushUpGarjasPria").val(
            garjasPriaPushUpData.Tanggal_Pelaksanaan_Push_Up_Pria
          );
          $("#suntingGarjasPriaPushUp").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasPriaPushUp").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-pria-push-up.php",
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
              window.location.href = "../pages/data-garjas-pria-pushup.php";
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
        $("#suntingGarjasPriaPushUp").modal("hide");
      },
    });
  });
});
