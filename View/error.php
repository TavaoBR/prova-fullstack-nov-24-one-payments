<?=$this->layout("temas/error", ['title' => $title])?>



<div id="appErro">
    <page-erro></page-erro>
</div>

<script>
  let erro = "<?=$error?>";
  let descricao = "<?=$descricao?>"; 
</script>

<script src="<?=scriptsVueJs("error.js")?>"></script>