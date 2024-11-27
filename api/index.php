<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'database.php';
include_once 'vehicle.php';

$database = new Database();
$db = $database->getConnection();

$vehicle = new Vehicle($db);

$method = $_SERVER['REQUEST_METHOD'];

// Detecta se os dados foram enviados como JSON ou form-data
$data = json_decode(file_get_contents("php://input"));
$license_plate = null;

// Captura a placa do veículo com base no formato de envio
if ($data && isset($data->license_plate)) {
    $license_plate = $data->license_plate; // Requisição via JSON
} elseif (isset($_POST['license_plate'])) {
    $license_plate = $_POST['license_plate']; // Requisição via form-data
}

if ($method == 'POST' && isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'entry':
            if ($license_plate) {
                $vehicle->license_plate = $license_plate;
                if ($vehicle->registerEntry()) {
                    echo json_encode(["message" => "Vehicle entry registered."]);
                } else {
                    echo json_encode(["message" => "Unable to register entry."]);
                }
            } else {
                echo json_encode(["message" => "License plate is missing."]);
            }
            break;

        case 'exit':
            if ($license_plate) {
                $vehicle->license_plate = $license_plate;
                if ($vehicle->registerExit()) {
                    echo json_encode(["message" => "Vehicle exit registered."]);
                } else {
                    echo json_encode(["message" => "Unable to register exit."]);
                }
            } else {
                echo json_encode(["message" => "License plate is missing."]);
            }
            break;

        case 'payment':
            if ($license_plate) {
                $vehicle->license_plate = $license_plate;
                if ($vehicle->makePayment()) {
                    echo json_encode(["message" => "Payment successful."]);
                } else {
                    echo json_encode(["message" => "Unable to process payment."]);
                }
            } else {
                echo json_encode(["message" => "License plate is missing."]);
            }
            break;

        case 'can_exit':
            if ($license_plate) {
                $vehicle->license_plate = $license_plate;
                if ($vehicle->canExit()) {
                    echo json_encode(["message" => "Vehicle can exit."]);
                } else {
                    echo json_encode(["message" => "Vehicle cannot exit."]);
                }
            } else {
                echo json_encode(["message" => "License plate is missing."]);
            }
            break;

        default:
            echo json_encode(["message" => "Invalid action."]);
            break;
    }
} else {
    echo json_encode(["message" => "Invalid request."]);
}

?>
