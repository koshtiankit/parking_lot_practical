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
}
?>
