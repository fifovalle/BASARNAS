$(document).ready(function () {
  $(".buttonLihatKompetensiPemula").click(function (e) {
    e.preventDefault();
    let kompetensiPemulaID = $(this).data("id");
    console.log(kompetensiPemulaID);
    $.ajax({
      url: "../config/get-data-beginner-competence.php",
      method: "GET",
      data: {
        kompetensi_pemula_id: kompetensiPemulaID,
      },
      success: function (data) {
        console.log(data);
        let pemulaData = JSON.parse(data);
        let fileSertifikat = pemulaData.File_Sertifikat || "defaultFile.pdf";
        let kompetensi = pemulaData.Kompetensi || "Lihat Sertifikat";
        console.log(pemulaData);

        if (pemulaData.success === false) {
          alert(pemulaData.message);
        } else {
          $("#lihatNamaLengkapPemula").text(pemulaData.Nama_Lengkap_Pengguna);
          $("#lihatFotoPemula").attr("src", "../uploads/" + pemulaData.Foto_Pengguna);
          $("#lihatNIPPemula").text(pemulaData.NIP_Pengguna);
          $("#lihatNamaPenggunaPemulaTd").text(pemulaData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaPemulaTd").text(pemulaData.Tanggal_Lahir_Pengguna);
          $("#lihatJabatanPenggunaPemulaTd").text(pemulaData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaPemulaTd").text(pemulaData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaPemulaTd").text(pemulaData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaPemulaTd").text(pemulaData.Umur_Pengguna);
          $("#lihatNamaSertifikatPemulaTd").text(pemulaData.Nama_Sertifikat);
          $("#lihatTglPenerbitanSertifikatPemulaTd").text(pemulaData.Tanggal_Penerbitan_Sertifikat);
          $("#lihatTglBerakhirSertifikatPemulaTd").text(pemulaData.Tanggal_Berakhir_Sertifikat);
          $("#lihatMasaBerlakuPemulaTd").text(pemulaData.Masa_Berlaku);
          $("#lihatKategoriKompetensiPemulaTd").text(pemulaData.Kategori_Kompetensi);
          $("#lihatFileSertifikatPemulaTd").html('<a href="../uploads/' + fileSertifikat + '" target="_blank">' + kompetensi + "</a>");
          $("#lihatStatusPemulaTd").text(pemulaData.Status);
          if (pemulaData.Status === "Aktif") {
            $("#lihatStatusPemulaTd").removeClass("text-bg-danger").addClass("text-bg-success");
          } else {
            $("#lihatStatusPemulaTd").removeClass("text-bg-success").addClass("text-bg-danger");
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
