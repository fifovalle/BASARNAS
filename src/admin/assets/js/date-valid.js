$(document).ready(function () {
  $("#tambahTanggalTerbitModul").on("input", function () {
    let inputDate = new Date($(this).val());
    let today = new Date();
    today.setHours(0, 0, 0, 0);
    let day = inputDate.getUTCDay();
    if (inputDate < today || (day !== 1 && day !== 3)) {
      $(this).val("");
      Swal.fire({
        icon: "error",
        title: "Tanggal Terbit Tidak Sesuai",
        text: "Silakan pilih hari Senin atau Rabu di masa mendatang.",
      });
    }
  });
});
