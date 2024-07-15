function padNumber(number) {
  return number < 10 ? "0" + number : number;
}

function generateDownloadOptions() {
  const currentDate = new Date();
  const currentYear = currentDate.getFullYear();
  const months = [
    {
      month: 1,
      label: "Januari",
    },
    {
      month: 2,
      label: "Februari",
    },
    {
      month: 3,
      label: "Maret",
    },
    {
      month: 4,
      label: "April",
    },
    {
      month: 5,
      label: "Mei",
    },
    {
      month: 6,
      label: "Juni",
    },
    {
      month: 7,
      label: "Juli",
    },
    {
      month: 8,
      label: "Agustus",
    },
    {
      month: 9,
      label: "September",
    },
    {
      month: 10,
      label: "Oktober",
    },
    {
      month: 11,
      label: "November",
    },
    {
      month: 12,
      label: "Desember",
    },
  ];

  const downloadOptions = document.getElementById("download-options");
  downloadOptions.innerHTML = "";

  for (let i = 0; i < months.length; i++) {
    const month = months[i].month;
    const label = months[i].label;
    const year = currentYear;
    const option = document.createElement("li");
    const link = document.createElement("a");
    link.className = "dropdown-item";
    link.textContent = `${label} ${year}`;
    link.href = `../config/generate-pdf-pria-push-up.php?month=${padNumber(
      month
    )}&year=${year}`;
    option.appendChild(link);
    downloadOptions.appendChild(option);
  }
}
generateDownloadOptions();
