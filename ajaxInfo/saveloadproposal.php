<?php
require_once '../lib/DataSourceResult.php';
require_once '../lib/Kendo/Autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');
    

    $request = json_decode(file_get_contents('php://input'));

    $result = new DataSourceResult('mysql:host=localhost;dbname=webWithGoogle', 'root', '');

    $type = $_GET['type'];

    $columns = array('id', 'name', 'savedata', 'linkos');

    switch($type) {
        case 'create':
            $result = $result->create('proposals', $columns, $request->models, 'id');
            break;
        case 'read':
            $result = $result->read('proposals', $columns, $request, 'id');
            break;
        case 'update':
            $result = $result->update('proposals', $columns, $request->models, 'id');
            break;
        case 'destroy':
            $result = $result->destroy('proposals', $request->models, 'id');
            break;
    }

$testVariable = json_encode($result, TRUE);

    echo json_encode($result, TRUE);

    exit;
}
?>
