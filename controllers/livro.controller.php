<?php
$filme = Filme::get($_GET['id']);

$avaliacoes = $database->query(
  "select * from avaliacoes where filme_id = :id",
  Avaliacao::class,
  ['id' => $_GET['id']]
)->fetchAll();

view('filme', compact('filme', 'avaliacoes'));
