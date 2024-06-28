$(document).ready(function () {
  let now = new Date(Date.now());

  let jakartaTimeOffset = 7 * 60 * 60 * 1000;
  let jakartaTime = new Date(now.getTime() + jakartaTimeOffset);
  let hours = jakartaTime.getUTCHours();

  let btnHadir = $("#btnHadirRabu");
  let btnSelesai = $("#btnSelesaiRabu");

  let presensiHadir = localStorage.getItem("presensi_hadir_rabu");
  let presensiSelesai = localStorage.getItem("presensi_selesai_rabu");

  if (hours >= 7 && hours < 8 && !presensiHadir) {
    btnSelesai.hide();
    Swal.fire({
      icon: "info",
      title: "Sekarang waktu untuk presensi pagi Rabu.",
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
  } else if (hours >= 17 && hours < 18 && !presensiSelesai) {
    btnHadir.hide();
    btnSelesai.hide();
    Swal.fire({
      icon: "info",
      title: "Sekarang waktu untuk presensi sore Rabu.",
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
    (hours === 6 && !presensiHadir) ||
    (hours === 16 && !presensiSelesai)
  ) {
    btnHadir.hide();
    btnSelesai.hide();
    Swal.fire({
      icon: "info",
      title: "Presensi akan muncul dalam 1 jam Rabu.",
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
    localStorage.setItem("presensi_hadir_rabu", true);
  });

  btnSelesai.click(function () {
    localStorage.setItem("presensi_selesai_rabu", true);
  });

  let dayOfWeek = now.getDay();
  let daysUntilNextWednesday = dayOfWeek === 3 ? 7 : (3 + 7 - dayOfWeek) % 7;
  let nextWednesday = new Date(
    now.getTime() + daysUntilNextWednesday * 24 * 60 * 60 * 1000
  );

  let formattedNextWednesday = nextWednesday.toLocaleDateString("id-ID", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  });

  $("#moduleRabu").text(formattedNextWednesday);

  $.ajax({
    url: "http://localhost/BASARNAS/src/user/config/get-monday-modul.php",
    method: "POST",
    data: { Tanggal: nextWednesday.toISOString().split("T")[0] },
    success: function (response) {
      console.log("Response dari server:", response);
      if (response.modul_tersedia) {
        $("#moduleContainer2").html(response.html);
      } else {
        $("#moduleContainer2").html(
          "<p>Modul tidak tersedia untuk tanggal tersebut.</p>"
        );
      }
    },
    error: function () {
      console.error("Error checking module availability");
    },
  });
});
