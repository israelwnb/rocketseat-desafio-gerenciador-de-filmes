<?php

if (!auth()) {
  header('location: /');
  exit();
}

$filmes = Filme::meus(auth()->id);

view('meus-filmes', compact('filmes'));
