<?php
include_once 'fpdf/fpdf.php';
$pdf= new FPDF();
$pdf->AliasNbPages();
$pdf-> AddPage();
$pdf-> Image("img/perro.jpg",10,10,20,20,"jpg");
$pdf->Ln();
$pdf->SetFont("Arial","B",16);
$pdf->SetX(70);
$pdf->Cell(30,10,utf8_decode("Reporte de usuario al dia").date("d-m-Y"));
$pdf->Ln(40);
$pdf->SetFont("Arial","B",8);
$pdf->Cell(5,5,"#",1,0,"C");
$pdf->Cell(15,5,"Nombre",1,0,"C");
$pdf->Cell(17,5,"Apellidos",1,0,"C");
$pdf->Cell(15,5,"Edad",1,0,"C");
$pdf->Cell(15,5,"Genero",1,0,"C");
$pdf->Cell(20,5,"Hra_Entrada",1,0,"C");
$pdf->Cell(20,5,"Hra_Salida",1,0,"C");
$pdf->Cell(20,5,"Area",1,0,"C");
$pdf->Cell(20,5,"instructor",1,0,"C");
$pdf->Cell(20,5,"Forma_pago",1,0,"C");
$pdf->Cell(20,5,"Direccion",1,0,"C");

$pdf->Ln();
$mysqli = new mysqli("localhost", "root", "", "gym");
$query="SELECT * FROM personas";
$respuesta = array();
if ($result = $mysqli->query($query))
    {
        while($row = $result->fetch_array(MYSQLI_ASSOC))
        {
                $respuesta[] = $row;
        }
    }
 $i=1;
foreach ($respuesta as $value){
    $pdf->SetFont("Arial","",8);
    $pdf->Cell(5,5,$i,1,0,"C");
    $pdf->Cell(15,5, utf8_decode ($value["nombre"]),1,0,"C");
    $pdf->Cell(17,5, utf8_decode ($value["apellidos"]),1,0,"C");
    $pdf->Cell(15,5, $value["edad"],1,0,"C");
    $pdf->Cell(15,5,$value["genero"],1,0,"C");
   $pdf->Cell(20,5, utf8_decode ($value["horas"]),1,0,"C");
    $pdf->Cell(20,5, utf8_decode ($value["efectivo"]),1,0,"C");
    $pdf->Cell(20,5, $value["area"],1,0,"C"); 
    $pdf->Cell(20,5, utf8_decode ($value["instructor"]),1,0,"C");
    $pdf->Cell(20,5, $value["tarjeta"],1,0,"C");
   $dom =$value["domicilio"];
    if(strlen ($dom)<10){
        $tfd=10;
    }
    else if(strlen ($dom)<15){
        $tfd=9;
    }
    else if(strlen ($dom)>10){
        $tfd=8;
    }
    else
    {
        $tfd=7;
    }
    
    
    
    
     $pdf->SetFont("Arial","",$tfd);
    $pdf->Cell(70,5, utf8_decode($dom),1,0,"C");
 $pdf->Ln();
 $i++;
 }
 $pdf->SetY(260);
    $pdf->SetFont('Arial','I',8);
    $pdf->SetTextColor(128);
$pdf->Cell(0,10, utf8_decode("Pagina").$pdf->PageNo()."de {nb}",0,0,"R");

$pdf-> Output();
