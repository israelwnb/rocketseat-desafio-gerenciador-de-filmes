<?php
if (!auth()) {
  header('location: /login');
  exit();
}

$filmes = Filme::all($_REQUEST['pesquisar'] ?? '');

view('index', compact('filmes'));
