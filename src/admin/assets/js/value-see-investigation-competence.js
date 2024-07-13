$(document).ready(function () {
  $(".buttonLihatKompetensiPenyelia").click(function (e) {
    e.preventDefault();
    let kompetensiPenyeliaID = $(this).data("id");
    console.log(kompetensiPenyeliaID);
    $.ajax({
      url: "../config/get-data-investigation-competence.php",
      method: "GET",
      data: {
        kompetensi_penyelia_id: kompetensiPenyeliaID,
      },
      success: function (data) {
        console.log(data);
        let penyeliaData = JSON.parse(data);
        let fileSertifikat = penyeliaData.File_Sertifikat || "defaultFile.pdf";
        let kompetensi = penyeliaData.Kompetensi || "Lihat Sertifikat";
        console.log(penyeliaData);

        if (penyeliaData.success === false) {
          alert(penyeliaData.message);
        } else {
          $("#lihatNamaLengkapPenyelia").text(
            penyeliaData.Nama_Lengkap_Pengguna
          );
          $("#lihatFotoPenyelia").attr(
            "src",
            "../uploads/" + penyeliaData.Foto_Pengguna
          );
          $("#lihatNIPPenyelia").text(penyeliaData.NIP_Pengguna);
          $("#lihatNamaPenggunaPenyeliaTd").text(
            penyeliaData.Nama_Lengkap_Pengguna
          );
          $("#lihatTglLahirPenggunaPenyeliaTd").text(
            penyeliaData.Tanggal_Lahir_Pengguna
          );
          $("#lihatJabatanPenggunaPenyeliaTd").text(
            penyeliaData.Jabatan_Pengguna
          );
          $("#lihatJenisKelaminPenggunaPenyeliaTd").text(
            penyeliaData.Jenis_Kelamin_Pengguna
          );
          $("#lihatNoTelpPenggunaPenyeliaTd").text(
            penyeliaData.No_Telepon_Pengguna
          );
          $("#lihatUmurPenggunaPenyeliaTd").text(penyeliaData.Umur_Pengguna);
          $("#lihatNamaSertifikatPenyeliaTd").text(
            penyeliaData.Nama_Sertifikat
          );
          $("#lihatTglPenerbitanSertifikatPenyeliaTd").text(
            penyeliaData.Tanggal_Penerbitan_Sertifikat
          );
          $("#lihatTglBerakhirSertifikatPenyeliaTd").text(
            penyeliaData.Tanggal_Berakhir_Sertifikat
          );
          $("#lihatMasaBerlakuPenyeliaTd").text(penyeliaData.Masa_Berlaku);
          $("#lihatKategoriKompetensiPenyeliaTd").text(
            penyeliaData.Kategori_Kompetensi
          );
          $("#lihatFileSertifikatPenyeliaTd").html(
            '<a href="../uploads/' +
              fileSertifikat +
              '" target="_blank">' +
              kompetensi +
              "</a>"
          );
          $("#lihatStatusPenyeliaTd").text(penyeliaData.Status);
          if (penyeliaData.Status === "Aktif") {
            $("#lihatStatusPenyeliaTd")
              .removeClass("text-bg-danger")
              .addClass("text-bg-success");
          } else {
            $("#lihatStatusPenyeliaTd")
              .removeClass("text-bg-success")
              .addClass("text-bg-danger");
          }
          $("#lihatKompetensiPenyelia").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
