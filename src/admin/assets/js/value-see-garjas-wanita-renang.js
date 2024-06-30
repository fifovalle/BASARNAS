$(document).ready(function () {
  $(".buttonLihatTestRenangWanita").click(function (e) {
    e.preventDefault();
    let garjasTestRenangWanitaID = $(this).data("id");
    console.log(garjasTestRenangWanitaID);

    $.ajax({
      url: "../config/get-garjas-wanita-renang-data.php",
      method: "GET",
      data: {
        test_wanita_renang_id: garjasTestRenangWanitaID,
      },
      success: function (data) {
        console.log(data);
        let penggunaData = JSON.parse(data);
        console.log(penggunaData);

        if (penggunaData.success === false) {
          alert(penggunaData.message);
        } else {
          $("#lihatNamaPengguna").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatNIPPenggunaGW").text(penggunaData.NIP_Pengguna);
          $("#lihatPotoPenggunaGW").attr("src", "../uploads/" + penggunaData.Foto_Pengguna);
          $("#lihatNamaPenggunaGW").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaGW").text(penggunaData.Tanggal_Lahir_Pengguna);
          $("#lihatAlamatPenggunaGW").text(penggunaData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaGW").text(penggunaData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaGW").text(penggunaData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaGW").text(penggunaData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaGW").text(penggunaData.Umur_Pengguna);
          $("#lihatWaktuRenangWanitaGW").text(penggunaData.Waktu_Renang_Wanita);
          $("#lihatNilaiRenangWanitaGW").text(penggunaData.Nilai_Renang_Wanita);
          $("#tanggalPelaksanaanRenangWanitaGW").text(penggunaData.Tanggal_Pelaksanaan_Tes_Renang_Wanita);
          $("#lihatGarjasWanitaRenang").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
