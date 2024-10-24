<?php
require_once 'Conexao.php';
class ClassUsuarioDAO
{
    public function cadastrar(ClassUsuario $cadastrarUsuario)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO usuario (nome, email) values (?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cadastrarUsuario->getNome());
            $stmt->bindValue(2, $cadastrarUsuario->getEmail());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function buscarUsuario($idUsuario)
    {
        try {
            $usuario = new ClassUsuario();
            $pdo = Conexao::getInstance();
            $sql = "SELECT idUsuario, nome, email FROM usuario WHERE idUsuario =:id LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $idUsuario);

            $stmt->execute();
            $usuarioAssoc = $stmt->fetch(PDO::FETCH_ASSOC);

            $usuario->setIdUsuario($usuarioAssoc['idUsuario']);
            $usuario->setNome($usuarioAssoc['nome']);
            $usuario->setEmail($usuarioAssoc['email']);

            return $usuario;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }
	
	    // Login
    public function login(ClassUsuario $loginUsuario) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM usuario WHERE email=:email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':email', $loginUsuario->getEmail());

            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }
// Fim do Login
	
    public function listarUsuarios()
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM usuario order by (nome) asc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $alunos;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }


    public function alterarUsuario(ClassUsuario $alterarUsuario)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE usuario SET nome=?, email=? WHERE idUsuario=? ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $alterarUsuario->getNome());
            $stmt->bindValue(2, $alterarUsuario->getEmail());
            $stmt->bindValue(3, $alterarUsuario->getIdUsuario());
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function excluirUsuarios($idUsuario)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM usuario WHERE idUsuario =:idUsuario";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idUsuario', $idUsuario);
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            // echo $ex->getMessage();
        }
    }
}
