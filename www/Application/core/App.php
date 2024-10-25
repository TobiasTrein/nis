<?php

namespace Application\core;

/**
* Esta classe é responsável por obter da URL o controller, método e os parâmetros
* e verificar a existência dos mesmos. É a classe principal da aplicação e 
* define o que é controller, método ou parâmetro da URL.
*/
class App
{
  protected $controller = 'Home';
  protected $method = 'index';
  protected $page404 = false;
  protected $params = [];

  // Método construtor
  public function __construct()
  {
    $URL_ARRAY = $this->parseUrl();
    $this->getControllerFromUrl($URL_ARRAY);
    $this->getMethodFromUrl($URL_ARRAY);
    $this->getParamsFromUrl($URL_ARRAY);

    // chama um método de uma classe passando os parâmetros
    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  /**
  * Este método pega as informações da URL (após o dominio do site) e retorna esses dados
  *
  * @return array
  */
  private function parseUrl()
  {
    $REQUEST_URI = explode('/', substr(filter_input(INPUT_SERVER, 'REQUEST_URI'), 1));
    return $REQUEST_URI;
  }

  /**
  * Este método verifica se o array informado possui dados na posição 1 (controlador)
  * caso exista, verifica se existe um arquivo com aquele nome no diretório Application/controllers
  * e instancia um objeto contido no arquivo, caso contrário a variável $page404 recebe true.
  * escolha da posição 1 foi para que a aplicação seja escalável, ou seja, se futuramente 
  * desejarmos incluir mais serviços na aplicação, podemos usar a posição 0 para indicar isso.
  *
  * @param  array  $url   Array contendo informações ou não do controlador, método e parâmetros
  */
  private function getControllerFromUrl($url)
  {
    if ( !empty($url[1]) && isset($url[1]) ) {
      if ( file_exists('./Application/controllers/' . ucfirst($url[1])  . '.php') ) {
        $this->controller = ucfirst($url[1]);
      } else {
        $this->page404 = true;
      }
    }

    require './Application/controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller();

  }

  /**
  * Este método verifica se o array informado possui dados na posição 2 (método)
  * caso exista, verifica se o método existe naquele determinado controlador
  * e atribui a variável $method da classe.
  *
  * @param  array  $url   Array contendo informações ou não do controlador, método e parâmetros
  */
  private function getMethodFromUrl($url)
  {
    if ( !empty($url[2]) && isset($url[2]) ) {
      if ( method_exists($this->controller, $url[2]) && !$this->page404) {
        $this->method = $url[2];
      } else {
        $this->method = 'pageNotFound';
      }
    }
  }

  /**
  * Este método verifica se o array informador possui a quantidade de elementos maior que 3
  * ($url[1] é o controller e $url[2] o método/ação a executar), caso seja, é atrbuido
  * a variável $params da classe um novo array a partir da posição 3 do $url
  *
  * @param  array  $url   Array contendo informações ou não do controlador, método e parâmetros
  */
  private function getParamsFromUrl($url)
  {
      // Se houver mais de 3 elementos no array, atribui os parâmetros
      if (count($url) > 3) {
          $this->params = array_slice($url, 3); 
      } else {
          $this->params = []; 
      }
  }
}