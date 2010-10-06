<?php
/**
 * Classe Acao
 * @package model
 * @author Idealizza
 */
	class Acao {
		
		/**
		 * Atributos
		 */
		private $codigo;
		private $nome;
		private $modulo;

		/**
		 * Metodo construtor()
		 * @param $codigo
		 * @param $nome
		 * @param $modulo
		 * @return Acao
		 */
		public function __construct($codigo = 0,$nome = '',Modulo $modulo = null){
			$this->codigo = $codigo;
			$this->nome = $nome;
			$this->modulo = $modulo;
		}
		
		/**
		 * Metodo listar($filtroModulo,$filtroPerfil)
		 * @param $filtroModulo
		 * @param $filtroPerfil
		 * @return Acao[]
		 */
		public static function listar($filtroModulo = 0,$filtroPerfil = 0){
			$instancia = AcaoDAO::getInstancia();
			$acoes = $instancia->listar($filtroModulo,$filtroPerfil);
			if(!$acoes)
				throw new ListaVazia(ListaVazia::ACOES);
			foreach($acoes as $acao){
				$objetos[] = new Acao($acao['codigo'],$acao['nome'],Modulo::buscar($acao['id_modulo']));
			}
			return $objetos;
		}
		
		/**
		 * Metodo buscar($codigo,$modulo)
		 * @param $codigo
		 * @param $modulo
		 * @return Acao
		 */
		public static function buscar($codigo = 0,$modulo = 0){
			$instancia = AcaoDAO::getInstancia();
			$acao = $instancia->buscar($codigo,$modulo);
			if(!$acao)
				throw new RegistroNaoEncontrado(RegistroNaoEncontrado::ACAO);
			return new Acao($acao['codigo'],$acao['nome'],Modulo::buscar($acao['id_modulo']));
		}
		
		/**
		 * Metodo checarPermissao($codigo,$modulo)
		 * @param $codigo
		 * @param $modulo
		 * @return boolean
		 */
		public static function checarPermissao($codigo = 0, $modulo = 0) {
		
			$controll = Controll::getControll();
			
			if((empty($codigo)) || (empty($modulo)))
				return false;
				
			foreach($controll->getUsuario()->getPerfil()->getAcoes() as $acao){
				if(($acao->getCodigo() == $codigo)&&($acao->getModulo()->getId() == $modulo))
					return true;
			}
			return false;
		}
		
		/**
		 * Metodos getters() e setters()
		 */
		public function getCodigo(){
			return $this->codigo;
		}
		public function setCodigo($codigo){
			$this->codigo = $codigo;
		}
		public function getNome(){
			return $this->nome;
		}
		public function setNome($nome){
			$this->nome = $nome;
		}
		public function getModulo(){
			return $this->modulo;
		}
		public function setModulo(Modulo $modulo){
			$this->modulo = $modulo;
		}
	}
?>