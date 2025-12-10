<?php

use App\Application\DAO\HumidityDAOInterface;
use App\InterfaceAdapters\DAO\HumidityDAO;
use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    PDO::class => function () {
        $host = getenv('DB_HOST');
        $db   = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWORD');
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    },
    HumidityDAOInterface::class => DI\get(HumidityDAO::class)
]);

return $containerBuilder->build();
