<?php 

namespace Src\Database; 

use PDO;

class Connection {
    private static $connection = null;

    // Método para estabelecer e retornar a conexão com o banco de dados
    public static function connect()
    {
        // Verifica se já existe uma conexão ativa
        if (!self::$connection) {
            // Cria uma nova conexão PDO utilizando as variáveis de ambiente
            self::$connection = new PDO($_ENV['HOST_DB'] . ":host=" . $_ENV['HOST_DB'] . ";port=" . $_ENV['PORT_DB'] . ";dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
        }

        return self::$connection;
    }

}
