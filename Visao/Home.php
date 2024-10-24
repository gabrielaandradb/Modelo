<?php
session_start();
$titulo_pagina = "Home"; // Definindo nome da página
   // require '../Controle/ControleLogin.php';
    require '../Modelo/ClassUsuario.php';
    require '../Modelo/DAO/ClassUsuarioDAO.php';
    $emailteste="mariajes@gmail.com";
    $loginUsuarioDAO = new ClassUsuarioDAO();
    $loginUsuario = new ClassUsuario();
    $us = $loginUsuarioDAO->listarUsuarios();
   $loginUsuario->setEmail($emailteste);
   //echo "Email retornado ". $loginUsuario->getEmail();
   $log_us = $loginUsuarioDAO->login($loginUsuario);
   $_SESSION['nome_logado'] = $log_us['nome'];
      echo "<hr>";
     echo $_SESSION['nome_logado'];
    echo "<table class='table'>";
    echo "  <tr>";
    echo "      <th scope='col'><p align='center'>Nome</p></th> ";
    echo "      <th scope='col'><p align='center'>Email</p></th> ";
    echo "      <th scope='col'><p align='center'>Exluir</p></th> ";
    echo "      <th scope='col'><p align='center'>Alterar</p></th>";
    echo "  <tr>";

    foreach ($us as $us) {
        echo "<tr>";
        echo "<td scope='col'><p align='center'>" . $us['nome'] . "</p></td>";
        echo "<td scope='col'><p align='center'>" . $us['email'] . "</p></td>";
        
            echo "<td scope='col'><a href='Controle/ControleUsuario.php?ACAO=excluirUsuario&idex=".$us["idUsuario"]."' onclick='return checkDelete()'><input type='button' name='excluir' id='excluir' value='excluir' class='btn btn-danger'></a></td>";
            echo "<td scope='col'><a href='Visao/FormAltUsuario.php?idex=" . $us["idUsuario"] . "'><input type='button' value='alterar' class='btn btn-warning'></a></td>";
        echo "</tr>";
    }



//require_once "Controle/ControleUsuario.php";
//require_once "Controle/ControleLogin.php";

//include("Visao/include/header.php");
//include("Visao/include/Menu.php");
//include("Visao/include/MensagemDeAlerta.php");

//var_dump($array_usuarios);
    
                                //$value['id'] == $_SESSION['idUsuarioLogado'];
                                    // Se o usuário a ser listado for o usuário logado, exibir botão editar e excluir
                       
                                
                           
                        


//include("Visao/include/rodape.php");
?>