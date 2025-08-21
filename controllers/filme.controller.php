<?php
$filme = Filme::get($_GET['id']);

$avaliacoes = Avaliacao::get($_GET['id']);

view('filme', compact('filme', 'avaliacoes'));
