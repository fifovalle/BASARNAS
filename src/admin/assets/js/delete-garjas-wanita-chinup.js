function konfirmasiHapusGarjasWanitaChinUp(id) {
  swal({
    title: "Yakin Menghapus Data Anggota ?",
    text: "Data yang dihapus tidak dapat dipulihkan!",
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
        "../config/delete-garjas-wanita-chinup.php?id=" + id;
    }
  });
}
