$(document).ready(function () {
  $(".buttonKompetensiPemula").click(function (e) {
    e.preventDefault();
    let kompetensiPemula = $(this).data("id");
    console.log(kompetensiPemula);
    $.ajax({
      url: "../config/get-data-beginner-competence.php",
      method: "GET",
      data: {
        kompetensi_pemula_id: kompetensiPemula,
      },
      success: function (data) {
        console.log(data);
        let pemulaData = JSON.parse(data);
        console.log(pemulaData);

        if (pemulaData.success === false) {
          alert(pemulaData.message);
        } else {
          $("#suntingIDKompetensi").val(pemulaData.ID_Kompetensi);
          $("#suntingNIPPengguna").val(pemulaData.NIP_Pengguna + " - " + pemulaData.Nama_Lengkap_Pengguna);
          $("#suntingTanggalLahirPengguna").val(pemulaData.Tanggal_Lahir_Pengguna);
          $("#suntingNamaSertifikat").val(pemulaData.Nama_Sertifikat);
          $("#suntingTanggalPenerbitan").val(pemulaData.Tanggal_Penerbitan_Sertifikat);
          $("#suntingTanggalBerakhir").val(pemulaData.Tanggal_Berakhir_Sertifikat);
          $("#suntingKategoriKompetensi").val(pemulaData.Kategori_Kompetensi);
          $("#suntingStatus").val(pemulaData.Status);
          $("#suntingKompetensiPemula").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSuntingPemula").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-beginner-competence.php",
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
              window.location.href = "../pages/data-beginner-competence.php";
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
        $("#suntingKompetensiPemula").modal("hide");
      },
    });
  });
});
