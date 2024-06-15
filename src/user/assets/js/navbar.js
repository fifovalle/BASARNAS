document.addEventListener("DOMContentLoaded", function () {
  const navLinks = document.querySelectorAll(".nav-link");
  const dropdownItems = document.querySelectorAll(".dropdown-item");

  function removeActivatedClass() {
    navLinks.forEach((link) => {
      link.classList.remove("activated");
    });
    dropdownItems.forEach((item) => {
      item.classList.remove("activated");
    });
  }

  function activateLink() {
    const path = window.location.pathname;
    const page = path.split("/").pop();
    removeActivatedClass();
    switch (page) {
      case "index.php":
        document.getElementById("beranda").classList.add("activated");
        break;
      case "lari.php":
        document.getElementById("samapta").classList.add("activated");
        document.getElementById("lari").classList.add("activated");
        break;
      case "renang.php":
        document.getElementById("samapta").classList.add("activated");
        document.getElementById("renang").classList.add("activated");
        break;
      case "jalan-kaki.php":
        document.getElementById("samapta").classList.add("activated");
        document.getElementById("jalan-kaki").classList.add("activated");
        break;
      case "pushup.php":
        document.getElementById("samapta").classList.add("activated");
        document.getElementById("pushup").classList.add("activated");
        break;
      case "situp1.php":
        document.getElementById("samapta").classList.add("activated");
        document.getElementById("situp1").classList.add("activated");
        break;
      case "situp2.php":
        document.getElementById("samapta").classList.add("activated");
        document.getElementById("situp2").classList.add("activated");
        break;
      case "chinup.php":
        document.getElementById("samapta").classList.add("activated");
        document.getElementById("chinup").classList.add("activated");
        break;
      case "shuttlerun.php":
        document.getElementById("samapta").classList.add("activated");
        document.getElementById("shuttlerun").classList.add("activated");
        break;
      case "flexedarmhang.php":
        document.getElementById("samapta").classList.add("activated");
        document.getElementById("flexedarmhang").classList.add("activated");
        break;
      case "bmi.php":
        document.getElementById("bmi").classList.add("activated");
        break;
      case "pembelajaran.php":
        document.getElementById("pembelajaran").classList.add("activated");
        break;
      case "kompetensi.php":
        document.getElementById("kompetensi").classList.add("activated");
        break;
      case "profile.php":
        document.getElementById("profil").classList.add("activated");
        document.getElementById("pengaturan").classList.add("activated");
        break;
      default:
        break;
    }
  }

  activateLink();

  navLinks.forEach((link) => {
    link.addEventListener("click", function () {
      removeActivatedClass();
      this.classList.add("activated");
    });
  });

  dropdownItems.forEach((item) => {
    item.addEventListener("click", function () {
      removeActivatedClass();
      this.classList.add("activated");
      if (this.id === "pengaturan") {
        document.getElementById("profil").classList.add("activated");
      }
    });
  });
});
