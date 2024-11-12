<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=Assests("/")?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=Assests("/")?>vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <script src="<?=vueJS()?>"></script>
    <script>
        var dominio = "<?=dominio()?>";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title><?=$this->e($title)?></title>
</head>
<body>
    
<?=$this->section('content')?>


</body>
</html>