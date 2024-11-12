<?php

//Pegando o dominio que está rodando a aplicação para integrar no sistema de rotass
function dominio(){
   return "http://localhost/prova-fullstack-nov-24-one-payments";  
}

function Assests(string $path){
  return dominio()."/Public/assets/$path";
}

function vueJS(){
   return dominio()."/Public/vue/vue.js";
}

function scriptsVueJs(string $path){
   return dominio()."/Public/vue/$path";
}

function redirect(string $to){
   return header("Location: {$to}");
}

function redirectBack(){
   $paginaAnterior = $_SERVER['HTTP_REFERER'];
   return header("Location: {$paginaAnterior}"); 
}


function messageSuccess(string $message, string $id = null){
   $alerta = "
   <div class='alert alert-success alert-dismissible fade show' role='alert'>
   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
   {$message}
   </div>

 ";
  return $alerta;
}

function messageError(string $message, string $id = null){
  $alerta = "<p class='alert alert-danger' id='{$id}'>{$message}</p>";
  return $alerta;
}

function messageWarning(string $message, string $id = null){
   $alerta = "
   <div class='alert alert-warning alert-dismissible fade show' role='alert'>
   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
   {$message}
   </div>

 ";
  return $alerta;
}


function sweetAlertSuccess(string $message, string $title = null){

   if($title == "" OR $title == null){
       $title = "Não está esquecendo algo";
    }

   $sweet = "
   <script>

   function alert(){
       Swal.fire({
           icon: 'success',
           title: '$title',
           text: '$message',
         });
   }

   alert();
   
   </script>
";

return $sweet;
}

function sweetAlertWarning(string $message, string $title = null){
  
   if($title == "" OR $title == null){
      $title = "Não está esquecendo algo";
   }

   $sweet = "
   <script>

   function alert(){
       Swal.fire({
           icon: 'info',
           title: '$title',
           text: '$message',
         });
   }

   alert()

  
   </script>
";

return $sweet;
}

function sweetAlertError(string $message){
 $sweet = "
     <script>
     function alert(){
       Swal.fire({
           icon: 'error',
           title: 'Ocorreu um erro',
           text: '$message',
         });
     }

     alert()
       
    
     </script>
 ";
 
 return $sweet;
}