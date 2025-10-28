<?php
// 1. Inclui o arquivo de conexão
require_once "db.php";

// 2. Inicializa a variável $produto
$produto = null;

// 3. Verifica se um 'id' foi passado pela URL (via GET)
//    isset() verifica se a variável existe
//    is_numeric() verifica se é um número (segurança básica)
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    
    // 4. Armazena o ID de forma segura
    //    (int) força o valor a ser um número inteiro
    $id_produto = (int)$_GET['id'];

    // 5. Prepara a consulta SQL usando "Prepared Statements"
    //    Usamos um "?" (placeholder) no lugar do ID.
    //    Isso é a forma MAIS SEGURA de inserir dados do usuário em uma consulta
    //    e previne 100% contra ataques de SQL Injection.
    $sql = "SELECT * FROM produtos WHERE id = ?";
    
    // 6. Prepara o "statement" (a consulta)
    if ($stmt = $conn->prepare($sql)) {

        // 7. Vincula o parâmetro (o ID) ao "?"
        //    "i" significa que o tipo de dado é "inteiro" (integer)
        //    $id_produto é a variável que será colocada no lugar do "?"
        $stmt->bind_param("i", $id_produto);

        // 8. Executa a consulta
        $stmt->execute();

        // 9. Pega os resultados da consulta
        $resultado = $stmt->get_result();

        // 10. Verifica se encontrou algum produto
        if ($resultado->num_rows == 1) {
            // Se encontrou, pega os dados do produto e armazena na variável
            $produto = $resultado->fetch_assoc();
        }
        
        // 11. Fecha o "statement"
        $stmt->close();
    }
}

// 12. Fecha a conexão com o banco de dados
$conn->close();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
    <title><?php echo $produto ? htmlspecialchars($produto['nome']) : 'Produto não encontrado'; ?></title>
    
    </head>
<body>

    <header>
        <p><a href="index.php">&larr; Voltar para a lista</a></p>
    </header>

    <main>
        <?php
        // 13. Verifica se a variável $produto tem dados
        //     Se $produto for 'null' (porque o ID não foi passado ou não foi encontrado)
        //     ele vai pular para o "else"
        if ($produto):
        ?>

            <div class="detalhe-produto">
                
                <h1><?php echo htmlspecialchars($produto['nome']); ?></h1>

                <div class="galeria-imagens">
                    <img src="uploads/img/<?php echo htmlspecialchars($produto['imagem1']); ?>" alt="Imagem 1 de <?php echo htmlspecialchars($produto['nome']); ?>">
                    
                    <img src="uploads/img/<?php echo htmlspecialchars($produto['imagem2']); ?>" alt="Imagem 2 de <?php echo htmlspecialchars($produto['nome']); ?>">
                    
                    <img src="uploads/img/<?php echo htmlspecialchars($produto['imagem3']); ?>" alt="Imagem 3 de <?php echo htmlspecialchars($produto['nome']); ?>">
                </div>

                <div class="descricao">
                    <h2>Descrição</h2>
                    <p><?php echo nl2br(htmlspecialchars($produto['descricao'])); ?></p>
                </div>

                <div class="ficha-tecnica">
                    <h2>Ficha Técnica</h2>
                    <p>
                        <a href="uploads/pdf/<?php echo htmlspecialchars($produto['ficha_tecnica']); ?>" target="_blank">
                            Baixar Ficha Técnica (PDF)
                        </a>
                    </p>
                </div>

            </div>

        <?php
        else:
        ?>
            <h1>Produto não encontrado</h1>
            <p>O produto que você está tentando visualizar não existe ou o ID é inválido.</p>
            <p><a href="index.php">Voltar para a lista</a></p>

        <?php
        endif; // Fim do if ($produto)
        ?>
    </main>

</body>
</html>