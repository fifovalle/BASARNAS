$(document).ready(function () {
  $(".buttonLihatKompetensiTerampil").click(function (e) {
    e.preventDefault();
    let kompetensiTerampilID = $(this).data("id");
    console.log(kompetensiTerampilID);
    $.ajax({
      url: "../config/get-data-skilled-competence.php",
      method: "GET",
      data: {
        kompetensi_pemula_id: kompetensiPemulaID,
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
          $("#lihatNamaLengkapPemula").text(terampilData.Nama_Lengkap_Pengguna);
          $("#lihatFotoPemula").attr(
            "src",
            "../uploads/" + terampilData.Foto_Pengguna
          );
          $("#lihatNIPPemula").text(terampilData.NIP_Pengguna);
          $("#lihatNamaPenggunaPemulaTd").text(
            terampilData.Nama_Lengkap_Pengguna
          );
          $("#lihatTglLahirPenggunaPemulaTd").text(
            terampilData.Tanggal_Lahir_Pengguna
          );
          $("#lihatJabatanPenggunaPemulaTd").text(
            terampilData.Jabatan_Pengguna
          );
          $("#lihatJenisKelaminPenggunaPemulaTd").text(
            terampilData.Jenis_Kelamin_Pengguna
          );
          $("#lihatNoTelpPenggunaPemulaTd").text(
            terampilData.No_Telepon_Pengguna
          );
          $("#lihatUmurPenggunaPemulaTd").text(terampilData.Umur_Pengguna);
          $("#lihatNamaSertifikatPemulaTd").text(terampilData.Nama_Sertifikat);
          $("#lihatTglPenerbitanSertifikatPemulaTd").text(
            terampilData.Tanggal_Penerbitan_Sertifikat
          );
          $("#lihatTglBerakhirSertifikatPemulaTd").text(
            terampilData.Tanggal_Berakhir_Sertifikat
          );
          $("#lihatMasaBerlakuPemulaTd").text(terampilData.Masa_Berlaku);
          $("#lihatKategoriKompetensiPemulaTd").text(
            terampilData.Kategori_Kompetensi
          );
          $("#lihatFileSertifikatPemulaTd").html(
            '<a href="../uploads/' +
              fileSertifikat +
              '" target="_blank">' +
              kompetensi +
              "</a>"
          );
          $("#lihatStatusPemulaTd").text(terampilData.Status);
          if (terampilData.Status === "Aktif") {
            $("#lihatStatusPemulaTd")
              .removeClass("text-bg-danger")
              .addClass("text-bg-success");
          } else {
            $("#lihatStatusPemulaTd")
              .removeClass("text-bg-success")
              .addClass("text-bg-danger");
          }
          $("#lihatKompetensiPemula").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
