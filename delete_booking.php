<?php

include("config.php");

$id = $_GET['id'];

$query = mysqli_query($conn, "DELETE FROM bookings WHERE booking_id='$id'");

if($query)
{
    header("Location: booking_list.php");
}
else
{
    echo "Error : " . mysqli_error($conn);
}

?>