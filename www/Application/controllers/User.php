<?php

use Application\core\Controller;

  /**
  * Classe controller da tela de user, tela principal da aplicação.
  * Aqui temos seus principais endpoints e as chamadas de métodos dos
  * models correspondentes.
  */
class User extends Controller
{
  /**
  * chama a view index.php da seguinte forma /user/index   ou somente   /user
  * e retorna para a view todos os cidadãos no banco de dados.
  */
  public function index()
  {
    $Users = $this->model('Users'); // é retornado o model Users()
    $data = $Users::findAll();
    $this->view('user/index', ['users' => $data]);
  }

  /**
  * chama a view show.php da seguinte forma /user/show passando um parâmetro 
  * via URL /user/show/id e é retornado um array contendo (ou não) um único
  * cidadão. Além disso é verificado se foi passado ou não um id pela url, caso
  * não seja informado, é chamado a view de página não encontrada.
  * @param  string  $nis   Identificação do cidadão.
  */
  public function show($nis) {
    $Users = $this->model('Users');
    $data = $Users::findById($nis);
    $this->view('user/show', ['user' => $data]);
  }

  /**
  * Método responsável por cadastrar um novo cidadão.
  * Recebe os dados do formulário via POST e insere no banco de dados.
  */
  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name']; 
      
      if (!empty($name)) {
        $Users = $this->model('Users');
        $Users::create($name);
      }

      echo '<meta http-equiv="refresh" content="0;url=/nis/user">';
      exit;
    }
  }


}
