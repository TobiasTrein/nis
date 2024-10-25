<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Simple Framework</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #success-alert {
            position: fixed;
            left: 20px;
            top: 20px; 
            z-index: 1050; 
            width: auto; /* Largura automática, pode ser ajustada conforme necessário */
        }
    </style>
  </head>
  <body>

  <?php
    require './Application/autoload.php';

    use Application\core\App;
    use Application\core\Controller;

    $app = new App();

  ?>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  
  </body>
</html>
