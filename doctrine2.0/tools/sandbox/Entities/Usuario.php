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
     * @Column(type="integer", length=11, name="id_perfil")
     */
    private $perfil;
    /**
     * @Column(type="string", length=32, name="login")
     */
    private $name;
    /**
     * @Column(type="string", length=64, name="senha")
     */
    private $pass;

    function __construct($id = 0, $perfil = 0, $name = null, $pass = null) {
        $this->id = $id;
        $this->perfil = $perfil;
        $this->name = $name;
        $this->pass = md5($pass);
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

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPass() {
        return $this->pass;
    }

    public function setPass($pass) {
        $this->pass = md5($pass);
    }

}