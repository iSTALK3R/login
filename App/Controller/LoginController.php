<?php
// O Arquivo Core é o responsável por chamar esse Controller

class LoginController
{
    public function index() // Responsável por renderizar a página de login utilizando o Twig
    {
        $loader = new \Twig\Loader\FilesystemLoader('App/View/'); // Apontando para o diretório das views
        $twig = new \Twig\Environment($loader, [
            'cache' => '/path/to/compilation_cache',
            'auto_reload' => true,
        ]); // Instanciando a pasta, salvando cache e relogando o cache
        
        $template = $twig->load('login.html'); // Carregando a view login.html
        $parameters['error'] = $_SESSION['msg_error'] ?? null;

        return $template->render($parameters); // Renderizando a view
    }

    public function check()
    {
        try {
            $user = new User; // Instanciando a model

            $user->setEmail($_POST['email']); // Recebendo o valor email digitado pelo usuario
            $user->setPassword($_POST['password']); // Recebendo o valor senha digitado pelo usuario
    
            $user->validateLogin(); // Executando o método da model User

            header("Location: http://localhost:81/loginSys/dashboard"); // Redirecionando o usuário para o dashboard caso seja validado
        } catch (\Exception $e) { // Caso der um erro na validação, o throw não deixa o try continuar e causa uma Exception, entrando no catch
            $_SESSION['msg_error'] = array('msg' => $e->getMessage(), 'count' => 0); // Session para mostrar uma mensagem de erro

            header("Location: http://localhost:81/loginSys/"); // Retornando para a pagina de login
        }
    }
}