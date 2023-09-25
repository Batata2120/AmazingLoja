<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../style.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php
        require_once(__DIR__.  "/../../php/classes/Compra.php");
        require_once(__DIR__ . "/../../php/classes/Cliente.php");
        require_once(__DIR__ . "/../../php/classes/Produto.php");
        require_once(__DIR__ . "/../../php/utils/utils.php");
        

        if (isMetodo("POST")) {
            if (parametrosValidos($_POST, ["email", "senha"])) {
                $email = $_POST["email"];
                $senha = $_POST["senha"];
                $res = Cliente::loginCliente($email, $senha);
                if ($res[0]) {
                    if(!isset($_SESSION)){
                        session_start();
                    }
                    echo $res[1]["id"];
                    $_SESSION["id"] = $res[1]["id"];
                    $_SESSION["email"] = $res[1]["email"];
                    $_SESSION["ativo"] = $res[1]["ativo"];
                    $_SESSION["adm"] = $res[1]["adm"];
                    $_SESSION["nome"] = $res[1]["nome"];
                    header("Location: modules/admim.php");
                } else {
                    echo "<p>email ou senha estão errados</p>";
                    die;
                }
            }
        }
    ?>
    <div class="flex w-screen h-screen justify-center items-center ">
        <div class="flex w-[30vw] h-[30vh]">
            <form method="POST" class="grid w-full h-full bg-gradient-to-r from-gray-800 to-gray-500 text-white rounded-xl flex-col flex-wrap p-5 grid-cols-11 items-center gap-x-1">
                <label for="email" class="col-start-1 col-end-6 text-lg font-semibold">Email:</label>
                <input type="email" name="email" class="col-start-1 col-span-6 rounded text-black" require>
                <label for="senha" class="col-start-1 col-end-6 text-lg font-semibold">Senha:</label>
                <input type="password" name="senha" class="col-start-1 col-span-6 rounded text-black"require>
                <br>
                <button class="col-start-8 col-end-11 col-span-3 bg-slate-800 rounded p-2 hover:bg-gradient-to-r hover:from-orange-700 hover:to-yellow-300 hover:p-4 hover:duration-200 hover:delay-100 delay-150 duration-200 hover:text-black hover:font-bold hover:text-lg">Enviar</button>
            </form>
        </div>
    </div>
</body>
</html>