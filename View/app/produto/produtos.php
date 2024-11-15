<?=$this->layout("temas/app", ['title' => $title])?>


<link rel="stylesheet" href="<?=Assests("/")?>css/produtos.css">

<div id="appProdutos">
    <produto-section :dados="dados"></produto-section>
</div>

<script>
    let dadosProduto = <?=json_encode($dados)?>;
</script>

<script src="<?=scriptsVueJs("produto/produtos.js")?>"></script>