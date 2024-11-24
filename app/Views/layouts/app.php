<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
    <link rel="icon" href="<?= base_url('assets/img/undraw_rocket.svg') ?>">

    <title><?= isset($title) ? $title : 'Dashboard' ?> | Megavision Sales</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

    <style>
        .req:after {
            content: " *";
            color: red;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?= $this->include('layouts/sidebar') ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?= $this->include('layouts/topbar') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?= $this->include('layouts/footer') ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();

            <?php if (session()->getFlashdata('success')) : ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '<?= session()->getFlashdata('success') ?>',
                    showConfirmButton: false,
                    timer: 1500,
                    allowOutsideClick: false,
                    timerProgressBar: true
                });
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')) : ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '<?= session()->getFlashdata('errors') ?>',
                    showConfirmButton: false,
                    timer: 2000,
                    allowOutsideClick: false,
                    timerProgressBar: true
                });
            <?php endif; ?>

            $('.logoutButton').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'question',
                    title: 'Logout',
                    text: 'Are you sure you want to logout?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    confirmButtonColor: '#d33',
                    cancelButtonText: 'No',
                    showLoaderOnConfirm: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '<?= route_to('logout') ?>';
                    }
                });
            });

            $('.genereteAPIKeys').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'question',
                    title: 'Generate API Key',
                    text: 'Are you sure you want to generate a new API key?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    showLoaderOnConfirm: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?= site_url('api/keys/create') ?>',
                            type: 'POST',
                            data: {
                                userId: '<?= auth()->id() ?>'
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.success + ' : ' + response.api_key,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'OK',
                                });
                            }
                        });
                    }
                });
            });

            $('.seeAPIKeys').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?= site_url('api/keys/show') ?>',
                    type: 'GET',
                    data: {
                        userId: '<?= auth()->id() ?>'
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.error,
                                allowOutsideClick: false,
                                confirmButtonText: 'OK',
                            });
                            return;
                        }
                        Swal.fire({
                            icon: 'info',
                            title: 'API Key',
                            text: 'Your API Key is : ' + response.api_key + ' and will expire at ' + response.expires_at,
                            allowOutsideClick: false,
                            confirmButtonText: 'OK',
                        });
                    }
                });
            });

            $('.settingsButton').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'info',
                    title: 'Settings',
                    text: 'This feature is not available yet.',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
            });
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>