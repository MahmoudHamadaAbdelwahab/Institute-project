<?php
require_once('../config.php');
require_once BL.'functions/db.php';

if(isset($_POST['reservation_id'])){
    $reservation_id = $_POST['reservation_id'];
    $query = "DELETE FROM reservation WHERE reservation_id = '$reservation_id'";
    if(mysqli_query($conn, $query)){
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
