<?php
/* ---------------------------------------------------------------- */
/* CONFIGURAÇÕES DO BANCO DE DADOS                 */
/* ---------------------------------------------------------------- */

// Define o endereço do servidor do banco de dados (geralmente localhost)
$db_host = "localhost";

// Define o nome de usuário do banco de dados
$db_user = "root"; // (Substitua por seu usuário, se for diferente)

// Define a senha do banco de dados
$db_pass = ""; // (Substitua pela sua senha)

// Define o nome do banco de dados que você criou
$db_name = "teste"; // (Substitua pelo nome do seu DB)


/* ---------------------------------------------------------------- */
/* TENTATIVA DE CONEXÃO COM O BANCO DE DADOS            */
/* ---------------------------------------------------------------- */

// Tenta criar uma nova conexão com o banco usando a biblioteca MySQLi
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Define o conjunto de caracteres da conexão para UTF-8 (para evitar problemas com acentos)
$conn->set_charset("utf8mb4");

/* ---------------------------------------------------------------- */
/* VERIFICAÇÃO DA CONEXÃO                       */
/* ---------------------------------------------------------------- */

// Verifica se ocorreu algum erro na conexão
if ($conn->connect_error) {
    // Se houver um erro, interrompe a execução do script (die)
    // e exibe uma mensagem de erro detalhada.
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Se o script chegou até aqui, significa que a conexão foi bem-sucedida.
// Não precisamos exibir nada na tela, o script apenas termina
// e a variável $conn estará disponível para outros arquivos que incluírem este.

?>