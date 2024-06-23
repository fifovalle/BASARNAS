function konfirmasiHapusWanitaJalan(id) {
  swal({
    title: "Yakin Menghapus Tes Wanita Jalan?",
    text: "Tes wanita jalan yang dihapus tidak dapat dipulihkan!",
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
      window.location.href = "../config/delete-wanita-jalan.php?id=" + id;
    }
  });
}
