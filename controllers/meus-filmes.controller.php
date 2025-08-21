<?php

if (!auth()) {
  header('location: /');
  exit();
}

$filmes = Filme::meus(auth()->id, $_REQUEST['pesquisar'] ?? '');

view('meus-filmes', compact('filmes'));
