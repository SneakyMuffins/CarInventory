<?php
namespace CarInventory\controller;

use CarInventory\repository\CarRepository;
use CarInventory\data\DataTransferObject;

class CarController
{
    private $dataTransferObject;

    public function __construct()
    {
        $this->dataTransferObject = new DataTransferObject();
    }

    public function index()
    {
        $carRepository = new CarRepository($this->dataTransferObject);
        $cars = $carRepository->getAllCars();
        header('Content-Type: application/json');
        echo json_encode($cars);
    }
    
    public function sort($params)
    {
        $carRepository = new CarRepository($this->dataTransferObject);
        $sortBy = $params['sortBy'];
    
        if ($sortBy === 'price') {
            $cars = $carRepository->sortCarsByPrice();
        } elseif ($sortBy === 'color') {
            $cars = $carRepository->sortCarsByColor();
        } else {
            header("HTTP/1.0 400 Bad Request");
            echo 'Invalid sorting parameter';
            return;
        }
    
        header('Content-Type: application/json');
        echo json_encode($cars);
    }
}
