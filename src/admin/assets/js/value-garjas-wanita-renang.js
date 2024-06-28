$(document).ready(function () {
  $(".buttonTestRenangWanita").click(function (e) {
    e.preventDefault();
    let garjasTestRenangWanita = $(this).data("id");
    console.log(garjasTestRenangWanita);
    $.ajax({
      url: "../config/get-garjas-wanita-renang-data.php",
      method: "GET",
      data: {
        test_wanita_renang_id: garjasTestRenangWanita,
      },
      success: function (data) {
        console.log(data);
        let garjasTestRenangWanitaData = JSON.parse(data);
        console.log(garjasTestRenangWanitaData);

        if (garjasTestRenangWanitaData.success === false) {
          alert(garjasTestRenangWanitaData.message);
        } else {
          let nipNama =
            garjasTestRenangWanitaData.NIP_Pengguna +
            " - " +
            garjasTestRenangWanitaData.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#SuntingGarjasWanitaRenangID").val(
            garjasTestRenangWanitaData.ID_Renang_Wanita
          );
          $("#suntingGayaRenang").val(
            garjasTestRenangWanitaData.Nama_Gaya_Renang_Wanita
          );
          $("#suntingWaktuTestRenangWanita").val(
            garjasTestRenangWanitaData.Waktu_Renang_Wanita
          );
          $("#suntingTanggalPelaksanaanTestRenangWanita").val(
            garjasTestRenangWanitaData.Tanggal_Pelaksanaan_Tes_Renang_Wanita
          );
          $("#suntingGarjasWanitaRenang").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanWaktuTestRenangWanita").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-wanita-renang.php",
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
              window.location.href = "../pages/data-garjas-wanita-renang.php";
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
        $("#suntingGarjasWanitaRenang").modal("hide");
      },
    });
  });
});
