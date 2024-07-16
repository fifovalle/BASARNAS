$(document).ready(function () {
  let now = new Date(Date.now());

  let jakartaTimeOffset = 7 * 60 * 60 * 1000;
  let jakartaTime = new Date(now.getTime() + jakartaTimeOffset);
  let hours = jakartaTime.getUTCHours();
  let dayOfWeek = jakartaTime.getDay();

  let btnHadir = $("#btnHadir");
  let btnSelesai = $("#btnSelesai");

  let presensiHadir = localStorage.getItem("presensi_hadir");
  let presensiSelesai = localStorage.getItem("presensi_selesai");

  if (dayOfWeek === 1) {
    if (hours >= 6 && hours < 9 && !presensiHadir) {
      btnSelesai.hide();
      Swal.fire({
        icon: "info",
        title: "Sekarang waktu untuk presensi pagi Senin.",
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
    } else if (hours >= 18 && hours < 20 && !presensiSelesai) {
      btnHadir.hide();
      btnSelesai.hide();
      Swal.fire({
        icon: "info",
        title: "Sekarang waktu untuk presensi sore Senin.",
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
      (hours === 5 && !presensiHadir) ||
      (hours === 17 && !presensiSelesai)
    ) {
      btnHadir.hide();
      btnSelesai.hide();
      Swal.fire({
        icon: "info",
        title: "Presensi akan muncul dalam 1 jam Senin.",
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

  let daysUntilNextMonday = dayOfWeek === 1 ? 7 : (1 + 7 - dayOfWeek) % 7;
  let nextMonday = new Date(
    now.getTime() + daysUntilNextMonday * 24 * 60 * 60 * 1000
  );

  let formattedNextMonday = nextMonday.toLocaleDateString("id-ID", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  });

  $("#moduleSenin").text(formattedNextMonday);

  $.ajax({
    url: "http://localhost/BASARNAS/src/user/config/get-monday-modul.php",
    method: "POST",
    data: { Tanggal: nextMonday.toISOString().split("T")[0] },
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
