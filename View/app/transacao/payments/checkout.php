<?=$this->layout("temas/app", ['title' => $title])?>

<link rel="stylesheet" href="<?=Assests("/")?>css/checkout.css">

<?php 
if($conta > 0):

if($dados->status != "Pedente"){
    redirect(dominio()."/app/transacao/pagemnto/status/$dados->transacao_id/$dados->status");
}

?>

<script>
    let Status = "<?=$dados->status?>";
    let comprador = "<?=$dados->beneficiario?>";
    let produto = "<?=$dados->produto?>";
    let valor = "<?=$dados->valor?>";
    let transacao_id = "<?=$dados->transacao_id?>";
</script>

<div id="checkout">
 <checkout></checkout>
</div>

<script src="<?=scriptsVueJs("payments/checkout.js")?>"></script>




<?php 
else:
?>

<div id="checkout-not-found">
 <checkout-not-found></checkout-not-found>
</div>

<script src="<?=scriptsVueJs("payments/transacaoNaoencontrada.js")?>"></script>

<?php 
 endif;
?>



