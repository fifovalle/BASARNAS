$(document).ready(function () {
  $(".buttonGarjasPriaChinUp").click(function (e) {
    e.preventDefault();
    let garjasChinUpPria = $(this).data("id");
    console.log(garjasChinUpPria);
    $.ajax({
      url: "../config/get-garjas-pria-chin-up-data.php",
      method: "GET",
      data: {
        garjas_pria_chinup_id: garjasChinUpPria,
      },
      success: function (data) {
        console.log(data);
        let garjasChinUpPriaData = JSON.parse(data);
        console.log(garjasChinUpPriaData);

        if (garjasChinUpPriaData.success === false) {
          alert(garjasChinUpPriaData.message);
        } else {
          let nipNama =
            garjasChinUpPriaData.NIP_Pengguna +
            " - " +
            garjasChinUpPriaData.Nama_Lengkap_Pengguna;
          $("#suntingNIPPengguna").val(nipNama);
          $("#editGarjasPriaChinUpID").val(
            garjasChinUpPriaData.ID_Pria_Chin_Up
          );
          $("#suntingJumlahChinUpAnggota").val(
            garjasChinUpPriaData.Jumlah_Chin_Up_Pria
          );
          $("#suntingTanggalPelaksanaanChinUpAnggota").val(
            garjasChinUpPriaData.Tanggal_Pelaksanaan_Chin_Up_Pria
          );
          $("#suntingGarjasPriaChinUp").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanGarjasPriaChinUp").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-garjas-pria-chinup.php",
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
              window.location.href = "../pages/data-garjas-pria-chinup.php";
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
        $("#suntingGarjasPriaChinUp").modal("hide");
      },
    });
  });
});
