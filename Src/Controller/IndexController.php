<?php 

namespace Src\Controller;

use Config\TemplateConfig; 

class IndexController extends TemplateConfig{

    public function index(){
        include_once("View/index.php");
    }

    public function login(){
        session_start();
        $this->view("login", ["title" => "Login"]);
    }

    public function registro(){
        $this->view("registro", ["title" => "Registro"]);
    }

}