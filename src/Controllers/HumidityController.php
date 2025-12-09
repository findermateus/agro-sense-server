<?php

namespace App\Controllers;

use App\Application\UseCases\GetHumidityHistory;
use App\Application\UseCases\SaveHumidity;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HumidityController
{
    public function __construct(
        private SaveHumidity $saveHumidity,
        private GetHumidityHistory $getHumidityHistory
    )
    {
    }

    public function saveHumidity(ResponseInterface $response, RequestInterface $request, array $args): ResponseInterface
    {
        $humidityValue = (float) $args['humidityValue'];
        $this->saveHumidity->execute($humidityValue);

        return $response->withStatus(201);
    }

    public function getHumidityHistory(ResponseInterface $response): ResponseInterface
    {
        $humidityHistory = $this->getHumidityHistory->execute();
        $response->getBody()->write(json_encode($humidityHistory));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
