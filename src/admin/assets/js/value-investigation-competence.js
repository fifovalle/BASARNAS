$(document).ready(function () {
  $(".buttonKompetensiPenyelia").click(function (e) {
    e.preventDefault();
    let kompetensiPenyelia = $(this).data("id");
    console.log(kompetensiPenyelia);
    $.ajax({
      url: "../config/get-data-investigation-competence.php",
      method: "GET",
      data: {
        kompetensi_penyelia_id: kompetensiPenyelia,
      },
      success: function (data) {
        console.log(data);
        let penyeliaData = JSON.parse(data);
        console.log(penyeliaData);

        if (penyeliaData.success === false) {
          alert(penyeliaData.message);
        } else {
          $("#suntingIDKompetensi").val(penyeliaData.ID_Kompetensi);
          $("#suntingNIPPengguna").val(
            penyeliaData.NIP_Pengguna +
              " - " +
              penyeliaData.Nama_Lengkap_Pengguna
          );
          $("#suntingTanggalLahirPengguna").val(
            penyeliaData.Tanggal_Lahir_Pengguna
          );
          $("#suntingNamaSertifikat").val(penyeliaData.Nama_Sertifikat);
          $("#suntingTanggalPenerbitan").val(
            penyeliaData.Tanggal_Penerbitan_Sertifikat
          );
          $("#suntingTanggalBerakhir").val(
            penyeliaData.Tanggal_Berakhir_Sertifikat
          );
          $("#suntingKategoriKompetensi").val(penyeliaData.Kategori_Kompetensi);
          $("#suntingStatus").val(penyeliaData.Status);
          $("#suntingKompetensiPenyelia").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSuntingPenyelia").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-Investigation-competence.php",
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
                "../pages/data-investigation-competence.php";
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
        $("#suntingKompetensiPenyelia").modal("hide");
      },
    });
  });
});
