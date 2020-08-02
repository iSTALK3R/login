<?php 

class Core
{

    private $url;

    private $controller;
    private $method = 'Index';
    private $params = array();

    public function __construct()
    {

    }

    public function Start($request)
    {
        if (isset($request['url'])) {

            $this->url = explode('/', $request['url']); // Quebra a url e cria um array cada vez que aparece uma /

            $this->controller = ucfirst($this->url[0]) . 'Controller'; // Controller
            array_shift($this->url); // Limpa o array url e deixa os métodos na posição 0

            if (isset($this->url[0]) && $this->url != "") {
                $this->method = $this->url[0]; // Métodos
                array_shift($this->url); // Limpa o array url e deixa os parametros na posição 0

                if (isset($this->url[0]) && $this->url != "") {
                    $this->params = $this->url; // Parametros adicionais
                }
            }

        } else {
            // Caso não houver nenhuma informação na url
            $this->controller = "LoginController";
            $this->method = "Index";
        }

        return call_user_func(array(new $this->controller, $this->method), $this->params); // Responsável por carregar a controller, method e params
    }
}