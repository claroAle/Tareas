<?php
    //Practica programada 3 - Estado de cuenta tarjeta de credito
    //Autor: Gabriel Claro

    $transacciones = [];

    function registrarTransaccion($transacciones, $id, $descripcion, $monto){
        array_push($transacciones, ["id" => $id, "descripcion" => $descripcion, "monto" => $monto]);
        return $transacciones;
    }

    function generarEstadoDeCuenta($transacciones){
        $montoContado = 0;

        foreach($transacciones as $transaccion){
            $montoContado = $montoContado + $transaccion["monto"];
        }

        $montoConInteres = $montoContado + ($montoContado * 0.026);
        $reembolso = $montoContado * 0.001;
        $montoFinal = $montoConInteres - $reembolso;

        $textoEstado = "ESTADO DE CUENTA\n";
        $textoEstado = $textoEstado . "Transacciones:\n";

        foreach($transacciones as $transaccion){
            $textoEstado = $textoEstado . $transaccion["id"] . " - " . $transaccion["descripcion"] . ": " . $transaccion["monto"] . "\n";
        }

        $textoEstado = $textoEstado . "Monto de contado: " . round($montoContado, 2) . "\n";
        $textoEstado = $textoEstado . "Monto con interes (2.6%): " . round($montoConInteres, 2) . "\n";
        $textoEstado = $textoEstado . "Reembolso (0.1%): " . round($reembolso, 2) . "\n";
        $textoEstado = $textoEstado . "Monto final a pagar: " . round($montoFinal, 2) . "\n";

        file_put_contents("estado_cuenta.txt", $textoEstado);

        echo "<pre>" . $textoEstado . "</pre>";
    }

    $transacciones = registrarTransaccion($transacciones, 1, "Supermercado", 45000);
    $transacciones = registrarTransaccion($transacciones, 2, "Gasolina", 30000);
    $transacciones = registrarTransaccion($transacciones, 3, "Restaurante", 18500.50);
    $transacciones = registrarTransaccion($transacciones, 4, "Farmacia", 12000);
    $transacciones = registrarTransaccion($transacciones, 5, "Ropa", 35000);

    generarEstadoDeCuenta($transacciones);
?>
