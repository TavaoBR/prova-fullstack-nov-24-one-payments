<?php 

function validateUser(){
    if(!getSession("id") && !getSession("token")){
     setSession("Mensagem", sweetAlertError("Acesso Restrito"));
     redirect(dominio()."/app/login");
     exit();
    }
}

function userSession(){
  session_start();
  validateUser();
}