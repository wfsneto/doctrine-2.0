<?php

namespace modelo;

/**
 * Class Usuario.
 * @Entity
 * @Table(name="usuario")
 * @ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Usuario {

    /**
     * id of Usuario
     * @var int
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * nome of Usuario
     * @var string
     * @Column(type="string")
     */
    private $nome;

    /**
     * Constructor of Usuario.
     * @param int $id
     * @param string $nome
     */
    public function __construct($id=0, $nome="") {
        $this->id = $id;
        $this->nome = $nome;
    }

    /**
     * Getter method of id
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Setter method of id
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Getter method of nome
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Setter method of nome
     * @param string $nome
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }

}

?>