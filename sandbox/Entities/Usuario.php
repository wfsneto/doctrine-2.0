<?php

namespace Entities;

/**
 * @Entity
 * @Table(name="usuarios")
 * @ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Usuario {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @Column(type="string", name="id_perfil")
     */
    private $perfil;
    /**
     * @Column(type="string", length=100, name="nome")
     */
    private $nome;

    function __construct($id = 0, $perfil = null, $nome = null) {
        $this->id = $id;
        $this->perfil = $perfil;
        $this->nome = $nome;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPerfil() {
        return $this->perfil;
    }

    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

}

?>
