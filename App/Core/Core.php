<?php 

class Core
{

    private $url;

    private $controller;
    private $method = 'index';
    private $params = array();

    private $user;

    private $error;

    public function __construct() // Função executada quando a classe é Instanciada
    {
        $this->user = $_SESSION['usr'] ?? null; // Armazendando a session na variavel, caso não possua uma sessão, o valor é null
        $this->error = $_SESSION['msg_error'] ?? null;

        if (isset($this->error)) { // Verificando se a variavel error contem valor
            if ($this->error['count'] === 0) { // Verificando se o count do error é identico a 0
                $_SESSION['msg_error']['count']++; // Caso for, incrementar o count para mostrar o error
            } else {
                unset($_SESSION['msg_error']); // Caso não for igual a 0, excluir a sessão para não mostrar o error
            }
        }
    }

    public function Start($request) // Método que recebe uma request $_GET
    {
        if (isset($request['url'])) {

            $this->url = explode('/', $request['url']); // Quebra a url e cria um array cada vez que aparece uma /

            $this->controller = ucfirst($this->url[0]) . 'Controller'; // Controller do login
            array_shift($this->url); // Limpa o array url e deixa os métodos na posição 0

            if (isset($this->url[0]) && $this->url != "") {
                $this->method = $this->url[0]; // Métodos
                array_shift($this->url); // Limpa o array url e deixa os parametros na posição 0

                if (isset($this->url[0]) && $this->url != "") {
                    $this->params = $this->url; // Parametros adicionais
                }
            }
        }

        if ($this->user) {
            $pg_permission = ['DashboardController']; // Controllers permitidos caso o usuario esteja logado

            if (!isset($this->controller) || !in_array($this->controller, $pg_permission)) {
                $this->controller = 'DashboardController';
                $this->method = 'index';
            }
        } else {
            $pg_permission = ['LoginController']; // Controllers permitidos caso o usuario não esteja logado

            if (!isset($this->controller) || !in_array($this->controller, $pg_permission)) {
                $this->controller = 'LoginController';
                $this->method = 'index';
            }
        }

        return call_user_func(array(new $this->controller, $this->method), $this->params); // Responsável por carregar a controller, method e params
    }
}