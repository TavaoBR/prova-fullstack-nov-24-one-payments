<?php 

namespace Src\Controller\App;

use Config\TemplateConfig; 

class AppController extends TemplateConfig{

    public function index(){
        $this->view("app/index", ["title" => "Index"]);
    }

}