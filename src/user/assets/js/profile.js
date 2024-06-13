document
  .getElementById("change-profile-link")
  .addEventListener("click", function (event) {
    event.preventDefault();
    document.getElementById("profile-upload").click();
  });

function uploadProfilePicture(event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      document.querySelector(".profile-picture").src = e.target.result;
    };
    reader.readAsDataURL(file);
  }
}
