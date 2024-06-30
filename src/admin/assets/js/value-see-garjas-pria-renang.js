$(document).ready(function () {
  $(".buttonLihatTestRenangPria").click(function (e) {
    e.preventDefault();
    let garjasTestRenangPriaID = $(this).data("id");
    console.log(garjasTestRenangPriaID);

    $.ajax({
      url: "../config/get-garjas-pria-renang-data.php",
      method: "GET",
      data: {
        test_pria_renang_id: garjasTestRenangPriaID,
      },
      success: function (data) {
        console.log(data);
        let penggunaData = JSON.parse(data);
        console.log(penggunaData);

        if (penggunaData.success === false) {
          alert(penggunaData.message);
        } else {
          $("#lihatNamaPengguna").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatNIPPenggunaTd").text(penggunaData.NIP_Pengguna);
          $("#lihatPotoPenggunaTd").attr("src", "../uploads/" + penggunaData.Foto_Pengguna);
          $("#lihatNamaPenggunaTd").text(penggunaData.Nama_Lengkap_Pengguna);
          $("#lihatTglLahirPenggunaTd").text(penggunaData.Tanggal_Lahir_Pengguna);
          $("#lihatAlamatPenggunaTd").text(penggunaData.Alamat_Pengguna);
          $("#lihatJabatanPenggunaTd").text(penggunaData.Jabatan_Pengguna);
          $("#lihatJenisKelaminPenggunaTd").text(penggunaData.Jenis_Kelamin_Pengguna);
          $("#lihatNoTelpPenggunaTd").text(penggunaData.No_Telepon_Pengguna);
          $("#lihatUmurPenggunaTd").text(penggunaData.Umur_Pengguna);
          $("#lihatWaktuRenangPriaTd").text(penggunaData.Waktu_Renang_Pria);
          $("#lihatNilaiRenangPriaTd").text(penggunaData.Nilai_Renang_Pria);
          $("#tanggalPelaksanaanRenangPriaTd").text(penggunaData.Tanggal_Pelaksanaan_Tes_Renang_Pria);
          $("#lihatGarjasPriaRenang").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
