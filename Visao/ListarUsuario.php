<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Visao/css/form.css">
    <title>Document</title>
    <script language="javaScript" type="text/javascript">
function checkDelete(){
    return confirm('Deseja continuar?');
}
</script>
</head>
<body>
    
<?php
    require './Modelo/ClassUsuario.php';
    require './Modelo/DAO/ClassUsuarioDAO.php';

    $classUsuarioDAO = new ClassUsuarioDAO();
    $us = $classUsuarioDAO->listarUsuarios();
    echo "<div id='direita'>";
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
    echo "</table>";
    echo "<div>";  
    ?>
</body>
</html>





