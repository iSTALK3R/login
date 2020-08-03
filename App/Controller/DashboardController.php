<?php
// O Arquivo Core é o responsável por chamar esse Controller

class DashboardController
{
    public function index() // Responsável por renderizar a página de login utilizando o Twig
    {
        $loader = new \Twig\Loader\FilesystemLoader('App/View/'); // Apontando para o diretório das views
        $twig = new \Twig\Environment($loader, [
            'cache' => '/path/to/compilation_cache',
            'auto_reload' => true,
        ]); // Instanciando a pasta, salvando cache e relogando o cache
        
        $template = $twig->load('dashboard.html'); // Carregando a view login.html
        $parameters['username'] = $_SESSION['usr']['username'];

        return $template->render($parameters); // Renderizando a view
    }

    public function logout() // Método para sair
    {
        unset($_SESSION['usr']);
        session_destroy();

        header("Location: http://localhost:81/loginSys/");
    }
}
