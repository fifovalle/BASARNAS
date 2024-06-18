$(document).ready(function () {
  $(".buttonLihatKompetensiTerampil").click(function (e) {
    e.preventDefault();
    let kompetensiTerampilID = $(this).data("id");
    console.log(kompetensiTerampilID);
    $.ajax({
      url: "../config/get-data-skilled-competence.php",
      method: "GET",
      data: {
        kompetensi_terampil_id: kompetensiTerampilID,
      },
      success: function (data) {
        console.log(data);
        let terampilData = JSON.parse(data);
        let fileSertifikat = terampilData.File_Sertifikat || "defaultFile.pdf";
        let kompetensi = terampilData.Kompetensi || "Lihat Sertifikat";
        console.log(terampilData);

        if (terampilData.success === false) {
          alert(terampilData.message);
        } else {
          $("#lihatNamaLengkapTerampil").text(terampilData.Nama_Lengkap_Pengguna);
          $("#lihatFotoTerampil").attr("src", "../uploads/" + terampilData.Foto_Pengguna);
          $("#lihatNIPTerampil").text(terampilData.NIP_Pengguna);
          $("#lihatNamaPenggunaTerampilTd").text(terampilData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaTerampilTd").text(terampilData.Tanggal_Lahir_Pengguna);
          $("#lihatJabatanPenggunaTerampilTd").text(terampilData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaTerampilTd").text(terampilData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaTerampilTd").text(terampilData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaTerampilTd").text(terampilData.Umur_Pengguna);
          $("#lihatNamaSertifikatTerampilTd").text(terampilData.Nama_Sertifikat);
          $("#lihatTglPenerbitanSertifikatTerampilTd").text(terampilData.Tanggal_Penerbitan_Sertifikat);
          $("#lihatTglBerakhirSertifikatTerampilTd").text(terampilData.Tanggal_Berakhir_Sertifikat);
          $("#lihatMasaBerlakuTerampilTd").text(terampilData.Masa_Berlaku);
          $("#lihatKategoriKompetensiTerampilTd").text(terampilData.Kategori_Kompetensi);
          $("#lihatFileSertifikatTerampilTd").html('<a href="../uploads/' + fileSertifikat + '" target="_blank">' + kompetensi + "</a>");
          $("#lihatStatusTerampilTd").text(terampilData.Status);
          if (terampilData.Status === "Aktif") {
            $("#lihatStatusTerampilTd").removeClass("text-bg-danger").addClass("text-bg-success");
          } else {
            $("#lihatStatusTerampilTd").removeClass("text-bg-success").addClass("text-bg-danger");
          }
          $("#lihatKompetensiTerampil").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
