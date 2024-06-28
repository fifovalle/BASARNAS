$(document).ready(function () {
  $(".buttonGarjasPriaSitup2").click(function (e) {
    e.preventDefault();
    let garjasPriaSitUp2 = $(this).data("id");
    console.log(garjasPriaSitUp2);
    $.ajax({
      url: "../config/get-garjas-pria-situp2-data.php",
      method: "GET",
      data: {
        garjas_pria_situp2_id: garjasPriaSitUp2,
      },
      success: function (data) {
        console.log(data);
        let garjasPriaSitUp2Data = JSON.parse(data);
        console.log(garjasPriaSitUp2Data);

        if (garjasPriaSitUp2Data.success === false) {
          alert(garjasPriaSitUp2Data.message);
        } else {
          let nipNama =
            garjasPriaSitUp2Data.NIP_Pengguna +
            " - " +
            garjasPriaSitUp2Data.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#editGarjasPriaSitUp2ID").val(
            garjasPriaSitUp2Data.ID_Sit_Up_Kaki_Di_Tekuk_Pria
          );
          $("#suntingJumlahSitUp2Anggota").val(
            garjasPriaSitUp2Data.Jumlah_Sit_Up_Kaki_Di_Tekuk_Pria
          );
          $("#suntingTanggalPelaksanaanSitUp2Anggota").val(
            garjasPriaSitUp2Data.Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk
          );
          $("#suntingGarjasPriaSitUp2").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasPriaSitUp2").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-pria-situp2.php",
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
              window.location.href = "../pages/data-garjas-pria-situp2.php";
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
        $("#suntingGarjasPriaSitUp2").modal("hide");
      },
    });
  });
});
