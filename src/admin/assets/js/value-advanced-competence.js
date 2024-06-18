$(document).ready(function () {
  $(".buttonKompetensiMahir").click(function (e) {
    e.preventDefault();
    let kompetensiMahir = $(this).data("id");
    console.log(kompetensiMahir);
    $.ajax({
      url: "../config/get-data-advanced-competence.php",
      method: "GET",
      data: {
        kompetensi_mahir_id: kompetensiMahir,
      },
      success: function (data) {
        console.log(data);
        let mahirData = JSON.parse(data);
        console.log(mahirData);

        if (mahirData.success === false) {
          alert(mahirData.message);
        } else {
          $("#suntingIDKompetensi").val(mahirData.ID_Kompetensi);
          $("#suntingNIPPengguna").val(mahirData.NIP_Pengguna + " - " + mahirData.Nama_Lengkap_Pengguna);
          $("#suntingTanggalLahirPengguna").val(mahirData.Tanggal_Lahir_Pengguna);
          $("#suntingNamaSertifikat").val(mahirData.Nama_Sertifikat);
          $("#suntingTanggalPenerbitan").val(mahirData.Tanggal_Penerbitan_Sertifikat);
          $("#suntingTanggalBerakhir").val(mahirData.Tanggal_Berakhir_Sertifikat);
          $("#suntingKategoriKompetensi").val(mahirData.Kategori_Kompetensi);
          $("#suntingStatus").val(mahirData.Status);
          $("#suntingKompetensiMahir").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSuntingMahir").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-advanced-competence.php",
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
              window.location.href = "../pages/data-advanced-competence.php";
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
        $("#suntingKompetensiMahir").modal("hide");
      },
    });
  });
});
