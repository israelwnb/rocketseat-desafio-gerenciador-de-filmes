<?php

class Avaliacao
{
  public $id;
  public $filme_id;
  public $comentario;
  public $nota;
  public $usuario_id;
  public $usuario_nome;
  public $usuario_filmes_avaliados;

  public function query($where, $params)
  {
    $database = new Database(config('database'));

    return $database->query(
      "select 
        a.id, a.comentario, a.nota, a.usuario_id,
        u.nome as usuario_nome,
        (select count(*) from avaliacoes a2 where a2.usuario_id = a.usuario_id) as usuario_filmes_avaliados
      from
      avaliacoes a
      left join usuarios u on u.id = a.usuario_id
      where $where",
      self::class,
      $params
    );
  }

  public static function get($filme_id)
  {
    return (new self)->query('a.filme_id = :filme_id', ['filme_id' => $filme_id])->fetchAll();
  }
}
