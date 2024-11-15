<?php 

function validateUser(){
    if(!getSession("id") && !getSession("token")){
     setSession("AcessoRestrito", sweetAlertError("Acesso Restrito"));
     redirect(dominio()."/login");
     exit();
    }
}

function userSession(){
  session_start();
  validateUser();
}

function dadosUsuario(){
  $usuario = new \Src\Model\Usuario;
  $id =  getSession("id");
  $usuario->id = $id;
  $select = $usuario->ById();
  $dados = $select[1];
  return $dados;
}