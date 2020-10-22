<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
include_once '../models/Cart.php';
include_once '../models/Data.php';
//getting the input from the user
$data=json_decode(file_get_contents("php://input"));
$objectToArray = (array)$data;      //converitng the Object to Array
//getting the data from the Data Class
$products_data=new Data();                                          
$products_table=$products_data->product();                                                                 
$currencies_table=$products_data->currency();                                                                                                                           
//Passing the data to the constructor function
$cart=new Cart($products_table,$currencies_table);
$cart->specialOffers($objectToArray);

$bill=$cart->bill($objectToArray);

echo json_encode($bill);
