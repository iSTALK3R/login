<?php
// O Arquivo Core é o responsável por chamar esse Controller

class LoginController
{
    public function Index() // Responsável por renderizar a página de login utilizando o Twig
    {
        $loader = new \Twig\Loader\FilesystemLoader('App/View/');
        $twig = new \Twig\Environment($loader, [
            'cache' => '/path/to/compilation_cache',
            'auto_reload' => true,
        ]);
        $template = $twig->load('login.html');

        return $template->render();
    }
}