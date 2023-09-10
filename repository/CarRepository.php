<?php
namespace CarInventory\repository;

use CarInventory\model\Car;
use CarInventory\data\DataTransferObject;

class CarRepository
{
    private $dataTransferObject;

    public function __construct(DataTransferObject $dataTransferObject)
    {
        $this->dataTransferObject = $dataTransferObject;
    }

    public function getAllCars()
    {
        $carData = $this->dataTransferObject->fetchData('cars.json');
        $cars = [];

        foreach ($carData as $carDataItem) {
            $cars[] = Car::fromJson(json_encode($carDataItem));
        }

        return $cars;
    }

    public function sortCarsByPrice()
    {
        $cars = $this->getAllCars();
        usort($cars, function ($a, $b) {
            return $a->price - $b->price;
        });
        return $cars;
    }
}
