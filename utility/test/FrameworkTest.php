<?php

/**
 * Carregando os arquivos necess�rios para realização dos testes
 */
require_once 'test/include.php';

class FrameworkTest extends PHPUnit_Framework_TestCase {

    /**
     * Fun��o testControll()
     * Testa as funcionalidades do Contoll
     */
    public function testControll() {

        $controll = Controll::getControll();

        $this->assertObjectHasAttribute('instancia', $controll);
        $this->assertFileExists(CONFIG);

        $controll->setFlash('Lorem ipsum');
        $this->assertEquals('Lorem ipsum', $controll->getFlash());

        $this->assertArrayHasKey('host', $controll->getConfig('database'));
        $this->assertArrayHasKey('user', $controll->getConfig('database'));
        $this->assertArrayHasKey('pass', $controll->getConfig('database'));
        $this->assertArrayHasKey('db', $controll->getConfig('database'));
        $this->assertArrayHasKey('encoding', $controll->getConfig('database'));

        $this->assertArrayHasKey('title', $controll->getConfig('config'));
        $this->assertArrayHasKey('publicado', $controll->getConfig('config'));
        $this->assertArrayHasKey('hora_publicacao', $controll->getConfig('config'));
    }

    /**
     * Fun��o testConnect()
     * Testa as funcionalidades de conex�o com banco de dados
     */
    public function testConnect() {

        $conexao = Connect::getInstancia();
        $this->assertObjectHasAttribute('instancia', $conexao);
    }

    /**
     * Fun��o testFunctions()
     * Testa as funcionalidades gen�ricas do controlador
     */
    public function testFunctions() {

        $this->assertEquals('3000/12/30', formataData('30-12-3000'));
        $this->assertEquals('30-12-3000', formataData('3000/12/30'));
    }

}

?>