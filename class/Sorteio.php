<?php

namespace JSC\Lotofacil;

class Sorteio
{

	private $maisSorteados;
	private $menosSorteados;
	public $destaque = 'alert-success';

	function __construct($maisSorteados = '', $menosSorteados = '') {
		$this->maisSorteados = $maisSorteados;
		$this->menosSorteados = $menosSorteados;
	}

	public function getMaisSorteados() {
		return implode($this->maisSorteados, ', ');
	}

	public function getMenosSorteados() {
		return implode($this->menosSorteados, ', ');
	}

	public function getApostas($numeros = null) {
		$excluidos = array_merge($this->maisSorteados, $this->menosSorteados);
		$grupos = [];
		$grupo = 1;
		$y = 1;

		for($x = 1; $x <= 25; $x++) {
			if (!in_array($x, $excluidos)) {
				$grupos[$grupo][] = str_pad($x, 2, 0, STR_PAD_LEFT);
				if ($y >= 4) {
					$y = 0;
					$grupo++;
				}
				$y++;
			}
		}
		$jogos = '';
		for ($x = 1; $x <= 5; $x++ ) {
			for ($y = 1; $y <= 5; $y++ ) {
				if ($y > $x) {
					for ($z = 1; $z <= 5; $z++ ) {
						if ($z > $x AND $z > $y) {
							$jogos[] = array_merge(
								$grupos[$x],
								$grupos[$y],
								$grupos[$z],
								$this->maisSorteados
							);
						}
					}
				}
			}
		}

		$retorno = '';
		foreach ($jogos as $jogo) {
			$contador = 0;
			sort($jogo);
			$retorno .= '<div style="display: table;">';
			foreach ($jogo as $numero) {
				$alerta = '';
				if ($numeros) {
					if (in_array($numero, $numeros)) {
						$alerta = 'alert-success';
						$contador++;
					}
				}
				$retorno .= "<div class='numeros alert {$alerta}'>{$numero}</div>";
			}
			if ($numeros) {
				$alert = ($contador >= 11) ? 'alert-info' : 'alert-danger';
				$retorno .= "<div class='numeros alert {$alert}'><strong>".str_pad($contador, 2, 0, STR_PAD_LEFT)."</strong></div>";
			}
			$retorno .= '</div>';
		}
		echo $retorno;
	}

}
