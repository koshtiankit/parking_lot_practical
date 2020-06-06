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
    
    case 'destroy_session':
        $getIndex = $corephp->destroySession();
    break;

    default:
        $getIndex = $corephp->getStatus();
    break;
}
?>
