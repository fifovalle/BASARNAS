$(document).ready(function () {
  $(".buttonLihatTotalGarjasPria").click(function (e) {
    e.preventDefault();
    let totalGarjasPriaID = $(this).data("id");

    if (totalGarjasPriaID === undefined) {
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
      return;
    }

    $.ajax({
      url: "../config/get-total-garjas-pria-data.php",
      method: "GET",
      data: {
        total_garjas_pria_id: totalGarjasPriaID,
      },
      success: function (data) {
        try {
          let totalGarjasPriaData = JSON.parse(data);
          if (!totalGarjasPriaData) {
            throw new Error("Data tidak valid");
          }

          if (totalGarjasPriaData.success === false) {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: totalGarjasPriaData.message,
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
            });
          } else {
            // Mengecek apakah semua nilai garjas kosong
            let allNilaiEmpty = !(
              totalGarjasPriaData.Nilai_Push_Up_Pria ||
              totalGarjasPriaData.Nilai_Sit_Up_Kaki_Lurus_Pria ||
              totalGarjasPriaData.Nilai_Sit_Up_Kaki_Di_Tekuk_Pria ||
              totalGarjasPriaData.Nilai_Shuttle_Run_Pria ||
              totalGarjasPriaData.Nilai_Menggantung_Pria ||
              totalGarjasPriaData.Nilai_Chin_Up_Pria
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
              $("#lihatNamaPenggunaTotalGarjasPria").text(
                totalGarjasPriaData.Nama_Lengkap_Pengguna
              );
              $("#lihatNIPPenggunaTotalGarjasPria").text(
                totalGarjasPriaData.NIP_Pengguna
              );
              $("#lihatPotoPenggunaTotalGarjasPria").attr(
                "src",
                "../uploads/" + totalGarjasPriaData.Foto_Pengguna
              );
              $("#lihatTglLahirPenggunaTotalGarjasPria").text(
                totalGarjasPriaData.Tanggal_Lahir_Pengguna
              );
              $("#lihatJabatanPenggunaTotalGarjasPria").text(
                totalGarjasPriaData.Jabatan_Pengguna
              );
              $("#lihatJenisKelaminPenggunaTotalGarjasPria").text(
                totalGarjasPriaData.Jenis_Kelamin_Pengguna
              );
              $("#lihatNoTelpPenggunaTotalGarjasPria").text(
                totalGarjasPriaData.No_Telepon_Pengguna
              );
              $("#lihatUmurPenggunaTotalGarjasPria").text(
                totalGarjasPriaData.Umur_Pengguna
              );
              $("#lihatNilaiPushUpPenggunaTotalGarjasPria").text(
                totalGarjasPriaData.Nilai_Push_Up_Pria
              );
              $("#lihatNilaiSitUpKakiLurusPenggunaTotalGarjasPria").text(
                totalGarjasPriaData.Nilai_Sit_Up_Kaki_Lurus_Pria
              );
              $("#lihatNilaiSitUpKakiDitekukPenggunaTotalGarjasPria").text(
                totalGarjasPriaData.Nilai_Sit_Up_Kaki_Di_Tekuk_Pria
              );
              $("#lihatNilaiShuttleRunPenggunaTotalGarjasPria").text(
                totalGarjasPriaData.Nilai_Shuttle_Run_Pria
              );
              $("#lihatNilaiFlexedArmHangPenggunaTotalGarjasPria").text(
                totalGarjasPriaData.Nilai_Menggantung_Pria
              );
              $("#lihatNilaiChinUpPenggunaTotalGarjasPria").text(
                totalGarjasPriaData.Nilai_Chin_Up_Pria
              );
              $("#lihatTotalGarjasPengguna").text(
                totalGarjasPriaData.Total_Nilai_Garjas_Pria
              );
              $("#lihatTotalGarjasPria").modal("show");
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
