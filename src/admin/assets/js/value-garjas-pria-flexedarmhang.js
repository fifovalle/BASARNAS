$(document).ready(function () {
  $(".buttonGarjasPriaFlexedArmHang").click(function (e) {
    e.preventDefault();
    let garjasPriaFlexedArmHang = $(this).data("id");
    console.log(garjasPriaFlexedArmHang);
    $.ajax({
      url: "../config/get-garjas-pria-flexedarmhang-data.php",
      method: "GET",
      data: {
        garjas_pria_flexedarmhang_id: garjasPriaFlexedArmHang,
      },
      success: function (data) {
        console.log(data);
        let garjasPriaFlexedArmHangData = JSON.parse(data);
        console.log(garjasPriaFlexedArmHangData);

        if (garjasPriaFlexedArmHangData.success === false) {
          alert(garjasPriaFlexedArmHangData.message);
        } else {
          let nipNama =
            garjasPriaFlexedArmHangData.NIP_Pengguna +
            " - " +
            garjasPriaFlexedArmHangData.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#editGarjasPriaFlexedArmHangID").val(
            garjasPriaFlexedArmHangData.ID_Menggantung_Pria
          );
          $("#suntingWaktuFlexedArmHangAdmin").val(
            garjasPriaFlexedArmHangData.Waktu_Menggantung_Pria
          );
          $("#suntingtanggalPelaksanaanFlexedArmHangPengguna").val(
            garjasPriaFlexedArmHangData.Tanggal_Pelaksanaan_Pria_Menggantung
          );
          $("#suntingGarjasPriaFlexedArmHang").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasPriaFlexedArmHang").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-pria-flexedarmhang.php",
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
              window.location.href =
                "../pages/data-garjas-pria-flexedarmhang.php";
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
        $("#suntingGarjasPriaFlexedArmHang").modal("hide");
      },
    });
  });
});
