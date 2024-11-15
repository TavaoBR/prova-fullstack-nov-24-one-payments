<?=$this->layout("temas/app", ['title' => $title])?>

<?php 
if($conta > 0):
?>


<script>
    let transacao_id = "<?=$dados->transacao_id?>";
    let descricao = "<?=$dados->descricao?>"
</script>


<?php 
 if($dados->status == "Aprovado"):
?>

<div id="aprovado">
 <aprovado></aprovado>
</div>



<script src="<?=scriptsVueJs("payments/aprovado.js")?>"></script>

<?php 
 endif;
?>



<?php 
 if($dados->status == "Reprovada"):
?>

<div id="rejeitado">
 <rejeitado></rejeitado>
</div>


<script src="<?=scriptsVueJs("payments/reprovada.js")?>"></script>

<?php 
 endif;
?>

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