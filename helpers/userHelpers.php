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