<script language="javaScript" type="text/javascript">
function checkDelete(){
    return confirm('Deseja continuar?');
}
</script>

<?php
    require './Modelo/ClassUsuario.php';
    require './Modelo/DAO/ClassUsuarioDAO.php';

    $classUsuarioDAO = new ClassUsuarioDAO();
    $us = $classUsuarioDAO->listarUsuarios();

    echo "<table>";
    echo "  <tr>";
    echo "      <th>Nome</th> ";
    echo "      <th>Email</p></th> ";
    echo "      <th>Exluir</p></th> ";
    echo "      <th >Alterar</p></th>";
    echo "  <tr>";

    foreach ($us as $us) {
        echo "<tr>";
        echo "<td>" . $us['nome'] . "</p></td>";
        echo "<td>" . $us['email'] . "</p></td>";
            echo "<td'><a href='Controle/ControleUsuario.php?ACAO=excluirUsuario&idex=".$us["idUsuario"]."' onclick='return checkDelete()'><input type='button' name='excluir' id='excluir' value='excluirrr'></a></td>";
            echo "<td'><a href='Visao/FormAltUsuario.php?idex=" . $us["idUsuario"] . "'><input type='button' value='alterar'></a></td>";
        echo "</tr>";
    }


