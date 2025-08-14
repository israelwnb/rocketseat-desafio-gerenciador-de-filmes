<?php

class Filme
{
  public $id;
  public $titulo;
  public $categoria;
  public $descricao;
  public $ano;
  public $imagem;
  public $usuario_id;
  public $nota_avaliacao;
  public $count_avaliacoes;

  public function query($where, $params)
  {
    $database = new Database(config('database'));

    return $database->query(
      "select 
        f.id, f.titulo, f.categoria, f.descricao, f.ano, f.imagem,
        ifnull(round(sum(a.nota) / 5.0), 0) as nota_avaliacao,
        ifnull(count(a.id), 0) as count_avaliacoes
      from
      filmes f
      left join avaliacoes a on a.filme_id = f.id
      where $where
      group by f.id, f.titulo, f.categoria, f.descricao, f.ano, f.imagem",
      self::class,
      $params
    );
  }

  public static function get($id)
  {
    return (new self)->query('f.id = :id', ['id' => $id])->fetch();
  }

  public static function all($filtro = '')
  {
    return (new self)->query('titulo like :filtro', ['filtro' => "%$filtro%"])->fetchAll();
  }

  public static function meus($usuario_id)
  {
    return (new self)->query('f.usuario_id = :usuario_id', ['usuario_id' => $usuario_id])->fetchAll();
  }
}
