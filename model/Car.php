<?php
namespace CarInventory\model;

class Car
{
    public $car_name;
    public $price;
    public $discount;
    public $hand;
    public $availability;
    public $color;

    public function __construct($car_name, $price, $discount, $hand, $availability, $color)
    {
        $this->car_name = $car_name;
        $this->price = $price;
        $this->discount = $discount;
        $this->hand = $hand;
        $this->availability = $availability;
        $this->color = $color;
    }

    public static function fromJson($json)
    {
        $carData = json_decode($json, true);
        return new self(
            $carData['car_name'],
            $carData['price'],
            $carData['discount'],
            $carData['hand'],
            $carData['availability'],
            $carData['color']
        );
    }
}
