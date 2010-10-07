<?php

/**
 * BaseCidade
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nome
 * @property string $uf
 * @property Doctrine_Collection $Pessoa
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCidade extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('cidade');
        $this->hasColumn('id', 'integer', 8, array(
             'fixed' => 0,
             'primary' => true,
             'autoincrement' => true,
             'type' => 'integer',
             'length' => '8',
             ));
        $this->hasColumn('nome', 'string', 500, array(
             'fixed' => 1,
             'notnull' => true,
             'type' => 'string',
             'length' => '500',
             ));
        $this->hasColumn('uf', 'string', 2, array(
             'fixed' => 1,
             'notnull' => true,
             'type' => 'string',
             'length' => '2',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Pessoa', array(
             'local' => 'id',
             'foreign' => 'id_cidade'));
    }
}