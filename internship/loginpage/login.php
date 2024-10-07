<?php
if(!isset($_POST['submit']))
{
     $username=$_POST['username'];
     $password=$_POST['password'];

     $con=mysqli_connect("localhost","root","","loginpage");

     $sql="SELECT * from login WHERE username='$username' AND 
     password='$password' ";

     $result=mysqli_query($con,$sql);
     
     $resultcheck=mysqli_num_rows($result);

     if($resultcheck>0)
     {
     echo"<h3>Login Succesfully</h3>";
     }
     else
     {
     echo"<h3>Username or Password Incorrect</h3>";
     }
     
}
?>