$(document).ready(function () {
  $(".buttonLihatModul").click(function (e) {
    e.preventDefault();
    let modulID = $(this).data("id");
    console.log(modulID);
    $.ajax({
      url: "../config/get-data-modul.php",
      method: "GET",
      data: {
        modul_id: modulID,
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
          $("#lihatNamaModulTd").text(terampilData.Nama_Modul);
          let lokasiPenyimpanan = "../uploads/" + terampilData.File_Modul;
          let ekstensiFile = terampilData.File_Modul.split(".")
            .pop()
            .toLowerCase();
          let embedCode = "";
          switch (ekstensiFile) {
            case "pdf":
              embedCode =
                '<embed src="' +
                lokasiPenyimpanan +
                '" type="application/pdf" width="100%" height="600px" />';
              break;
            case "doc":
            case "docx":
            case "xls":
            case "xlsx":
              embedCode =
                '<a href="' + lokasiPenyimpanan + '" download>Unduh File</a>';
              break;
            default:
              embedCode = '<a href="' + lokasiPenyimpanan + '">Unduh File</a>';
              break;
          }
          $("#lihatFileModulTd").html(embedCode);
          $("#lihatJudulModulTd").text(terampilData.Judul_Modul);
          $("#lihatTanggalTerbitModulTd").text(
            terampilData.Tanggal_Terbit_Modul
          );
          $("#lihatDeskripsiModulTd").text(terampilData.Deskripsi_Modul);
          $("#lihatModul").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
