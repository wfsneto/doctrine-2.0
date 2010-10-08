<?php

namespace Entities;

/**
 * @Entity
 * @Table(name="perfis")
 * @ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Perfil {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @Column(type="string", length=255, name="nome")
     */
    private $nome;

    function __construct($id = 0, $nome = null) {
        $this->id = $id;
        $this->nome = $nome;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

}

?>
