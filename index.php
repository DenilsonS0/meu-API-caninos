<?php
require_once 'conexao.php';

if (isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);
    if ($url[0] === 'api') {
        array_shift($url);
        $service = ucfirst($url[0]) . 'Service';
        if (file_exists($service . '.php')) {
            require_once $service . '.php';
        } else {
            echo json_encode(['error' => 'Serviço não encontrado']);
        }
    } else {
        echo json_encode(['error' => 'EndPoint incorreto']);
    }
} else {
    echo json_encode(['error' => 'Nenhum endpoint fornecido']);
}
?>

