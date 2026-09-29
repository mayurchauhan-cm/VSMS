<?php

include("config.php");

$id = $_GET['id'];

// Delete bookings of this customer
mysqli_query($conn, "DELETE FROM bookings WHERE customer_id='$id'");

// Delete vehicles of this customer
mysqli_query($conn, "DELETE FROM vehicles WHERE customer_id='$id'");

// Delete customer
if(mysqli_query($conn, "DELETE FROM customers WHERE customer_id='$id'"))
{
    echo "<script>
            alert('Customer Deleted Successfully');
            window.location='view_customers.php';
          </script>";
}
else
{
    echo mysqli_error($conn);
}

?>