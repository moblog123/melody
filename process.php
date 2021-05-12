<?php
  if(isset($_POST['btn-submit']))

  {
      $name=$_POST['name'];
      $email=$_POST['email'];
      $subject=$_POST['subject'];
      $message=$_POST['message'];

      if(empty($name)||(empty($email)||(empty($subject)||(empty($message))
      {
       header("location:contactus.html?error");
      }
      else
      {
          $to="";

          if(mail($to,$subject,$email,$message))
          {
           header("location:contactus.html?success");
          }
      }
  }
  else
  {
      header("location:contactus.html");
  }

?>