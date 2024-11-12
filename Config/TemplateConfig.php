<?php 

namespace Config; 

use Exception; // Importa a classe Exception para tratamento de erros
use League\Plates\Engine; // Importa a classe Engine da biblioteca Plates para renderizar templates

// Classe abstrata que define a configuração para renderização de views/templates
abstract class TemplateConfig {

    // Método protegido para renderizar uma view com dados
    // O parâmetro $view é o nome da view (arquivo PHP) a ser renderizado
    // O parâmetro $data é um array opcional com os dados a serem passados para a view
    protected function view(string $view, array $data = []){

        // Define o caminho da view com base no nome fornecido
        $path = "View/$view.php";

        // Verifica se o arquivo da view existe. Se não, lança uma exceção.
        if(!file_exists($path)){
            throw new Exception("A view {$view} não existe"); // Exceção lançada caso a view não seja encontrada
        }

        // Cria uma instância do motor de templates Plates, passando o diretório 'Web' como base para templates
        $render = new Engine("View");

        // Renderiza a view com os dados fornecidos e imprime o resultado
        echo $render->render($view, $data);
    }
}