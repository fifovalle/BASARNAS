const modul1Link = document.getElementById("modul1-link");
const modul2Link = document.getElementById("modul2-link");
const modul1Linked = document.getElementById("modul1-linked");
const modul2Linked = document.getElementById("modul2-linked");
const pageModul1 = document.getElementById("page-modul1");
const pageModul2 = document.getElementById("page-modul2");

const activateLink = (link) => {
  link.classList.add("activated1");
};

const deactivateLink = (link) => {
  link.classList.remove("activated1");
};
activateLink(modul1Link);
activateLink(modul1Linked);

const handleModule1Click = () => {
  activateLink(modul1Link);
  activateLink(modul1Linked);
  deactivateLink(modul2Link);
  deactivateLink(modul2Linked);
  pageModul1.style.display = "block";
  pageModul2.style.display = "none";
};
modul1Link.addEventListener("click", handleModule1Click);
modul1Linked.addEventListener("click", handleModule1Click);

const handleModule2Click = () => {
  activateLink(modul2Link);
  activateLink(modul2Linked);
  deactivateLink(modul1Link);
  deactivateLink(modul1Linked);
  pageModul2.style.display = "block";
  pageModul1.style.display = "none";
};
modul2Link.addEventListener("click", handleModule2Click);
modul2Linked.addEventListener("click", handleModule2Click);


function toggleContent(element) {
  const content = element.nextElementSibling;
  content.classList.toggle("show");
}

document.addEventListener("DOMContentLoaded", function () {
  var offcanvasElementList = [].slice.call(
    document.querySelectorAll(".offcanvas")
  );
  var offcanvasList = offcanvasElementList.map(function (offcanvasEl) {
    return new bootstrap.Offcanvas(offcanvasEl);
  });

  document.querySelectorAll(".list-group-item").forEach(function (element) {
    element.addEventListener("click", function () {
      var offcanvas = bootstrap.Offcanvas.getInstance(
        document.getElementById("offcanvasSidebar")
      );
      offcanvas.hide();
    });
  });
});
