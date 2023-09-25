<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admim zone</title>
    <link href="../style.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php
        require_once(__DIR__.  "/../../php/classes/Compra.php");
        require_once(__DIR__ . "/../../php/classes/Cliente.php");
        require_once(__DIR__ . "/../../php/classes/Produto.php");
        require_once(__DIR__ . "/../../php/utils/utils.php");
        


         // Verifica se estou tentando fazer o cadastro de alguma coisa
    if (isMetodo("POST")) {
        if (parametrosValidos($_POST, ["nome", "qtdEstoque", "preco", "descricao"])) {
            $nome = $_POST["nome"];
            $qtdEstoque = $_POST["qtdEstoque"];
            $preco = $_POST["preco"];
            $descricao = $_POST["descricao"];

            $res = Produto::addProduto($nome, $qtdEstoque, $preco, $descricao);
            if ($res) {
                echo "Produto cadastrado com sucesso";
            } else {
                echo "Houve erro no cadastro";
            }
        }
        if (parametrosValidos($_POST, ["id", "nome", "nome_usuario", "estado", "cidade", "bairro", "rua", "nro_cartao", "nro_seguranca", "nome_cartao", "data_validade_cartao"])) {
            $res = Cliente::editarCliente($_POST["id"], $_POST["nome"], $_POST["nome_usuario"], $_POST["estado"], $_POST["cidade"], $_POST["bairro"], $_POST["rua"], $_POST["nro_cartao"], $_POST["nro_seguranca"], $_POST["nome_cartao"], $_POST["data_validade_cartao"]);
            if ($res) {
                echo "O cliente " . $_POST["nome"] . " foi editado com sucesso!";
            } else {
                echo "Erro ao editar o cliente";
            }
            die;
        } else {
            echo "Erro ao editar o cliente";
            die;
        }
    }
    $listaProdutos = Produto::listar();
    $listaClientes = Cliente::listarClientes();
    $listaCompras= Compra::listarCompras();
    ?>
    <h2>Cadastro de produtos</h2>
    <form method="POST">
        <p>Digite o nome do Produto</p>
        <input type="text" name="nome" required>
        <p>Digite a quantidade do produto</p>
        <input type="number" name="qtdEstoque" required>
        <p>Digite o preço do produto</p>
        <input type="number" name="preco">
        <p>Digite uma descrição do produto</p>
        <textarea name="descricao" cols="30" rows="10"></textarea>
        <br>
        <button>Cadastrar</button>
    </form>
    <?php
        foreach ($listaProdutos as $produto) {
                    echo "<p>" . $produto["id"] . "  " .  $produto["qtdEstoque"] . "  " . $produto["preco"] . "  " . $produto["descricao"] . "</p>";
        }
    ?>    

    <h2>Cadastro de clientes</h2>
    <form method="POST">
        <p>Digite o nome</p>
        <input type="text" name="nome" required>
        <p>Digite o nome de usuário</p>
        <input type="text" name="nome_usuario" required>
        <p>Estado</p>
        <input type="text" name="estado" required>
        <p>Cidade</p>
        <input type="text" name="cidade" required>
        <p>Bairro</p>
        <input type="text" name="bairro" required>
        <p>Rua</p>
        <input type="text" name="rua" required>
        <p>Número do cartão</p>
        <input type="text" name="nro_cartao" required>
        <p>Número de segurança</p>
        <input type="text" name="nro_seguranca" required>
        <p>Nome no cartão</p>
        <input type="text" name="nome_cartao" required>
        <p>Data de validade do cartão</p>
        <input type="date" name="data_validade_cartao" required>
        <p></p>
        <br>
        <button type="submit">Adicionar</button>
    </form>
    <?php
        foreach ($listaClientes as $cliente) {
                    echo "<p>" . $cliente["id"] . "  " . $cliente["nome"] . "  " .  $cliente["nome_usuario"] . "  " . $cliente["estado"] . "  " . $cliente["cidade"] . "  " . $cliente["bairro"] . "  " . $cliente["rua"] . "  " . $cliente["nro_cartao"] . "  " . $cliente["nro_seguranca"] . "  " . $cliente["nome_cartao"] . "  " . $cliente["data_validade_cartao"] . "</p>";
        }
    ?>

<h2>Registro de Compras</h2>
<form method="POST">
    <p>Selecionar Cliente:</p>
    <select name="idUsuario" required>
        <?php 
        foreach ($listaClientes as $cliente) { 
            echo '<option value="' . $cliente["id"] . '">' . $cliente["nome"] . '</option>';
        } 
        ?>

    </select>
    <p>Data da Compra:</p>
    <input type="datetime-local" name="dataCompra" required>
    <p>Selecionar Produtos:</p>
    <?php 
    foreach ($listaProdutos as $produto) { 
        echo '<input type="checkbox" name="produtos[]" value="' . $produto["id"] . '">';

        echo $produto["nome"] . '<br>';
    } 
    ?>

    <button type="submit">Efetuar Compra</button>
</form>

<?php
foreach ($listaCompras as $compra) {
    echo "<p>ID da Compra: " . $compra["id"] . "</p>";
    echo "<p>Cliente: " . $compra["nome_cliente"] . "</p>";

    echo "<p>Data da Compra: " . $compra["dataCompra"] . "</p>";
    
    echo "<p>Produtos Comprados:</p>";
   
    foreach ($compra["produtos"] as $produto  ) {
        echo "<p>" . $produto["nome"] . " - Quantidade: " . $produto["qtdProduto"] . "</p>";
    }
}
?>
</body>
</html>