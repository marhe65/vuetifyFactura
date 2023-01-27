<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"),true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$numero_factura = (isset($_POST['numero_factura'])) ? $_POST['numero_factura'] : '';
$nombre_cliente = (isset($_POST['nombre_cliente'])) ? $_POST['nombre_cliente'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$articulo = (isset($_POST['articulo'])) ? $_POST['articulo'] : '';
$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$valor_unitario = (isset($_POST['valor_unitario'])) ? $_POST['valor_unitario'] : '';
$subtotal = (isset($_POST['subtotal'])) ? $_POST['subtotal'] : '';
$iva = (isset($_POST['iva'])) ? $_POST['iva'] : '';
$total = (isset($_POST['total'])) ? $_POST['total'] : '';

switch ($opcion) {
    case 1://registrar
        $consulta = "INSERT INTO facturas (numero_factura, nombre_cliente, fecha, articulo, 
        cantidad, valor_unitario, subtotal, iva, total) VALUES('$numero_factura','$nombre_cliente',
        '$fecha','$articulo','$cantidad','$valor_unitario','$subtotal','$iva','$total')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 2://edición - actualizar
        $consulta = "UPDATE facturas SET numero_factura='$numero_factura', nombre_cliente='$nombre_cliente',
                fecha='$fecha', articulo='$articulo', cantidad='$cantidad', valor_unitario='$valor_unitario', 
                subtotal='$subtotal', iva='$iva', total='$total' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3://borrar
        $consulta = "DELETE FROM facturas WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 4://listar
        $consulta = "SELECT numero_factura, nombre_cliente, fecha, articulo, cantidad, valor_unitario, subtotal, iva, total FROM facturas";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>