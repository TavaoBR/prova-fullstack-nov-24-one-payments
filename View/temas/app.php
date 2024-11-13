<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?=$this->e($title)?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=Assests("/")?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=Assests("/")?>vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=Assests("/")?>vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?=Assests("/")?>vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?=Assests("/")?>vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?=Assests("/")?>vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?=Assests("/")?>vendor/simple-datatables/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Template Main CSS File -->
  <link href="<?=Assests("/")?>css/style.css" rel="stylesheet">

</head>

<body>

   <?php 
    include_once("View/components/header.php");
   ?>

   <?php 
    include_once("View/components/sidebar.php");
   ?>

  <main id="main" class="main">

  <?=$this->section('content')?>

  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?=Assests("/")?>vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?=Assests("/")?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=Assests("/")?>vendor/chart.js/chart.umd.js"></script>
  <script src="<?=Assests("/")?>vendor/echarts/echarts.min.js"></script>
  <script src="<?=Assests("/")?>vendor/quill/quill.js"></script>
  <script src="<?=Assests("/")?>vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?=Assests("/")?>vendor/tinymce/tinymce.min.js"></script>
  <script src="<?=Assests("/")?>vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?=Assests("/")?>js/main.js"></script>

</body>

</html>