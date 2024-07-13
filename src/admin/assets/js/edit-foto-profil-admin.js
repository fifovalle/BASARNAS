document
  .getElementById("editImageButton")
  .addEventListener("click", function () {
    document.getElementById("profileImageInput").click();
  });

function uploadProfilePicture(event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      document.getElementById("profile-picture").src = e.target.result;
    };
    reader.readAsDataURL(file);

    const formData = new FormData();
    formData.append("Foto_Admin", file);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../config/edit-foto-profil-admin.php", true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        if (response.success) {
          document.getElementById(
            "profile-picture"
          ).src = `../uploads/${response.newImage}`;
          Swal.fire({
            icon: "success",
            title: "Sukses!",
            text: response.message,
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: response.message,
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
          });
        }
      }
    };
    xhr.send(formData);
  }
}
