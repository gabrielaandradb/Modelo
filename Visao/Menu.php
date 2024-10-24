<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        -->

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        
        
    </style>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li><a href="index.php?PAGINA=cadastrarMensagem">Cadastrar de Mensagem</a></li>
      <li><a href="index.php?PAGINA=listarMensagem">Lista de Mensagem</a></li>
      
      <li><a href="#"><?php
if (isset($_SESSION['usuarioLogado'])) {
    echo "Olá:    " . strstr($nomeUsuarioLogado, ' ', true);
        
    
    
?></a></li>
      <li class="aa"><?php echo '<a href = "Controle/Logout.php" >Sair</a>';}?></li>
    </ul>
  </div>
</nav>
 

</body>
</html>

<!--<a href='index.php?PAGINA=cadastrarMensagem' class="btn btn-success">Cadastrar de Mensagem</a>
<a href='index.php?PAGINA=listarMensagem'class="btn btn-success">Lista de Mensagem</a>-->

<?php
//if (isset($_SESSION['usuarioLogado'])) {
//    echo "Olá:    " . strstr($nomeUsuarioLogado, ' ', true) . "    ";
//        
//    echo '<a href = "Controle/Logout.php" class="btn btn-danger">Sair</a><br/>';
//    
//}
