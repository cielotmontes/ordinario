<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//var_dump($_POST);
$nombre= $_POST["nombre"];
$apellidos= $_POST["apellidos"];
$edad= $_POST["edad"];
$genero= $_POST["genero"];
$domicilio= $_POST["domicilio"];
$efectivo= $_POST["efectivo"];
$horas= $_POST["horas"];
$area= $_POST["area"];
$instructor= $_POST["instructor"];
$op= $_POST["op"];

$tarjeta= $_POST["tarjeta"];
$id=$_POST["id"];
$mysqli = new mysqli("localhost", "root", "", "gym");
if($op=="1")
{
    guardar($nombre,$apellidos,$edad,$genero,$domicilio,$efectivo,$horas,$area,$instructor,$tarjeta ,$mysqli);
}
if($op=="2")
{
    show_persona($mysqli);
}
if($op=="3")
{
    eliminar($id,$mysqli);
}
if($op=="4")
{
    editar($id, $nombre, $apellidos, $edad, $genero, $domicilio,$efectivo,$horas,$area,$instructor,$tarjeta , $mysqli);
}
function show_persona($mysqli)
{
    $query="SELECT * FROM personas";
    $respuesta = array();
    if ($result = $mysqli->query($query))
    {
        while($row = $result->fetch_array(MYSQLI_ASSOC))
        {
                $respuesta[] = $row;
        }
    }
    echo json_encode($respuesta);
}

function guardar($nombre, $apellidos, $edad, $genero, $domicilio,$efectivo,$horas,$area,$instructor,$tarjeta , $mysqli)
{
    if ($mysqli->query("INSERT INTO personas VALUES ('null','$nombre','$apellidos',$edad,'$genero','$domicilio','$efectivo','$horas','$area','$instructor','$tarjeta')"))
    {
    $respuesta="OK";
    }
    else
    {
      $respuesta="Error ". $mysqli->connect_error;
    }
    echo json_encode($respuesta);
}

function eliminar($id,$mysqli)
{
    $query="DELETE FROM personas WHERE id='$id'";
    if($mysqli->query($query))
    {
        $respuesta="OK";
    }
    else
    {
        $respuesta="Error";
    }
    echo json_encode($respuesta);
}
function editar($id,$nombre,$apellidos,$edad,$genero,$domicilio,$efectivo,$horas,$area,$instructor,$tarjeta , $mysqli)
{
    $query="UPDATE personas SET nombre='$nombre',apellidos='$apellidos',edad='$edad',genero='$genero',domicilio='$domicilio',efectivo='$efectivo',horas='$horas',area='$area',instructor='$instructor',tarjeta='$tarjeta''WHERE id='$id'";
     if($mysqli->query($query))
    {
        $respuesta="OK";
    }
    else
    {
        $respuesta="Error";
    }
    echo json_encode($respuesta);
}
