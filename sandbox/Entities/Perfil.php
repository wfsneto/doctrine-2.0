<?php

namespace Entities;

/**
 * @Entity
 * @Table(name="perfil")
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
     * @Column(type="string", length="255", name="nome")
     */
    private $nome;
//    /**
//     *
//     * @OneToMany(targetEntity="Entities\Usuario", mappedBy="perfil")
//     */
//    private $usuarios;

    function __construct($id = 0, $nome = null, Usuario $usuarios = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->usuarios = $usuarios;
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

    public function getUsuarios() {
        return $this->usuarios;
    }

    public function setUsuarios($usuarios) {
        $this->usuarios = $usuarios;
    }

}

?>
