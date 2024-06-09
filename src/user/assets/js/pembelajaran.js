const modul1Link = document.getElementById("modul1-link");
const modul2Link = document.getElementById("modul2-link");
const modul3Link = document.getElementById("modul3-link");
const modul1Linked = document.getElementById("modul1-linked");
const modul2Linked = document.getElementById("modul2-linked");
const modul3Linked = document.getElementById("modul3-linked");
const pageModul1 = document.getElementById("page-modul1");
const pageModul2 = document.getElementById("page-modul2");
const pageModul3 = document.getElementById("page-modul3");

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
  deactivateLink(modul3Link);
  deactivateLink(modul3Linked);
  pageModul1.style.display = "block";
  pageModul2.style.display = "none";
  pageModul3.style.display = "none";
};
modul1Link.addEventListener("click", handleModule1Click);
modul1Linked.addEventListener("click", handleModule1Click);

const handleModule2Click = () => {
  activateLink(modul2Link);
  activateLink(modul2Linked);
  deactivateLink(modul1Link);
  deactivateLink(modul1Linked);
  deactivateLink(modul3Link);
  deactivateLink(modul3Linked);
  pageModul2.style.display = "block";
  pageModul1.style.display = "none";
  pageModul3.style.display = "none";
};
modul2Link.addEventListener("click", handleModule2Click);
modul2Linked.addEventListener("click", handleModule2Click);

const handleModule3Click = () => {
  activateLink(modul3Link);
  activateLink(modul3Linked);
  deactivateLink(modul1Link);
  deactivateLink(modul1Linked);
  deactivateLink(modul2Link);
  deactivateLink(modul2Linked);
  pageModul3.style.display = "block";
  pageModul1.style.display = "none";
  pageModul2.style.display = "none";
};
modul3Link.addEventListener("click", handleModule3Click);
modul3Linked.addEventListener("click", handleModule3Click);
