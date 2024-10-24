<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
         <title></title>
    </head>
    <body>
        
            <h1>Formulario de atualização de Alunos</h1>
            <hr>
        </div>
		
        <?php
            require '../Modelo/ClassUsuario.php';
            require '../Modelo/DAO/ClassUsuarioDAO.php';
			$id =@$_GET['idex'];
            $novoUsuario = new ClassUsuario();
            $usuarioDAO = new ClassUsuarioDAO();
            $novoUsuario = $usuarioDAO->buscarUsuario($id);

        ?>
        <form method="post" action="../Controle/ControleUsuario.php?ACAO=alterarUsuario" >
                <input type="hidden" name="idex" value="<?php echo $novoUsuario->getIdUsuario(); ?>">
                Nome:<input type="text" name="nome" size="50" value="<?php echo $novoUsuario->getNome(); ?>" /><br>
                Email:<input type="email" id="email" name="email" size="40" value="<?php echo $novoUsuario->getEmail(); ?>"/>
                <br>
				<button type="submit" value="Alterar">Alterar</button> 
				<button  type="reset" value="Limpar">Limpar</button>
            </div>
        </form>
    </body>
</html>
