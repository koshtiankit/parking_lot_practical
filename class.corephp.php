<?php
define("FILE_NAME", "allocate_parking.json");
class Cars {
    public $totalSlots = 0;
    public $obj = [
        "total_slot" => 0,
        "parking_slot" => []
    ];
    private $car = [
        "color" => "",
        "number" => "",
        "slot" => "",
        "id" => ""
    ];

    public $fileContent = null;
        
}
?>
