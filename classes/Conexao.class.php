<?php
class Conexao
{
    // Armazena a instância única da conexão com o banco de dados, propriedade estática
    private static $connect;
    // Método estático público, usado para obter uma conexão com o banco de dados
    public static function getConexao()
    {
        // Verifica se a propriedade estática &connect ainda não foi inicializada
        if (!isset(self::$connect)) {
            // Criando uma instância da classe PDO
            self::$connect = new PDO('mysql:host=localhost;dbname=esfihariagemeosdb', 'root', '');
            // Retorna a instância da conexão
            return self::$connect;
        } else {
            return self::$connect;
        }
    }
}
?>