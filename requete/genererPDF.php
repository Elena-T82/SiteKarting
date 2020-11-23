<?php

include '../bdd.php';
require('../fpdf.php');

if(isset($_GET['course']))
{
    $numCourse = $_GET['course'];

    $laCourse = Course::SelectCourseSpecifique($numCourse);


    $resultat = Membre::SelectMembreParCourse($numCourse);

    $nomColonne = array('Nom'=>'Nom', 'Prenom'=> 'Prénom', 'Tel'=>'Téléphone', 'Courriel'=> 'Courriel','AnneeXpKarting'=> 'Année XP karting');
    $tailleCellule = array(33,30,35,60,35);

}


class PDF extends FPDF
{
    // Page header
    function Header()
    {
        global $laCourse;
        // Logo
        $this->Image('../img/logo.png',3,0,50);
        $this->SetFont('Arial','B',13);
        // Move to the right
        $this->Cell(60);
        // Title
        $this->Cell(130,15,'Membres de la course : ' . utf8_decode($laCourse[0]['Description']),1,0,'C');
        // Line break
        $this->Ln(35);
    }
    
    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',9);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

if(isset($_GET['course']))
{

    $pdf = new PDF();
    //header
    $pdf->AddPage();
    //foter page
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial','',11);
    
    $indexTableau=0;

    foreach($nomColonne as $col) {

        $pdf->Cell($tailleCellule[$indexTableau],12,utf8_decode($col),1, 0, 'C');

        $indexTableau++;

    }

    foreach($resultat as $ligne){

        $pdf->Ln();

        $indexTableau=0;

            for($i = 0; $i < count($ligne)/2; $i++){

                $pdf->Cell($tailleCellule[$indexTableau],12,utf8_decode($ligne[$i]),1);

                $indexTableau++;
            }
    }
            
        $pdf->Output();
    }
?>