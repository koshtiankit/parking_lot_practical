<?php
define("ACTION", $argv[1]);
include_once('class.corephp.php');
$corephp = corephp::getInstance();

switch (ACTION) {
    case 'create_parking_lot':
        $total_slot = $argv[2];
        $corephp->setTotalSlot($total_slot);
        echo "Parking lot created for " . $corephp->getTotalParkingLot() . " vehicles";
    break;
    
    case 'park_vehicle':
        $carNumber = $argv[2];
        $carColor = $argv[3];
        $total_parking_lot = $corephp->getTotalParkingLot();
        $getParkedSlots = $corephp->getParkedSlots();
        if (count($getParkedSlots) < $total_parking_lot) {
            $isAvailable = $corephp->isCarParked($carNumber);
            if ($isAvailable > 0) {
                echo "Car already parked";
            } else {
                $setSlot = $corephp->getAvailableSlots();
                $isSlotFree = $corephp->isFreeSlot($setSlot[0]);
                if ($isSlotFree === 0) {
                    $corephp->setCarDetail($carColor, $carNumber, $setSlot[0]);
                    echo "Allocated slot number " . $setSlot[0];
                } else {
                    echo "Slot is not free";
                }
            }
        } else {
            echo "Sorry, parking lot is full";
        }
    break;

    case 'free_slot':
        $slot_to_free = $argv[2];
        $getIndex = $corephp->getCarIndex($slot_to_free, "slot");
        if ($getIndex == -1) {
            echo "Slot number " . $slot_to_free . " is already free";
        } else {
            if ($corephp->freeParkingSlot($getIndex)) {
                echo "Slot number " . $slot_to_free . " is free";
            } else {
                echo "Please try after some time....";
            }
        }
    break;

    case 'show_status':
        $getIndex = $corephp->getStatus();
    break;

    case 'search_reg_color':
        $carColor = $argv[2];
        $searchResult = $corephp->getSearchData("number", "color", $carColor);
        echo $searchResult;
    break;

    case 'search_slot_color':
        $carColor = $argv[2];
        $searchResult = $corephp->getSearchData("slot", "color", $carColor);
        echo $searchResult;
    break;

    case 'search_slot_reg':
        $carNumber = $argv[2];
        $searchResult = $corephp->getSearchData("slot", "number", $carNumber);
        echo $searchResult;
    break;

    case 'destroy_session':
        $getIndex = $corephp->destroySession();
    break;

    default:
        $getIndex = $corephp->getStatus();
    break;
}
?>
