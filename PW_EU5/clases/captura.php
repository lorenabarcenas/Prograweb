<?php
require '../config/config.php';
require '..config/database.php';
$db = new Database();/*Instancia de esta clase*/
$conn = $db->conectar();


$json = file_get_contents('php://input');
$datos = json_decode($json, true);
echo '<pre>';
print_r($datos);
echo '</pre>';

if(is_array($datos))
{
    $id_transaccion = $datos['detalles']['id'];
    $total = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $status = $datos['detalles']['status'];
    $fecha = $datos['detalles']['update_time'];
    $fecha_nueva = date('Y-m-d H:i:s',strtotime($fecha));
    $email = $datos['detalles']['payer']['email_address'];
    $id_cliente = $datos['detalles']['payer']['payer_id'];

    $sql = $conn->prepare("INSERT INTO compra(id_transaccion,fecha, status, email, id_cliente, total)VALUES(?,?,?,?,?,?)");
    $sql->execute([$id_transaccion, $fecha_nueva, $status, $email, $id_cliente, $total]);

    $id = $conn->lastInsertId();

}
?>
