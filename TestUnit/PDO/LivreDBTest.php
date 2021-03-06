<?php

require_once "../Constantes.php";
//include_once "../PDO/connectionPDO.php";
require_once "../metier/Livre.php";
require_once "../PDO/LivreDB.php";

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-07-06 at 14:04:17.
 */
class LivreDBTest extends PHPUnit_Framework_TestCase {

    /**
     * @var LivreDB
     */
    protected $object;
    protected $pdodb;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        //parametre de connexion à la bae de donnée
        $strConnection = Constantes::TYPE . ':host=' . Constantes::HOST . ';dbname=' . Constantes::BASE;
        $arrExtraParam = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $this->pdodb = new PDO($strConnection, Constantes::USER, Constantes::PASSWORD, $arrExtraParam); //Ligne 3; Instancie la connexion
        $this->pdodb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers LivreDB::ajout
     * @todo   Implement testAjout().
     */
    public function testAjout() {
        try {
            $this->object = new LivreDB($this->pdodb);
            $l = new Livre("Victor Hugo", "livre réédité des Miserables", "Galimard", "les Miserables");
          
            $this->object->ajout($l);
           
            $livre = $this->object->selectLivre("99");
            $this->assertEquals($l->getAuteur(), $livre->getAuteur());
            $this->assertEquals($l->getEdition(), $livre->getEdition());
            $this->assertEquals($l->getInformation(), $livre->getInformation());
            $this->assertEquals($l->getTitre(), $livre->getTitre());
        } catch (Exception $e) {
            echo 'Exception recue : ', $e->getMessage(), "\n";
        }
    }

    /**
     * @covers LivreDB::update
     * @todo   Implement testUpdate().
     */
    public function testUpdate() {
        $this->object = new LivreDB($this->pdodb);
        $l = new Livre("Flaubert", "livre de Flaubert", "Galimard", "titre update");
        $l->setId("99");
      $this->object->update($l);
       //TODO  à finaliser 
    }

    /**
     * @covers LivreDB::suppression
     * @todo   Implement testSuppression().
     */
    public function testSuppression() {
        try {
            $this->object = new LIvreDB($this->pdodb);

            $livre = $this->object->selectLivre("99");
            $nb = $this->object->suppression($livre);

            if ($nb == 0) {
                $this->markTestIncomplete(
                        'Le test de suppression Livre a rencontré une erreur.'
                );
            }
        } catch (Exception $e) {
            //verification exception
            $exception = "RECORD LIVRE not present in DATABASE";
            $this->assertEquals($exception, $e->getMessage());
        }
    }

    /**
     * @covers LivreDB::selectAll
     * @todo   Implement testSelectAll().
     */
    public function testSelectAll() {
        $this->object = new LivreDB($this->pdodb);
        $res = $this->object->selectAll();
        $i = 0;
        foreach ($res as $key => $value) {
            $i++;
        }


        if ($i == 0) {
            $this->markTestIncomplete(
                    'Pas de résultat-pas de livre trouvé en bdd'
            );
        }
        print_r($res);
    }

    /**
     * @covers LivreDB::selectLivre
     * @todo   Implement testSelectLivre().
     */
    public function testSelectLivre() {
        $this->object = new LivreDB($this->pdodb);
        $livre = new Livre("Flaubert", "livre de Flaubert", "Galimard", "titre update");
    
       $nb= $this->object->ajout($livre);
       //print_r("id=".$nb); 
       $l = $this->object->selectLivre($nb);
     //  print_r($l);
        
        $this->assertEquals($l->getAuteur(), $livre->getAuteur());
        $this->assertEquals($l->getEdition(), $livre->getEdition());
        $this->assertEquals($l->getInformation(), $livre->getInformation());
        $this->assertEquals($l->getTitre(), $livre->getTitre());
    }

}
