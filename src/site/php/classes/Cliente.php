<?php

require_once(__DIR__ . "/../conexao/Conexao.php");

class Cliente
{
    public static function adicionarCliente($nome, $nome_usuario, $estado, $cidade, $bairro, $rua, $nro_cartao, $nro_seguranca, $nome_cartao, $data_validade_cartao, $email, $senha, $adm)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("INSERT INTO usuario(nome, nome_usuario, estado, cidade, bairro, rua, nro_cartao, nro_seguranca, nome_cartao, data_validade_cartao, email, senha, adm, ativo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $nome_usuario, $estado, $cidade, $bairro, $rua, $nro_cartao, $nro_seguranca, $nome_cartao, $data_validade_cartao, $email, sha1($senha), $adm, 1]);
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

    public static function deletarCliente($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("DELETE FROM usuario WHERE id = ?");
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
    public static function desativarCliente($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("UPDATE usuario SET ativo = ? WHERE id = ?");
            $stmt->execute([0 ,$id]);

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
    
    public static function ativarCliente($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("UPDATE usuario SET ativo = ? WHERE id = ?");
            $stmt->execute([1 ,$id]);
            
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

    public static function editarCliente($id, $nome, $nome_usuario, $estado, $cidade, $bairro, $rua, $nro_cartao, $nro_seguranca, $nome_cartao, $data_validade_cartao, $email)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("UPDATE usuario SET nome = ?, nome_usuario = ?, estado = ?, cidade = ?, bairro = ?, rua = ?, nro_cartao = ?, nro_seguranca = ?, nome_cartao = ?, data_validade_cartao = ?, email = ? WHERE id = ?");
            $stmt->execute([$nome, $nome_usuario, $estado, $cidade, $bairro, $rua, $nro_cartao, $nro_seguranca, $nome_cartao, $data_validade_cartao, $id, $email]);

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

    public static function listarClientes()
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM usuario ORDER BY id");
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function existeCliente($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT COUNT(*) FROM usuario WHERE id = ?");
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

    public static function getCliente($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM usuario WHERE id = ?");
            $stmt->execute([$id]);

            return $stmt->fetchAll()[0];
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
    public static function loginCliente($email, $senha){
        try {
            $conexao = Conexao::getConexao();
            $senha = sha1($senha);
            $stmt = $conexao->prepare("SELECT * FROM usuario WHERE email = ? and senha = ?");
            $stmt->execute([$email, $senha]);
            $cliente = $stmt->fetchAll();
            if (count($cliente) > 0) {
                return [true, $cliente[0]];
            } else {
                return [false];
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}