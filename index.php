<?php


$host='locaLhost';
$username='root';
$password='';
$dbname='momen';
$connt = mysqli_connect($host,$username,$password,$dbname);
if(!$connt){
echo"error";
}
