<?php
require_once '../Modelo/ClassUsuario.php';
require_once '../Modelo/DAO/ClassUsuarioDAO.php';

$id =@$_POST['idex'];
$nome = @$_POST['nome'];
$email = @$_POST['email'];
$acao = $_GET['ACAO'];


$novoUsuario = new ClassUsuario();
$novoUsuario->setIdUsuario($id);
$novoUsuario->setNome($nome);
$novoUsuario->setEmail($email);

$classUsuarioDAO = new ClassUsuarioDAO();
switch ($acao) {
	case "cadastrarUsuario":
        $usuario = $classUsuarioDAO->cadastrar($novoUsuario);
	    if($usuario >= 1){
            header('Location:../index.php?&MSG= Cadastro realizado com sucesso!');
        } else {
            header('Location:../index.php?&MSG= Não foi possivel realizar o cadastro!');
        }
        break;
	case 'alterarUsuario':
	   //codigo aqui   
        $usuario = $classUsuarioDAO->alterarUsuario($novoUsuario);
        if($usuario == 1){
            header('Location:../index.php?&MSG= Cadastro atualizado com sucesso!');
        } else {
            header('Location:../index.php?&MSG= Não foi possivel realizar a atualização!');
        }
 
	   break;
    
    case "excluirUsuario":
        if (isset($_GET['idex'])) {
            $idUsuario = $_GET['idex'];
            $classUsuarioDAO = new ClassUsuarioDAO();
            $us = $classUsuarioDAO->excluirUsuarios($idUsuario);
            if ($us == TRUE) {
                header('Location:../index.php?PAGINA=listarUsuario&MSG= Usuario foi excluido com sucesso!');
            } else {
                header('Location:../index.php?PAGINA=listarUsuario&MSG=Não foi possivel realizar a exclusão do Usurio!');
            }
        }

        break;
    default :
        break;	
 }
