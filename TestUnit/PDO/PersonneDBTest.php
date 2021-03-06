<?php

require_once "../Constantes.php";
//include_once "../PDO/connectionPDO.php";
require_once "../metier/Personne.php";
require_once "../PDO/PersonneDB.php";
/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-05-28 at 13:23:51.
 */
class PersonneDBTest extends PHPUnit_Framework_TestCase {

    /**
     * @var PersonneDB
     */
    protected $object;
    protected $pdodb;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    
      /**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/ 

    protected function setUp() {
        //parametre de connexion à la bae de donnée
    $strConnection = Constantes::TYPE.':host='.Constantes::HOST.';dbname='.Constantes::BASE; 
    $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
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
     * @covers PersonneDB::ajout
     * 

     * /**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/     
    public function testAjout() {
       try{ 
   $this->object = new PersonneDB($this->pdodb);
  $p=new Personne("moulinS", "jean","1899-01-20","0145124512","jmoulin@orange.fr");

$this->object->ajout($p);

$pers2=$this->object->selectionNom($p->getNom());
$this->assertEquals($p->getNom(),$pers2->getNom());
$this->assertEquals($p->getPrenom(),$pers2->getPrenom());
$this->assertEquals($p->getDatenaissance(),$pers2->getDatenaissance());
$this->assertEquals($p->getTelephone(),$pers2->getTelephone());
$this->assertEquals($p->getEmail(),$pers2->getEmail());

    }
    catch  (Exception $e) {
    echo 'Exception recue : ',  $e->getMessage(), "\n";
}

    }  /**
     * @covers PersonneDB::suppression
     */
  /**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/ 
    public function testSuppression() {
        try{
  $this->object = new PersonneDB($this->pdodb);

  $pers=$this->object->selectionNom("moulinS");
$nb=$this->object->suppression($pers);

if($nb == 0){
      $this->markTestIncomplete(
                'Le test de suppression Personne a rencontré une erreur.'
        );
}
    }  catch (Exception $e){
        //verification exception
        $exception="RECORD PERSONNE not present in DATABASE";
        $this->assertEquals($exception,$e->getMessage());

    }
        
    }

    /**
     * @covers PersonneDB::selectionNom
     */
      /**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/ 
    public function testSelectionNom() {
     $this->object = new PersonneDB($this->pdodb);
 $p=new Personne("Valjean", "jean","1899-01-20","0712233445","jvaljean@free.fr");

$this->object->ajout($p);



$pers=$this->object->selectionNom($p->getNom());
$this->assertEquals($p->getNom(),$pers->getNom());
$this->assertEquals($p->getPrenom(),$pers->getPrenom());
$this->assertEquals($p->getDatenaissance(),$pers->getDatenaissance());
$this->assertEquals($p->getTelephone(),$pers->getTelephone());
$this->assertEquals($p->getEmail(),$pers->getEmail());

    }

    /**
     * @covers PersonneDB::selectionId
     *
     */
     /**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/ 
    public function testSelectionId() {
         $this->object = new PersonneDB($this->pdodb);
         $p=$this->object->selectionNom("Valjean");
         $pers=$this->object->selectionId($p->getId());
           $this->assertEquals($p->getId(),$pers->getId());
         $this->assertEquals($p->getNom(),$pers->getNom());
$this->assertEquals($p->getPrenom(),$pers->getPrenom());
$this->assertEquals($p->getDatenaissance(),$pers->getDatenaissance());
$this->assertEquals($p->getTelephone(),$pers->getTelephone());
$this->assertEquals($p->getEmail(),$pers->getEmail());
         
    }

    /**
     * @covers PersonneDB::selectAll
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
    public function testSelectAll() {
    $this->object = new PersonneDB($this->pdodb);
    $res=$this->object->selectAll();
    $i=0;
   foreach ($res as $key=>$value) {
       $i++; 
   }


if($i==0){
       $this->markTestIncomplete(
                'Pas de résultat'
        );
    
}
    print_r($res);
    }

    /**
     * @covers PersonneDB::convertPdoPers
     * @backupGlobals disabled
* @backupStaticAttributes disabled
*/
    public function testConvertPdoPers() {
     $tab["id"]="34";
     $tab["nom"]="Dupont";
     $tab["prenom"]="Jacques";
     $tab["email"]="dupont@free.fr";
     $tab["telephone"]="0645342312";
     $tab["datenaissance"]="2002-12-12";
     $this->object = new PersonneDB($this->pdodb);
     $pers= $this->object->convertPdoPers($tab);
     $this->assertEquals($tab["nom"],$pers->getNom());
$this->assertEquals($tab["prenom"],$pers->getPrenom());
$this->assertEquals( $tab["datenaissance"],$pers->getDatenaissance());
$this->assertEquals($tab["telephone"],$pers->getTelephone());
$this->assertEquals(  $tab["email"],$pers->getEmail());
     
    }

    /**
     * @covers PersonneDB::update
     * @todo   Implement testUpdate().
       * @backupGlobals disabled
* @backupStaticAttributes disabled
*/
    public function testUpdate() {
      $this->object = new PersonneDB($this->pdodb);
  $p=new Personne("Martin", "Eric","1999-01-20","0145124512","meric@orange.fr");
$p->setId("58");
$this->object->update($p);  
 //TODO  à finaliser 

    }

}
