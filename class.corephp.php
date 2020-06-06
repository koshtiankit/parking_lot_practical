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
    
    protected function __construct() {
        $this->readFile();
        if (isset($this->fileContent->total_slot)) {
            $total_slot = $this->fileContent->total_slot;
            $this->writeFile($total_slot, "total_slot");
        }
        if (isset($this->fileContent->parking_slot)) {
            $parking_slot = $this->fileContent->parking_slot;
            $this->writeFile($parking_slot, "parking_slot");
        }
    }

    public function writeFile($data, $variable) {
        if (file_exists(FILE_NAME)) {
            $myfile = fopen(FILE_NAME, "w") or die("Unable to open file!");
            $this->obj[$variable] = $data;
            $txt = $this->obj;
            fwrite($myfile, json_encode($txt));
            fclose($myfile);
        } else {
            echo "Please start with step number 1";
        }
    }

    public function readFile() {
        if (file_exists(FILE_NAME)) {
            $myfile = fopen(FILE_NAME, "r") or die("Unable to open file!");
            $this->fileContent = json_decode(fread($myfile,filesize(FILE_NAME)));
            fclose($myfile);
        } else {
            echo "Please start with step number 1";
        }
    }

    /**
     * 
     * This function is used to set the total number of parking slots
     */
    protected function setSlot($slot) {
        $this->totalSlots = $slot;
        $myfile = fopen(FILE_NAME, "w") or die("Unable to open file!");
        fclose($myfile);
        $this->writeFile($slot, "total_slot");
        $this->writeFile([], "parking_slot");
    }
    
    /**
     * 
     * This function is used to get the total number of parking slots
     */
    public function getSlot() {
        $total_slot = 0;
        $this->readFile();
        if (isset($this->fileContent->total_slot)) {
            $total_slot = $this->fileContent->total_slot;
        }
        return $total_slot;
    }

    /**
     * 
     * This function is used to set the car details in session
     */
    protected function setCar($color, $number, $slot) {
        $this->car["color"] = $color;
        $this->car["number"] = $number;
        $this->car["slot"] = $slot;
        $this->car["id"] = $this->randomStrings(5);
        $parkSlots = isset($this->fileContent->parking_slot) ? $this->fileContent->parking_slot : [];
        array_push($parkSlots, $this->car);
        $this->readFile();
        if (isset($this->fileContent->total_slot)) {
            $total_slot = $this->fileContent->total_slot;
            $this->writeFile($total_slot, "total_slot");
        }
        $this->writeFile($parkSlots, "parking_slot");
    }

    /**
     * 
     * This function is used to get the car object
     */
    public function getCar() {
        return $this->car;
    }

    /**
     * 
     * This function is used to generate the random alphanumeric string
     */
    function randomStrings($length_of_string) {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }
}
?>
