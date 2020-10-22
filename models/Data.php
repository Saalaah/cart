<?php 

class Data{



public function product(){
 $products_arr=array(
   "t-shirt"=>array("price"=>10.99,"discountPr"=>""),
   "pants"=>array("price"=>14.99,"discountPr"=>""),
   "jacket"=>array("price"=>19.99,"discountPr"=>""),
   "shoes"=>array("price"=>24.99,"discountPr"=>10)
);
return $products_arr;
}

public function currency(){

 $currencies_arr=[
"usd"=>["sign"=>"$","factor"=>1],
"egp"=>["sign"=>"e£","factor"=>15]
];
return $currencies_arr;
}

}