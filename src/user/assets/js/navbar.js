document.addEventListener("DOMContentLoaded", function () {
  let navLinks = document.querySelectorAll(".nav-link");

  function removeActivatedClass() {
    navLinks.forEach((link) => {
      link.classList.remove("activated");
    });
  }

  function activateLink() {
    let path = window.location.pathname;
    let page = path.split("/").pop();
    removeActivatedClass();
    if (page === "index.php") {
      document.getElementById("beranda").classList.add("activated");
    } else if (page === "samapta.php") {
      document.getElementById("samapta").classList.add("activated");
    } else if (page === "bmi.php") {
      document.getElementById("bmi").classList.add("activated");
    } else if (page === "pembelajaran.php") {
      document.getElementById("pembelajaran").classList.add("activated");
    }
  }
  activateLink();

  navLinks.forEach((link) => {
    link.addEventListener("click", function () {
      removeActivatedClass();
      this.classList.add("activated");
    });
  });
});
