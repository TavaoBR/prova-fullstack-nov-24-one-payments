<?php 

namespace Src\Request;

class Validate {

    public function validate($data) {
        $errors = []; // Criar um array para acumular os erros
    
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $errors[] = "O campo $key é obrigatório."; // Adiciona o erro ao array
            }
        }
    
        // Se houver erros, retorna-os como uma lista ordenada em HTML
        if (!empty($errors)) {
            return "<ol><li>" . implode("</li><li>", $errors) . "</li></ol>"; // Formata como uma lista ordenada
        }
    
        return null;
    }

    public function validarSenha(string $senha)
    {

            // Pelo menos 8 caracteres
            // Pelo menos uma letra maiúscula
            // Pelo menos uma letra minúscula
            // Pelo menos um número
            // Pelo menos um caractere especial

            $regEx = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

            if(preg_match($regEx, $senha)){
               
                return true;
            }

               return false;

    }

    public function validarEmail(string $email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }

        return false;
    }
}