<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  view('filme-criar');
  exit();
}

if (!auth()) {
  abort(403);
}

$usuario_id = auth()->id;
$titulo = $_POST['titulo'];
$categoria = $_POST['categoria'];
$descricao = $_POST['descricao'];
$ano = $_POST['ano'];

$validacao = Validacao::validar([
  'titulo' => ['required', 'min:3'],
  'categoria' => ['required'],
  'descricao' => ['required'],
  'ano' => ['required'],
], $_POST);

if ($validacao->naoPassou()) {
  header('location: /filme-criar');
  exit();
}

$novoNome = md5(rand());
$extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
$imagem = "images/$novoNome.$extensao";

move_uploaded_file($_FILES['imagem']['tmp_name'], __DIR__ . '/../public/' . $imagem);

$database->query(
  "insert into filmes (titulo, categoria, descricao, ano, usuario_id, imagem)
  values (:titulo, :categoria, :descricao, :ano, :usuario_id, :imagem)",
  params: compact('titulo', 'categoria', 'descricao', 'ano', 'usuario_id', 'imagem')
);

//flash()->push('mensagem', 'Filme cadastrado com sucesso!');
header('location: /meus-filmes');
exit();
