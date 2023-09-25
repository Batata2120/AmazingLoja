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
        
        $listaProdutos = Produto::listar();
        $cardCSS = "flex flex-column gap-5 w-20 h-15";
    ?>
    <div class = "bg-blue-400">
        <h1 class = "text-3xl font-bold text-white">AmazingLoja</h1>
    </div>
    <div style="width: 100vw; height: 90vh; background-image: url('../img/cycling.jpg')">
        <div style="width: 100%; height: 100%" class="grid bg-gradient-to-r from-black grid-cols-10 grid-rows-5 text-white">
            <h2 class="col-start-2 col-end-5 row-start-2 row-end-3 font-semibold text-2xl">Bem-vindo à AmazingLoja:<br>O Seu Destino de Compras Online</h2>
            <p class= "col-start-2 col-end-5 row-start-3 row-end-4">Na AmazingLoja, estamos empenhados em oferecer a você uma experiência de compras online verdadeiramente excepcional. Somos mais do que apenas uma loja; somos o seu parceiro de confiança para atender a todas as suas necessidades de compras, desde produtos eletrônicos inovadores até moda deslumbrante e tudo mais que você possa imaginar.</p>
        </div>
    </div>
    <div class="flex w-screen flex-wrap justify-around p-10 gap-10">
    <?php
        foreach($listaProdutos as $produto){
            echo "<div class='flex flex-col p-5 rounded-lg flex-wrap gap-5 w-[15vw] h-[40vh] hover:w-[20vw] hover:h-[45vh] hover:duration-300 hover:bg-gradient-to-r hover:delay-100 duration-200 after:w-[15vw] after:h-[40vh] text-white justify-center text-center delay-100 bg-gradient-to-r from-gray-800 to-gray-500'>" . "<p class='font-semibold text-xl'>" . $produto["nome"] . "</p>" . "<p>" . $produto["descricao"]. "</p>" . "<p class='text-xl font-semibold text-red-500'> R$ " . $produto["preco"] . "</p> </div>";
        }
    ?>
    </div>
</body>
</html>
