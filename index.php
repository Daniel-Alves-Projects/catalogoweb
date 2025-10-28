<?php
// 1. Inclui o arquivo de conexão com o banco de dados
//    Isso nos dá acesso à variável $conn que definimos em db.php
require_once "db.php";

// 2. Prepara e executa a consulta SQL para buscar os produtos
//    "SELECT id, nome, imagem1 FROM produtos" seleciona apenas as colunas que precisamos para a lista.
//    "ORDER BY nome ASC" ordena os produtos por nome, em ordem alfabética (A-Z).
$sql = "SELECT id, nome, imagem1 FROM produtos ORDER BY nome ASC";
$resultado = $conn->query($sql);

// 3. Fecha a conexão com o banco de dados
//    Não precisamos mais do banco nesta página, então fechamos a conexão.
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Nossos Produtos</title>
    </head>
<body>

    <header>
        <h1>Confira Nossos Produtos</h1>
    </header>

    <main>
        <div class="lista-produtos">
            
            <?php
            // 4. Verifica se a consulta retornou algum produto
            if ($resultado->num_rows > 0) {
                
                // 5. Inicia um loop "while" para percorrer cada linha (produto)
                //    $resultado->fetch_assoc() pega uma linha de cada vez e a transforma em um array
                //    onde os nomes das colunas (ex: 'nome') são as chaves.
                while ($produto = $resultado->fetch_assoc()) {
            ?>

                    <div class="produto-card">
                        
                        <a href="produto.php?id=<?php echo htmlspecialchars($produto['id']); ?>">
                            
                            <img src="uploads/img/<?php echo htmlspecialchars($produto['imagem1']); ?>" 
                                 alt="Imagem de <?php echo htmlspecialchars($produto['nome']); ?>">
                            
                            <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
                        
                        </a>
                    </div>

            <?php
                // 7. Fim do loop "while"
                }
            } else {
                // 8. Mensagem caso não haja nenhum produto cadastrado no banco
                echo "<p>Nenhum produto encontrado.</p>";
            }
            ?>

        </div> </main>

</body>
</html>