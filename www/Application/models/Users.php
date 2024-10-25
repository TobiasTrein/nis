<?php

namespace Application\models;

use Application\core\Database;
use Application\helpers\NisGenerator;
use PDO;

/**
* Classe model da tela de user, tela principal da aplicação.
* Aqui temos seus principais métodos, conexão com o banco e seus atributos
* (na minha solução não foi necessária nenhum atributo adicional)
*/
class Users
{
  /**
  * Este método busca todos os cidadãos armazenados na base de dados
  *
  * @return   array
  */
  public static function findAll()
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM users');
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
  * Este método busca um cidadão armazenado na base de dados com um
  * determinado ID
  * @param    string     $nis  Identificador único do cidadão
  *
  * @return   array
  */
  public static function findById(string $nis)
  {
    // Remove pontos e hífens do NIS para pesquisa no banco
    $nis = str_replace(['.', '-'], '', $nis);

    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM users WHERE nis = :nis LIMIT 1', array(
      ':nis' => $nis
    ));

    return $result->fetchAll(PDO::FETCH_ASSOC);
  }
  
  /**
  * Este método insere um novo usuário no banco de dados, gerando automaticamente o NIS.
  *
  * @param    string  $name  Nome do usuário
  * @return   bool
  */
  public static function create(string $name)
  {
    $nis = NisGenerator::generate();
    $conn = new Database();
    $query = 'INSERT INTO users (nis, name) VALUES (:nis, :name)';
    $params = array(':nis' => $nis, ':name' => $name);
    return $conn->executeQuery($query, $params);
  }
}