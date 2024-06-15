document.getElementById("file").addEventListener("change", function (event) {
  const fileInput = event.target;
  const fileName = fileInput.files[0] ? fileInput.files[0].name : "";

  if (fileName) {
    const boxFileUpload = document.querySelector(".box-file-upload p");
    boxFileUpload.innerHTML = `${fileName} <box-icon type='solid' name='trash' class='delete-icon'></box-icon>`;
    document.querySelector(".box-file-upload").style.display = "block";
    document.querySelector(".upload-file").style.display = "none";
  } else {
    resetUpload();
  }

  // Add event listener to the delete icon
  document.querySelector(".delete-icon").addEventListener("click", resetUpload);
});

function resetUpload() {
  document.querySelector(".box-file-upload").style.display = "none";
  document.querySelector(".upload-file").style.display = "flex";
  document.getElementById("file").value = ""; // Clear the file input
}

// Reset the view on page load
document.addEventListener("DOMContentLoaded", function () {
  resetUpload();
});

$(document).ready(function () {
  $("#previewTrigger").click(function () {
    $("#previewSertifikatKompetensi").modal("show");
  });
});
