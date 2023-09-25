<?php
require_once(__DIR__ . "/../conexao/Conexao.php");


class Compra
{
    public static function registrarCompra($idUsuario, $dataCompra, $produtosSelecionados)
    {
        try {
            $conexao = Conexao::getConexao();

            // Transação para seguranca
            $conexao->beginTransaction();

            
            $stmt = $conexao->prepare("INSERT INTO compra(idUsuario, dataCompra) VALUES (?, ?)");
            $stmt->execute([$idUsuario, $dataCompra]);


            $idCompra = $conexao->lastInsertId();

           
            foreach ($produtosSelecionados as $idProduto) {

                $stmt = $conexao->prepare("INSERT INTO produtos_compra(idCompra, idProduto, qtdProduto) VALUES (?, ?, 1)");
                $stmt->execute([$idCompra, $idProduto]);
            }

            
            $conexao->commit();

            return true;
        } catch (Exception $e) {
            
            $conexao->rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public static function listarCompras()
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT compra.id, usuario.nome AS nome_cliente, compra.dataCompra FROM compra INNER JOIN usuario ON compra.idUsuario = usuario.id ORDER BY compra.id DESC");
            $stmt->execute();

            $compras = $stmt->fetchAll();

            foreach ($compras as &$compra) {
                $stmt = $conexao->prepare("SELECT produto.nome, produtos_compra.qtdProduto FROM produtos_compra INNER JOIN produto ON produtos_compra.idProduto = produto.id WHERE produtos_compra.idCompra = ?");
                $stmt->execute([$compra["id"]]);

                $produtosComprados = $stmt->fetchAll();
                $compra["produtos"] = $produtosComprados;
            }

            return $compras;
        } catch (Exception $e) {
            echo $e->getMessage();
            return [];
        }
    }
}





?>