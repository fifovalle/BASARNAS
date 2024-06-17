function konfirmasiHapusKompetensiMahir(id) {
  swal({
    title: "Yakin Menghapus Sertifikat Mahir?",
    text: "Sertifikat mahir yang dihapus tidak dapat dipulihkan!",
    icon: "warning",
    buttons: {
      cancel: {
        text: "Batal",
        value: null,
        visible: true,
        className: "",
        closeModal: true,
      },
      confirm: {
        text: "Ya, Hapus",
        value: true,
        visible: true,
        className: "",
        closeModal: true,
      },
    },
  }).then((confirm) => {
    if (confirm) {
      window.location.href =
        "../config/delete-advanced-competence.php?id=" + id;
    }
  });
}
