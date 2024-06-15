function togglePasswordVisibilityUser(inputId, eyeIconId) {
  let passwordInput = document.getElementById(inputId);
  let eyeIcon = document.getElementById(eyeIconId);

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    eyeIcon.classList.remove("bi-eye");
    eyeIcon.classList.add("bi-eye-slash");
  } else {
    passwordInput.type = "password";
    eyeIcon.classList.remove("bi-eye-slash");
    eyeIcon.classList.add("bi-eye");
  }
}

document
  .getElementById("toggleKataSandiPengguna")
  .addEventListener("click", function () {
    togglePasswordVisibilityUser(
      "tambahKataSandiPengguna",
      "toggleKataSandiPengguna"
    );
  });

document
  .getElementById("toggleKonfirmasiKataSandiPengguna")
  .addEventListener("click", function () {
    togglePasswordVisibilityUser(
      "tambahKonfirmasiKataSandiPengguna",
      "toggleKonfirmasiKataSandiPengguna"
    );
  });
