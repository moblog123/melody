<?php

session_start();
$con=mysqli_connect("localhost","root","","testdb");

if(mysqli_connect_error()){
    echo"<script>
    alert('not connected to database');
      window.location.href='mycart.php';
    </script>";
    exit();
}


if($_SERVER["REQUEST_METHOD"]=="POST")
{
 if(isset($_POST['purchase']))
 {
    $query1="INSERT INTO `order_manager`(`Full_Name`, `Phone_No`, `Address`, `Pay_Mode`) VALUES ('$_POST[fullname]','$_POST[phone_no]','$_POST[address]','$_POST[pay_mod]')";
    if(mysqli_query($con,$query1))
   {
    $Order_Id=mysqli_insert_id($con);
    $query2="INSERT INTO `user_orders`(`Order_id`, `Item_Name`, `Price`, `Quantity`) VALUES (?,?,?,?)";
    $stmt=mysqli_prepare($con,$query2);
    if($stmt)
    {
        mysqli_stmt_bind_param($stmt,"isii",$Order_Id,$Item_Name,$Price,$Quantity);
        foreach($_SESSION['cart']as $key => $values)
        {
            $Item_Name=$values['Item_Name'];
            $Price=$values['Price'];
            $Quantity=$values['Quantity'];
            mysqli_stmt_execute($stmt);
        }
        unset($_SESSION['cart']);
        echo"<script>
        alert('order placed');
        window.location.href='testitem.php';
        </script>";
    }

    else
    {
        echo"<script>
        alert('Sql prepared Error');
        window.location.href='mycart.php';
        </script>";
    }
}
      else
    {
       echo"<script>
         alert('Sql Error');
         window.location.href='mycart.php';
          </script>";
    }
 }
}

?>