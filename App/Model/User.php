<?php

use Alison\Database\Connection;

class User
{
    private $id;
    private $username;
    private $email;
    private $password;


    // O arquivo LoginController é o que usa estes métodos
    
    public function validateLogin() // Função para validar as credenciais do usuario 
    {
        $conn = Connection::getConn(); // Faz a conexão com o banco de dados
        $sql = "SELECT * FROM tb_users WHERE email = :email";

        $select = $conn->prepare($sql); // Preparando a query para passar os parâmetros
        $select->bindValue(':email', $this->email); // Passando o/s parametros para a consulta
        $select->execute(); // Executando a query

        if ($select->rowCount()) { // Verificando se a consulta retornou alguma linha
            $result = $select->fetch(); // 

            if ($result['pass'] == $this->password) { // Verificando se a senha passada pelo usuario é igual a que foi retornada do banco de dados
                $_SESSION['usr'] = array( // Criando uma sessão e passando um array com os campos do banco de dados
                    'id' => $result['id'], 
                    'username' => $result['username']
                );

                return true; // Terminando o if
            }
        }

        throw new \Exception('Login Inválido'); // Caso der erro, o throw causa uma Exception
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }
}