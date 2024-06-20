function konfirmasiHapusPriaJalan(id) {
  swal({
    title: "Yakin Menghapus Tes Pria Jalan?",
    text: "Tes pria jalan yang dihapus tidak dapat dipulihkan!",
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
      window.location.href = "../config/delete-pria-jalan.php?id=" + id;
    }
  });
}
