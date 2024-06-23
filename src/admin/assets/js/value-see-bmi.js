$(document).ready(function () {
  $(".buttonLihatBMI").click(function (e) {
    e.preventDefault();
    let bmiID = $(this).data("id");
    console.log(bmiID);
    $.ajax({
      url: "../config/get-data-bmi.php",
      method: "GET",
      data: {
        bmi_id: bmiID,
      },
      success: function (data) {
        console.log(data);
        let terampilData = JSON.parse(data);
        console.log(terampilData);

        if (terampilData.success === false) {
          alert(terampilData.message);
        } else {
          $("#lihatNamaLengkapTerampil").text(
            terampilData.Nama_Lengkap_Pengguna
          );
          $("#lihatFotoTerampil").attr(
            "src",
            "../uploads/" + terampilData.Foto_Pengguna
          );
          $("#lihatNIPTerampil").text(terampilData.NIP_Pengguna);
          $("#lihatNamaPenggunaTerampilTd").text(
            terampilData.Nama_Lengkap_Pengguna
          );
          $("#lihatTglLahirPenggunaTerampilTd").text(
            terampilData.Tanggal_Lahir_Pengguna
          );
          $("#lihatJabatanPenggunaTerampilTd").text(
            terampilData.Jabatan_Pengguna
          );
          $("#lihatJenisKelaminPenggunaTerampilTd").text(
            terampilData.Jenis_Kelamin_Pengguna
          );
          $("#lihatNoTelpPenggunaTerampilTd").text(
            terampilData.No_Telepon_Pengguna
          );
          $("#lihatUmurPenggunaTerampilTd").text(terampilData.Umur_Pengguna);
          $("#tanggalPemeriksaanTd").text(terampilData.Tanggal_Pemeriksaan);
          $("#tinggiTd").text(terampilData.Tinggi_BMI);
          $("#beratTd").text(terampilData.Berat_BMI);
          $("#skorTd").text(terampilData.Skor);
          let keterangan = terampilData.Keterangan;
          let badge = "";
          let teks = "";
          switch (keterangan) {
            case "Berat Badan Kurang":
              badge = "badge badge-warning";
              teks = "Kurus";
              break;
            case "Berat Badan Normal":
              badge = "badge badge-success";
              teks = "Ideal";
              break;
            case "Berat Badan Lebih":
              badge = "badge badge-info";
              teks = "Gemuk";
              break;
            case "Obesitas":
              badge = "badge badge-danger";
              teks = "Obesitas";
              break;
            default:
              badge = "badge badge-secondary";
          }
          $("#ketTd").html('<span class="' + badge + '">' + teks + "</span>");
          $("#lihatBMI").modal("show");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });
});
