$(document).ready(function () {
  let sekarang = new Date(Date.now());

  let offsetWaktuJakarta = 7 * 60 * 60 * 1000;
  let waktuJakarta = new Date(sekarang.getTime() + offsetWaktuJakarta);
  let jam = waktuJakarta.getUTCHours();

  let btnHadir = $("#btnHadir");
  let btnSelesai = $("#btnSelesai");

  let presensiHadir = localStorage.getItem("presensi_hadir");
  let presensiSelesai = localStorage.getItem("presensi_selesai");

  if (jam >= 12 && jam <= 18 && !presensiHadir) {
    btnSelesai.hide();
    Swal.fire({
      icon: "info",
      title: "Sekarang waktu untuk presensi pagi.",
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      customClass: {
        popup: "alert-message",
        title: "alert-title",
        content: "alert-content",
      },
    });
  } else if (jam >= 12 && jam <= 18 && !presensiSelesai) {
    btnHadir.hide();
    Swal.fire({
      icon: "info",
      title: "Sekarang waktu untuk presensi sore.",
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      customClass: {
        popup: "alert-message",
        title: "alert-title",
        content: "alert-content",
      },
    });
  } else if (
    (jam === 6 && !presensiHadir) ||
    (jam === 16 && !presensiSelesai)
  ) {
    btnHadir.hide();
    btnSelesai.hide();
    Swal.fire({
      icon: "info",
      title: "Presensi akan muncul dalam 1 jam lagi.",
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      customClass: {
        popup: "alert-message",
        title: "alert-title",
        content: "alert-content",
      },
    });
  } else {
    btnHadir.hide();
    btnSelesai.hide();
  }

  btnHadir.click(function () {
    localStorage.setItem("presensi_hadir", true);
  });

  btnSelesai.click(function () {
    localStorage.setItem("presensi_selesai", true);
  });

  let hariDalamMinggu = sekarang.getDay();
  let hariSampaiSeninDepan = hariDalamMinggu === 0 ? 1 : 8 - hariDalamMinggu;
  let seninDepan = new Date(
    sekarang.getTime() + hariSampaiSeninDepan * 24 * 60 * 60 * 1000
  );

  let seninDepanTerformat = seninDepan.toLocaleDateString("id-ID", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  });

  $("#moduleSenin").text(seninDepanTerformat);

  $.ajax({
    url: "http://localhost/BASARNAS/src/user/config/get-monday-modul.php",
    method: "POST",
    data: { Tanggal: seninDepan.toISOString().split("T")[0] },
    success: function (response) {
      console.log("Response dari server:", response);
      if (response.modul_tersedia) {
        $("#moduleContainer").html(response.html);
      } else {
        $("#moduleContainer").html(
          "<p>Modul tidak tersedia untuk tanggal tersebut.</p>"
        );
      }
    },
    error: function () {
      console.error("Error checking module availability");
    },
  });
});
