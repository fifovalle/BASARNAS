$(document).ready(function () {
  $(".buttonKompetensiTerampil").click(function (e) {
    e.preventDefault();
    let kompetensiTerampil = $(this).data("id");
    console.log(kompetensiTerampil);
    $.ajax({
      url: "../config/get-data-skilled-competence.php",
      method: "GET",
      data: {
        kompetensi_terampil_id: kompetensiTerampil,
      },
      success: function (data) {
        console.log(data);
        let terampilData = JSON.parse(data);
        console.log(terampilData);

        if (terampilData.success === false) {
          alert(terampilData.message);
        } else {
          $("#suntingIDKompetensi").val(terampilData.ID_Kompetensi);
          $("#suntingNIPPengguna").val(terampilData.NIP_Pengguna + " - " + terampilData.Nama_Lengkap_Pengguna);
          $("#suntingTanggalLahirPengguna").val(terampilData.Tanggal_Lahir_Pengguna);
          $("#suntingNamaSertifikat").val(terampilData.Nama_Sertifikat);
          $("#suntingTanggalPenerbitan").val(terampilData.Tanggal_Penerbitan_Sertifikat);
          $("#suntingTanggalBerakhir").val(terampilData.Tanggal_Berakhir_Sertifikat);
          $("#suntingKategoriKompetensi").val(terampilData.Kategori_Kompetensi);
          $("#suntingStatus").val(terampilData.Status);
          $("#suntingKompetensiTerampil").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSuntingTerampil").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-skilled-competence.php",
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
              window.location.href = "../pages/data-skilled-competence.php";
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
        $("#suntingKompetensiTerampil").modal("hide");
      },
    });
  });
});
