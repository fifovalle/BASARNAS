$(document).ready(function () {
  $(".buttonLihatTotalGarjasWanita").click(function (e) {
    e.preventDefault();
    let totalGarjasWanitaID = $(this).data("id");

    if (totalGarjasWanitaID === undefined) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "ID tidak ditemukan. Silakan coba lagi.",
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
      });
      return; // Hentikan eksekusi lebih lanjut jika ID tidak ada
    }

    $.ajax({
      url: "../config/get-total-garjas-wanita-data.php",
      method: "GET",
      data: {
        total_garjas_wanita_id: totalGarjasWanitaID,
      },
      success: function (data) {
        try {
          let totalGarjasWanitaData = JSON.parse(data);
          if (!totalGarjasWanitaData) {
            throw new Error("Data tidak valid");
          }

          if (totalGarjasWanitaData.success === false) {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: totalGarjasWanitaData.message,
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
            });
          } else {
            // Mengecek apakah semua nilai garjas kosong
            let allNilaiEmpty = !(
              totalGarjasWanitaData.Nilai_Push_Up_Wanita ||
              totalGarjasWanitaData.Nilai_Sit_Up_Kaki_Lurus_Wanita ||
              totalGarjasWanitaData.Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita ||
              totalGarjasWanitaData.Nilai_Shuttle_Run_Wanita ||
              totalGarjasWanitaData.Nilai_Chin_Up_Wanita
            );

            if (allNilaiEmpty) {
              Swal.fire({
                icon: "info",
                title: "Informasi",
                text: "Data sedang diproses atau nilai-nilai harus diisi semuanya.",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
              });
            } else {
              // Menampilkan data pengguna
              $("#lihatNamaPenggunaTotalGarjasWanita").text(
                totalGarjasWanitaData.Nama_Lengkap_Pengguna
              );
              $("#lihatNIPPenggunaTotalGarjasWanita").text(
                totalGarjasWanitaData.NIP_Pengguna
              );
              $("#lihatPotoPenggunaTotalGarjasWanita").attr(
                "src",
                "../uploads/" + totalGarjasWanitaData.Foto_Pengguna
              );
              $("#lihatTglLahirPenggunaTotalGarjasWanita").text(
                totalGarjasWanitaData.Tanggal_Lahir_Pengguna
              );
              $("#lihatJabatanPenggunaTotalGarjasWanita").text(
                totalGarjasWanitaData.Jabatan_Pengguna
              );
              $("#lihatJenisKelaminPenggunaTotalGarjasWanita").text(
                totalGarjasWanitaData.Jenis_Kelamin_Pengguna
              );
              $("#lihatNoTelpPenggunaTotalGarjasWanita").text(
                totalGarjasWanitaData.No_Telepon_Pengguna
              );
              $("#lihatUmurPenggunaTotalGarjasWanita").text(
                totalGarjasWanitaData.Umur_Pengguna
              );
              $("#lihatNilaiPushUpPenggunaTotalGarjasWanita").text(
                totalGarjasWanitaData.Nilai_Push_Up_Wanita
              );
              $("#lihatNilaiSitUpKakiLurusPenggunaTotalGarjasWanita").text(
                totalGarjasWanitaData.Nilai_Sit_Up_Kaki_Lurus_Wanita
              );
              $("#lihatNilaiSitUpKakiDitekukPenggunaTotalGarjasWanita").text(
                totalGarjasWanitaData.Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita
              );
              $("#lihatNilaiShuttleRunPenggunaTotalGarjasWanita").text(
                totalGarjasWanitaData.Nilai_Shuttle_Run_Wanita
              );
              $("#lihatNilaiChinUpPenggunaTotalGarjasWanita").text(
                totalGarjasWanitaData.Nilai_Chin_Up_Wanita
              );
              $("#lihatTotalGarjasPengguna").text(
                totalGarjasWanitaData.Total_Nilai_Garjas_Wanita
              );
              $("#lihatTotalGarjasWanita").modal("show");
            }
          }
        } catch (error) {
          Swal.fire({
            icon: "info",
            title: "Informasi",
            text: "Data sedang diproses atau nilai-nilai harus diisi semuanya.",
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
          });
          console.error(error);
        }
      },
      error: function (xhr) {
        Swal.fire({
          icon: "info",
          title: "Informasi",
          text: "Data sedang diproses atau nilai-nilai harus diisi semuanya.",
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
        });
        console.error(xhr.responseText);
      },
    });
  });
});
