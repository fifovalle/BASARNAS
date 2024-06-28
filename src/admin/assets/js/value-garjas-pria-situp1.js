$(document).ready(function () {
  $(".buttonGarjasPriaSitup1").click(function (e) {
    e.preventDefault();
    let garjasPriaSitUp1 = $(this).data("id");
    console.log(garjasPriaSitUp1);
    $.ajax({
      url: "../config/get-garjas-pria-situp1-data.php",
      method: "GET",
      data: {
        garjas_pria_situp1_id: garjasPriaSitUp1,
      },
      success: function (data) {
        console.log(data);
        let garjasPriaSitUp1Data = JSON.parse(data);
        console.log(garjasPriaSitUp1Data);

        if (garjasPriaSitUp1Data.success === false) {
          alert(garjasPriaSitUp1Data.message);
        } else {
          let nipNama =
            garjasPriaSitUp1Data.NIP_Pengguna +
            " - " +
            garjasPriaSitUp1Data.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#editGarjasPriaSitUp1ID").val(
            garjasPriaSitUp1Data.ID_Sit_Up_Kaki_Lurus_Pria
          );
          $("#suntingJumlahSitUp1GarjasPria").val(
            garjasPriaSitUp1Data.Jumlah_Sit_Up_Kaki_Lurus_Pria
          );
          $("#suntingTanggalPelaksanaanSitUp1GarjasPria").val(
            garjasPriaSitUp1Data.Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Pria
          );
          $("#suntingGarjasPriaSitUp1").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasPriaSitUp1").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-pria-situp1.php",
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
              window.location.href = "../pages/data-garjas-pria-situp1.php";
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
        $("#suntingGarjasPriaSitUp1").modal("hide");
      },
    });
  });
});
