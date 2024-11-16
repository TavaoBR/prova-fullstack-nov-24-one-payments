<?=$this->layout("temas/app", ['title' => $title])?>

<link rel="stylesheet" href="<?=Assests("/")?>css/transacoes.css">

<div id="appTransacoes">
  <transacoes :dados="dados"></transacoes>
</div>

<script>
  let transacaoJson = <?= json_encode($dados, JSON_HEX_TAG) ?>;
</script>

<script src="<?= scriptsVueJs("transacoes.js") ?>"></script>