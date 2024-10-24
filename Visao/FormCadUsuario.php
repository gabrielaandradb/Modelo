<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
   
    <title></title>
    <link rel="stylesheet" href="Visao/css/form.css">
</head>

<body>
<div id="tudo">
<div id="esquerda">
<h4>Formulario de cadastro de Alunos</h4>
         <form method="post" action="./Controle/ControleUsuario.php?ACAO=cadastrarUsuario">
               <p> Nome:<input type="text" name="nome" maxlength="40" placeholder="Digite seu nome" /></p>
               <p> Email:<input type="email" id="email" name="email" maxlength="40" placeholder="Digite seu email" /></p>
                <button type="submit" value="Registrar">Registrar</button>
                <button type="reset" value="Limpar">Limpar</button>
        
        </form>

</div>

</div>




</div>  
        
  
</body>

</html>