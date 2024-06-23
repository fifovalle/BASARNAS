$(document).ready(function () {
  $(".buttonLihatKompetensi").click(function (e) {
    e.preventDefault();
    let kompetensiID = $(this).data("id");
    console.log(kompetensiID);
    $.ajax({
      url: "../config/get-competence.php",
      method: "GET",
      data: {
        kompetensi_id: kompetensiID,
      },
      success: function (data) {
        console.log(data);
        let terampilData = JSON.parse(data);
        console.log(terampilData);

        if (terampilData.success === false) {
          alert(terampilData.message);
        } else {
          let file = terampilData.File_Sertifikat;
          let fileExtension = file.split(".").pop().toLowerCase();
          let filePath = "../../admin/uploads/" + file;

          if (fileExtension === "pdf") {
            $("#lihatFileSertifikat").html(
              '<embed src="' +
                filePath +
                '" type="application/pdf" width="100%" height="600px" />'
            );
          } else if (fileExtension === "doc" || fileExtension === "docx") {
            $("#lihatFileSertifikat").html(
              '<a href="' + filePath + '" download>Unduh File</a>'
            );
          } else if (
            fileExtension === "jpg" ||
            fileExtension === "jpeg" ||
            fileExtension === "png" ||
            fileExtension === "gif"
          ) {
            $("#lihatFileSertifikat").html(
              '<img src="' +
                filePath +
                '" alt="Sertifikat" style="max-width:100%; height:auto;" />'
            );
          } else {
            $("#lihatFileSertifikat").html("Unsupported file type.");
          }
          $("#previewSertifikatKompetensi").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
