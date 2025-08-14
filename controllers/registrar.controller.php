<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $validacao = Validacao::validar([
    'nome' => ['required'],
    'email' => ['required', 'email', 'unique:usuarios'],
    'senha' => ['required', 'min:8', 'max:30', 'strong']
  ], $_POST);

  if ($validacao->naoPassou('registrar')) {
    flash()->push('pagina', 'cadastrar');
    header('location: /login');
    exit();
  }

  $database->query(
    query: "insert into usuarios (nome, email, senha) values (:nome, :email, :senha)",
    params: [
      'nome' => $_POST['nome'],
      'email' => $_POST['email'],
      'senha' => password_hash($_POST['senha'], PASSWORD_BCRYPT),
    ]
  );

  $usuario = $database->query(
    query: "select * from usuarios where email = :email",
    class: Usuario::class,
    params: ['email' => $_POST['email']]
  )->fetch();

  if ($usuario) {
    $_SESSION['auth'] = $usuario;

    // flash()->push('mensagem', 'Seja bem vindo ' . $usuario->nome . '!');
    header('location: /');
    exit();
  }
}

flash()->push('pagina', 'cadastrar');
header('location: /login');
exit();
