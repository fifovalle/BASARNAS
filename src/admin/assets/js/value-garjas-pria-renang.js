$(document).ready(function () {
  $(".buttonGarjasPriaTestRenang").click(function (e) {
    e.preventDefault();
    let garjasTestRenangPria = $(this).data("id");
    console.log(garjasTestRenangPria);
    $.ajax({
      url: "../config/get-garjas-pria-renang-data.php",
      method: "GET",
      data: {
        test_pria_renang_id: garjasTestRenangPria,
      },
      success: function (data) {
        console.log(data);
        let garjasTestRenangPriaData = JSON.parse(data);
        console.log(garjasTestRenangPriaData);

        if (garjasTestRenangPriaData.success === false) {
          alert(garjasTestRenangPriaData.message);
        } else {
          let nipNama =
            garjasTestRenangPriaData.NIP_Pengguna +
            " - " +
            garjasTestRenangPriaData.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#suntingGarjasPriaRenangID").val(
            garjasTestRenangPriaData.ID_Renang_Pria
          );
          $("#suntingGayaRenangPria").val(
            garjasTestRenangPriaData.Nama_Gaya_Renang_Pria
          );
          $("#suntingWaktuTestRenangPria").val(
            garjasTestRenangPriaData.Waktu_Renang_Pria
          );
          $("#suntingTanggalPelaksanaanTestRenangPria").val(
            garjasTestRenangPriaData.Tanggal_Pelaksanaan_Tes_Renang_Pria
          );
          $("#suntingGarjasPriaRenang").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasPriaTestRenang").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-pria-renang.php",
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
              window.location.href = "../pages/data-garjas-pria-renang.php";
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
        $("#suntingGarjasPriaRenang").modal("hide");
      },
    });
  });
});
