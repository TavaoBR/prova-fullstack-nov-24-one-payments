<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=Assests("/")?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="<?=vueJS()?>"></script>
    <link rel="stylesheet" href="<?=Assests("/")?>css/error.css">
    <title><?=$this->e($title)?></title>
</head>
<body>
    <?=$this->section('content')?>
</body>
</html>