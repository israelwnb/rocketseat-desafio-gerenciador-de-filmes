<?php

class Validacao
{
  public $validacoes = [];

  public static function validar($regras, $dados)
  {
    $validacao = new self;
    foreach ($regras as $campo => $regrasDoCampo) {
      foreach ($regrasDoCampo as $regra) {
        $valorDoCampo = $dados[$campo];

        if ($regra == 'confirmed') {
          $validacao->$regra($campo, $valorDoCampo, $dados["{$campo}_confirmacao"]);
        } else if (str_contains($regra, ':')) {
          $temp = explode(':', $regra);
          $regra = $temp[0];
          $regraArg = $temp[1];
          $validacao->$regra($regraArg, $campo, $valorDoCampo);
        } else {
          $validacao->$regra($campo, $valorDoCampo);
        }
      }
    }

    return $validacao;
  }

  private function unique($tabela, $campo, $valor)
  {
    if (strlen($valor) == 0) {
      return;
    }

    $db = new Database(config('database'));

    $resultado = $db->query(
      query: "select * from $tabela where $campo = :valor",
      params: ['valor' => $valor]
    )->fetch();

    if ($resultado) {
      $this->validacoes[$campo][] = "O $campo já está sendo usado.";
    }
  }

  private function required($campo, $valor)
  {
    if (strlen($valor) == 0) {
      $this->validacoes[$campo][] = "O $campo é obrigatório.";
    }
  }

  private function email($campo, $valor)
  {
    if (!filter_var($valor, FILTER_VALIDATE_EMAIL)) {
      $this->validacoes[$campo][] = "O $campo é inválido.";
    }
  }

  private function confirmed($campo, $valor, $valorDeConfirmacao)
  {
    if ($valor != $valorDeConfirmacao) {
      $this->validacoes[$campo][] = "O $campo de confirmação está diferente.";
    }
  }

  private function min($min, $campo, $valor)
  {
    if (strlen($valor) < $min) {
      $this->validacoes[$campo][] = "O $campo precisa ter no mínimo $min caracteres.";
    }
  }

  private function max($max, $campo, $valor)
  {
    if (strlen($valor) > $max) {
      $this->validacoes[$campo][] = "O $campo pode ter no máximo $max caracteres.";
    }
  }

  private function strong($campo, $valor)
  {
    if (!strpbrk($valor, '!@#$%^&*()+_-[\];.,/?|')) {
      $this->validacoes[$campo][] = "O $campo precisa ter um caractere especial.";
    }
  }

  public function naoPassou($nomeCustomizado = null)
  {
    $chave = 'validacoes';
    if ($nomeCustomizado) {
      $chave .= '_' . $nomeCustomizado;
    }

    flash()->push($chave, $this->validacoes);

    return sizeof($this->validacoes) > 0;
  }
}
