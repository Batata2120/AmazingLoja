<?php

require_once(__DIR__ . "/../conexao/Conexao.php");

class Produto{

    public static function addProduto($nome, $qtdEstoque, $preco, $descricao){
        try{
            $connetion = Conexao::getConexao();
            $stmt = $connetion->prepare("INSERT INTO produto(nome, qtdEstoque, preco, descricao) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nome, $qtdEstoque, $preco, $descricao]);
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
    public static function deletar($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("DELETE FROM produto WHERE id = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
    public static function editar($id, $nome, $qtdEstoque, $preco, $descricao)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("UPDATE produto SET nome = :p1, qtdEstoque = :p2, preco = :p3, descricao = :p4 WHERE id = :p5");
            $stmt->execute([
                "p1" => $nome,
                "p2" => $qtdEstoque,
                "p3" => $preco,
                "p4" => $descricao,
                "p5" => $id
            ]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
    public static function listar()
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM produto ORDER BY id");
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
    public static function existe($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT COUNT(*) FROM produto WHERE id = ?");
            $stmt->execute([$id]);

            if ($stmt->fetchColumn() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
    public static function getProduto($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM produto WHERE id = ?");
            $stmt->execute([$id]);

            return $stmt->fetchAll()[0];
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
?>