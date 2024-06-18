$(document).ready(function () {
  $(".buttonLihatKompetensiMahir").click(function (e) {
    e.preventDefault();
    let kompetensiMahirID = $(this).data("id");
    console.log(kompetensiMahirID);
    $.ajax({
      url: "../config/get-data-advanced-competence.php",
      method: "GET",
      data: {
        kompetensi_mahir_id: kompetensiMahirID,
      },
      success: function (data) {
        console.log(data);
        let mahirData = JSON.parse(data);
        let fileSertifikat = mahirData.File_Sertifikat || "defaultFile.pdf";
        let kompetensi = mahirData.Kompetensi || "Lihat Sertifikat";
        console.log(mahirData);

        if (mahirData.success === false) {
          alert(mahirData.message);
        } else {
          $("#lihatNamaLengkapMahir").text(mahirData.Nama_Lengkap_Pengguna);
          $("#lihatFotoMahir").attr("src", "../uploads/" + mahirData.Foto_Pengguna);
          $("#lihatNIPMahir").text(mahirData.NIP_Pengguna);
          $("#lihatNamaPenggunaMahirTd").text(mahirData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaMahirTd").text(mahirData.Tanggal_Lahir_Pengguna);
          $("#lihatJabatanPenggunaMahirTd").text(mahirData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaMahirTd").text(mahirData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaMahirTd").text(mahirData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaMahirTd").text(mahirData.Umur_Pengguna);
          $("#lihatNamaSertifikatMahirTd").text(mahirData.Nama_Sertifikat);
          $("#lihatTglPenerbitanSertifikatMahirTd").text(mahirData.Tanggal_Penerbitan_Sertifikat);
          $("#lihatTglBerakhirSertifikatMahirTd").text(mahirData.Tanggal_Berakhir_Sertifikat);
          $("#lihatMasaBerlakuMahirTd").text(mahirData.Masa_Berlaku);
          $("#lihatKategoriKompetensiMahirTd").text(mahirData.Kategori_Kompetensi);
          $("#lihatFileSertifikatMahirTd").html('<a href="../uploads/' + fileSertifikat + '" target="_blank">' + kompetensi + "</a>");
          $("#lihatStatusMahirTd").text(mahirData.Status);
          if (mahirData.Status === "Aktif") {
            $("#lihatStatusMahirTd").removeClass("text-bg-danger").addClass("text-bg-success");
          } else {
            $("#lihatStatusMahirTd").removeClass("text-bg-success").addClass("text-bg-danger");
          }
          $("#lihatKompetensiMahir").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
