$(document).ready(function () {
  $(".buttonBMI").click(function (e) {
    e.preventDefault();
    let bmiID = $(this).data("id");
    console.log(bmiID);
    $.ajax({
      url: "../config/get-data-bmi.php",
      method: "GET",
      data: {
        bmi_id: bmiID,
      },
      success: function (data) {
        console.log(data);
        let terampilData = JSON.parse(data);
        console.log(terampilData);

        if (terampilData.success === false) {
          alert(terampilData.message);
        } else {
          $("#idBMI").val(terampilData.ID_BMI);
          $("#suntingNIPPenggunaBMI").val(
            terampilData.NIP_Pengguna +
              " - " +
              terampilData.Nama_Lengkap_Pengguna
          );
          $("#suntingTinggiBMI").val(terampilData.Tinggi_BMI);
          $("#suntingBeratBMI").val(terampilData.Berat_BMI);
          $("#suntingBMI").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanBMI").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-bmi.php",
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
              window.location.href = "../pages/data-bmi.php";
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
        $("#suntingBMI").modal("hide");
      },
    });
  });
});
