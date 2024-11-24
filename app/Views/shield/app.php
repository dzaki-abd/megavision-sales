<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400&display=swap" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/undraw_rocket.svg') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/shield/fonts/icomoon/style.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/shield/css/owl.carousel.min.css') ?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/shield/css/bootstrap.min.css') ?>">

    <!-- Style -->
    <link rel="stylesheet" href="<?= base_url('assets/shield/css/style.css') ?>">

    <title><?= $this->renderSection('title') ?> | Megavision Sales</title>
</head>

<body>
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('<?= base_url('assets/shield/images/bg_1.jpg') ?>');"></div>
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/shield/js/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/shield/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/shield/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/shield/js/main.js') ?>"></script>
</body>

</html>