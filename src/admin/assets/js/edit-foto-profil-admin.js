document
  .getElementById("editImageButton")
  .addEventListener("click", function () {
    document.getElementById("profileImageInput").click();
  });

document
  .getElementById("profileImageInput")
  .addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById("profile-picture").src = e.target.result;
      };
      reader.readAsDataURL(file);
      document.querySelector("form").submit();
    }
  });
