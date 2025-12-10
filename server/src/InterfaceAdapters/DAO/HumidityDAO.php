<?php

namespace App\InterfaceAdapters\DAO;

use App\Application\DAO\HumidityDAOInterface;
use App\Application\DTOs\HumidityDTO;
use PDO;

readonly class HumidityDAO implements HumidityDAOInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getAllHumidity(): array
    {
        $sql = "SELECT * FROM humidity ORDER BY analyzed_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn ($row) => HumidityDTO::fromArray($row), $results);
    }

    public function saveHumidity(HumidityDTO $humidity): void
    {
        $sql = "INSERT INTO humidity (value, analyzed_at) VALUES (:value, :analyzed_at)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':value', $humidity->getValue());
        $stmt->bindValue(':analyzed_at', $humidity->getAnalyzedAt());

        $stmt->execute();
    }

    public function clearHumidityHistory(): void
    {
        $sql = "DELETE FROM humidity";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
}