<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-700">
    <?php
        session_start();
        require_once(__DIR__.  "/../../../php/classes/Compra.php");
        require_once(__DIR__ . "/../../../php/classes/Cliente.php");
        require_once(__DIR__ . "/../../../php/classes/Produto.php");
        require_once(__DIR__ . "/../../../php/utils/utils.php");
        //Verifica se estou logado e se a conexão é válida
        if(!isset($_SESSION)){
            "echo você não está logado";
            die;
        }elseif($_SESSION['adm'] == 0){
            echo "Somente adms podem acessar essa página";
            die;
        }
        elseif($_SESSION['ativo'] == 0){
            echo "Essa conta está desativada, por favor peça para um ADM reativá-la";
            die;
        }
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
            } //Verifica se estou tentando editar cliente
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
    <div class="w-screen h-[6vh] bg-white"></div>
    <div class="flex flex-col justify-center items-center w-screen">
        <div class="w-full h-full min-w-[100vw] min-h-[6vh] bg-zinc-700 flex flex-row justify-around">
            <div class="flex flex-col items-center justify-center bg-zinc-700 w-1/4 h-4/5 rounded-md p-5 text-white">
                <h2 class="font-bold text-xl font-sans">Cadastro de produtos</h2>
                <form method="POST" class="flex flex-col items-center justify-center w-2/3 gap-2">
                    <p>Digite o nome do Produto</p>
                    <input type="text" name="nome" class = "rounded text-black"required>
                    <p>Digite a quantidade do produto</p>
                    <input type="number" name="qtdEstoque" class="rounded text-black" required>
                    <p>Digite o preço do produto</p>
                    <input type="number" name="preco" class="rounded text-black">
                    <p>Digite uma descrição do produto</p>
                    <textarea name="descricao" cols="20" rows="10" class="rounded text-black"></textarea>
                    <br>
                    <button class="text-center hover:bg-purple-700 font-semibold bg-purple-600 px-5 py-1 rounded-lg outline-offset-1 outline outline-1 outline-white">Cadastrar</button>
                </form>
            </div>
            <div class="flex flex-col items-center justify-center bg-zinc-700 w-1/4 h-4/5 rounded-md p-5 text-white">
                <h2 class="font-bold text-xl font-sans">Cadastro de produtos</h2>
                <form method="POST" class="flex flex-col items-center justify-center w-2/3 gap-2">
                    <p>Digite o nome do Produto</p>
                    <input type="text" name="nome" class = "rounded text-black"required>
                    <p>Digite a quantidade do produto</p>
                    <input type="number" name="qtdEstoque" class="rounded text-black" required>
                    <p>Digite o preço do produto</p>
                    <input type="number" name="preco" class="rounded text-black">
                    <p>Digite uma descrição do produto</p>
                    <textarea name="descricao" cols="20" rows="10" class="rounded text-black"></textarea>
                    <br>
                    <button class="text-center hover:bg-purple-700 font-semibold bg-purple-600 px-5 py-1 rounded-lg outline-offset-1 outline outline-1 outline-white">Cadastrar</button>
                </form>
            </div>
            <div class="flex flex-col items-center justify-center bg-zinc-700 w-1/4 h-4/5 rounded-md p-5 text-white">
                <h2 class="font-bold text-xl font-sans">Cadastro de produtos</h2>
                <form method="POST" class="flex flex-col items-center justify-center w-2/3 gap-2">
                    <p>Digite o nome do Produto</p>
                    <input type="text" name="nome" class = "rounded text-black"required>
                    <p>Digite a quantidade do produto</p>
                    <input type="number" name="qtdEstoque" class="rounded text-black" required>
                    <p>Digite o preço do produto</p>
                    <input type="number" name="preco" class="rounded text-black">
                    <p>Digite uma descrição do produto</p>
                    <textarea name="descricao" cols="20" rows="10" class="rounded text-black"></textarea>
                    <br>
                    <button class="text-center hover:bg-purple-700 font-semibold bg-purple-600 px-5 py-1 rounded-lg outline-offset-1 outline outline-1 outline-white">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
    <div>
        <h2 class="text-white text-2xl font-bold text-center p-5">Produtos</h2>
        <div class="grid p-5 bg-zinc-700 text-white flex-col text-lg table-fixed border-spacing-2">
            <div class="col-start-1 font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">ID</div>
            <div class="col-start-2 font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Nome</div>
            <div class="col-start-3 font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Quantidade no estoque</div>
            <div class="col-start-4 font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Preço</div>
            <?php
                foreach ($listaProdutos as $produto) {
                    echo "<div class='col-start-1 border-solid border bg-zinc-700 border-zinc-500 p-2'>". $produto["id"] . "</div><div class='col-start-2 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $produto["nome"] . "</div><div class='col-start-3 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $produto["qtdEstoque"] . "</div><div class='col-start-4 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $produto["preco"] . "</div>";
                }
            ?>
        </div>
        <h2 class="text-white text-2xl font-bold text-center p-5">Clientes</h2>
        <div class="grid p-5 bg-zinc-700 text-white flex-col text-lg border-spacing-2 w-full overflow-auto">
            <div class="col-start-1 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">ID</div>
            <div class="col-start-2 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Nome</div>
            <div class="col-start-3 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Nome de Usuario</div>
            <div class="col-start-4 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Estado</div>
            <div class="col-start-5 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Cidade</div>
            <div class="col-start-6 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Bairro</div>
            <div class="col-start-7 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Rua</div>
            <div class="col-start-8 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Numero do cartão</div>
            <div class="col-start-9 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Numero de segurança</div>
            <div class="col-start-10 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Nome do cartão</div>
            <div class="col-start-11 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Data de validade do cartão</div>
            <div class="col-start-12 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Email</div>
            <div class="col-start-13 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Permissões de administrador</div>
            <div class="col-start-[14] min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Perfil ativo</div>
            <?php
                foreach ($listaClientes as $cliente) {
                    echo "<div class='col-start-1 border-solid border bg-zinc-700 border-zinc-500 p-2'>". $cliente["id"] . "</div><div class='col-start-2 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $cliente["nome"] . "</div><div class='col-start-3 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $cliente["nome_usuario"] . "</div><div class='col-start-4 border-solid border bg- zinc-700 border-zinc-500 p-2'>" . $cliente["estado"] . "</div><div class='col-start-5 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $cliente["cidade"] . "</div><div class='col-start-6 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $cliente["bairro"] . "</div><div class='col-start-7 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $cliente["rua"] . "</div><div class='col-start-8 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $cliente["nro_cartao"] . "</div><div class='col-start-9 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $cliente["nro_seguranca"] . "</div><div class='col-start-10 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $cliente["nome_cartao"] . "</div><div class='col-start-11 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $cliente["data_validade_cartao"] . "</div><div class='col-start-12 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $cliente["email"] . "</div><div class='col-start-13 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $cliente["adm"] . "</div><div class='col-start-[14] border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $cliente["ativo"] . "</div>";
                }
            ?>
        </div>
        <h2 class="text-white text-2xl font-bold text-center p-5">Compras</h2>
        <div class="grid p-5 bg-zinc-700 text-white flex-col text-lg border-spacing-2 w-full overflow-auto">
            <div class="col-start-1 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">ID</div>
            <div class="col-start-2 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">ID do Usuario</div>
            <div class="col-start-3 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Data da compra</div>
            <?php
                foreach ($listaCompras as $compra) {
                    echo "<div class='col-start-1 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $compra["id"] . "</div><div class='col-start-1 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $compra["idUsuario"] . "</div><div class='col-start-1 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $compra["dataCompra"];
                }
            ?>
        </div>
        <h2 class="text-white text-2xl font-bold text-center p-5">Registros</h2>
        <div class="grid p-5 bg-zinc-700 text-white flex-col text-lg border-spacing-2 w-full overflow-auto">
            <div class="col-start-1 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">ID</div>
            <div class="col-start-2 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">ID do Usuario</div>
            <div class="col-start-3 min-w-[10vw] font-semibold border-solid border bg-zinc-600 border-zinc-500 p-2">Data da compra</div>
            <?php
                foreach ($listaCompras as $compra) {
                    echo "<div class='col-start-1 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $compra["id"] . "</div><div class='col-start-1 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $compra["idUsuario"] . "</div><div class='col-start-1 border-solid border bg-zinc-700 border-zinc-500 p-2'>" . $compra["dataCompra"];
                }
            ?>
        </div>
</body>
</html>