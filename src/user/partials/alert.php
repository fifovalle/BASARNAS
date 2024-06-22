<script>
    $(document).ready(function() {
        <?php
        if (isset($_SESSION['gagal']) && !empty($_SESSION['gagal'])) {
        ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo $_SESSION['gagal']; ?>',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                customClass: {
                    popup: 'alert-message',
                    title: 'alert-title',
                    content: 'alert-content'
                }
            });
        <?php
            unset($_SESSION['gagal']);
        }
        if (isset($_SESSION['berhasil']) && !empty($_SESSION['berhasil'])) {
        ?>
            Swal.fire({
                icon: 'success',
                title: '<?php echo $_SESSION['berhasil']; ?>',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                customClass: {
                    popup: 'alert-message',
                    title: 'alert-title',
                    content: 'alert-content'
                }
            });
        <?php
            unset($_SESSION['berhasil']);
        }
        ?>
    });
</script>