<?php


/**
 * Ma classe Membre
 * 
 * Description : Dans cette classe sont regroupés toutes les méthodes concernant un membre
 * 
 * @author elena tasquier
 * @copyright Février 2020
 * @version 1.0
 * 
 */
class membre
{

    private $_NumMembre;
    private $_Nom;
    private $_Prenom;
    private $_Tel;
    private $_Courriel;
    private $_MotDePasse;
    private $_VerifMdp;
    private $_DateNaissance;
    private $_AnneeXpKarting;
    private $_Poids;
    private $_Photo;



    
    /**
     * __construct
     *
     * @param  mixed $nom
     * @param  mixed $prenom
     * @param  mixed $tel
     * @param  mixed $courriel
     * @param  mixed $mdp
     * @param  mixed $VerifMdp
     * @param  mixed $ddn
     * @param  mixed $xpKarting
     * @param  mixed $poids
     * @param  mixed $photo
     *
     * @return void
     */
    public function __construct($nom, $prenom, $tel, $courriel, $mdp, $VerifMdp, $ddn, $xpKarting, $poids, $photo)
    {
        $this->__set("_Nom", $nom);
        $this->__set("_Prenom", $prenom);
        $this->__set("_Tel", $tel);
        $this->__set("_Courriel", $courriel);
        $this->__set("_MotDePasse", $mdp);
        $this->__set("_VerifMdp", $VerifMdp);
        $this->__set("_DateNaissance", $ddn);
        $this->__set("_AnneeXpKarting", $xpKarting);
        $this->__set("_Poids", $poids);
        $this->__set("_Photo", $photo);

    }


    
    /**
     * __get : retourne les attributs privé de la classe
     *
     * @param  mixed $name
     *
     * @return void
     */
    public function __get($name)
    {
        return $this->$name;
    }

    
    /**
     * __set : permet de caster les attributs de la classe
     *
     * @param  mixed $name
     * @param  mixed $valeur
     *
     * @return void
     */
    public function __set($name, $valeur)
    {
        if ($name == "_AnneeXpKarting" || $name == "_Poids")
        {
            $this->$name = (int)$valeur;
        }
        else
        {
            $this->$name = (string)$valeur;
        }
    }


    
    /**
     * AjouterMembre : ajouter un membre dans la base de donnée
     *
     * @return void
     */
    public function AjouterMembre()
    {
        global $bdd;

        $requete = $bdd->prepare('INSERT INTO `membre` (`Nom`, `Prenom`, `Tel`, `Courriel`, `MotDePasse`, `DateNaissance`, `AnneeXpKarting`, `Poids`, `Photo`)
		VALUES (:nom, :prenom, :tel, :courriel, :mdp, :ddn, :xpKarting, :poids, :photo)');
		
		$requete->bindValue(':nom', $this->_Nom);
		$requete->bindValue(':prenom', $this->_Prenom);
		$requete->bindValue(':tel', $this->_Tel);
		$requete->bindValue(':courriel', $this->_Courriel);
		$requete->bindValue(':mdp', $this->_MotDePasse);
		$requete->bindValue(':ddn', $this->_DateNaissance);
		$requete->bindValue(':xpKarting', $this->_AnneeXpKarting);
		$requete->bindValue(':poids', $this->_Poids);
		$requete->bindValue(':photo', $this->_Photo);
        $requete->execute();

    }

        
    /**
     * ConnexionAdmin : permet de vérifier si un membre est admin ou non
     *
     * @param  mixed $email
     * @param  mixed $mdp
     * @return void
     */
    public static function ConnexionAdmin($email, $mdp)
    {
        global $bdd;

        $requete = $bdd->prepare('SELECT * FROM membre INNER JOIN `admin` ON (membre.NumMembre = admin.NumMembre) WHERE Courriel = :mail and MotDePasse = :mdp');
        $requete->bindParam(":mail", $email);
        $requete->bindParam(":mdp", $mdp);
        $requete->execute() or die();

        $resultat = $requete->fetchAll();
        return $resultat;
    }



    /**
     * ConnexionMembre : permet de vérifier qu'un membre est présent dans la bdd
     *
     * @param  mixed $email
     * @param  mixed $mdp
     *
     * @return void
     */
    public static function ConnexionMembre($email, $mdp)
    {
        global $bdd;

        $requete = $bdd->prepare('SELECT * FROM membre WHERE Courriel = :mail and MotDePasse = :mdp');
        $requete->bindParam(":mail", $email);
        $requete->bindParam(":mdp", $mdp);
        $requete->execute() or die();

        $resultat = $requete->fetchAll();
        return $resultat;
    }


    
    /**
     * SelectMembre : selectionne tous les membres de la bdd
     *
     * @return void
     */
    public static function SelectMembre()
    {
        global $bdd;

        $requete = $bdd->query('SELECT * FROM membre ORDER BY Prenom');

        $resultat = $requete->fetchAll();

        return $resultat;
    }


    
    /**
     * SelectMembreParCourse : selectionne tous les membres participants à une course
     *
     * @param  mixed $numCourse
     *
     * @return void
     */
    public static function SelectMembreParCourse($numCourse)
    {
        global $bdd;

        $requete = $bdd->prepare('SELECT Nom, Prenom, Tel, Courriel, AnneeXpKarting FROM membre INNER JOIN achat on (achat.NumMembre = membre.NumMembre) WHERE achat.NumCourse = :course AND panier = 0');
        $requete->bindValue(":course", $numCourse);

        $requete->execute();

        $resultat = $requete->fetchAll();

        return $resultat;
    }

}
