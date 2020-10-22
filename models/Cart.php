<?php 

class Cart{

    public $products_arr;
    public $currencies_arr;
    public $subtotal;                //The total Price before taxes and discounts 
    public $taxes;                   //The total taxes (%14)
    public $discount;               //The discount for each product in dollar
    public $total;                  //The final tota price
    public $discount_arr=array();   //Array of the Special offers
    public $bill_arr=array();       // The final bill


    public function __construct($products,$currencies){
        $this->products_arr=$products;
        $this->currencies_arr=$currencies;

    }

    // 2 t-shirts -> 1 jacket 50% offer CHECK
    public function specialOffers($inputs_arr){

        $indexes = array_keys($inputs_arr['products'], 't-shirt'); 
        $t_shirts_count=count($indexes); //how many shirts in the cart

        $no_jacket_offers='';

        if($t_shirts_count>=2 && in_array('jacket',$inputs_arr['products'])){
            $no_of_discounts=intdiv($t_shirts_count,2);

            //how many jackets in the cart
            $indexes2 = array_keys($inputs_arr['products'], 'jacket'); 
            $jackets_count=count($indexes2); 

            if($no_of_discounts>=$jackets_count){

                $no_jacket_offers=$jackets_count;
            }
            else {$no_jacket_offers=$no_of_discounts;}

            //pushing the jackets offers to the Discount array
            for($i=0;$i<$no_jacket_offers;$i++){
                $add_jacket_arr=array(
                    'product'=>'Jacket',
                    'discountPercentage'=>50,
                    'discount'=>9.99
                );

                array_push($this->discount_arr,$add_jacket_arr);
            }
        }



    }


    public function bill($inputs_arr){

        $this->subtotal=0;

        //fetching the inputs
        foreach($inputs_arr['products'] as $product){
            //validate the products input
            $product=$this->validation($product);
            //checking if the product entered exists
            if( isset($this->products_arr[$product])){
                $price=$this->products_arr[$product]['price'];
                $this->subtotal+=$price;

                // Discounts check
                if($this->products_arr[$product]['discountPr']!=''){

                    $this->discount=($this->products_arr[$product]['discountPr']/100)*$price;

                    //Pushing the discounted products to Discount array
                    $add_dis_arr=array(
                        'product'=>$product,
                        'discountPercentage'=>$this->products_arr[$product]['discountPr'],
                        'discount'=>$this->discount
                    );
                    array_push($this->discount_arr,$add_dis_arr);

                }


                //14% taxes
                $this->taxes=$this->subtotal*(14/100); 
                
                
                //---currency calculations-----
                
                //Validate the currency input
                $currency_chosen=$this->validation($inputs_arr['currency']);

                //checking if the currency entered exists

                if(isset($this->currencies_arr[$currency_chosen])){
                    $factor=$this->currencies_arr[$currency_chosen]['factor'];
                    $sign=$this->currencies_arr[$currency_chosen]['sign'];


                    //pushing the full bill elements to the final bill
                    $this->bill_arr['Subtotal']=$this->subtotal*$factor.$sign;
                    $this->bill_arr['Taxes']=$this->taxes*$factor.$sign;
                    $offers_arr=array();
                    $offers_sum=0;
                    foreach($this->discount_arr as $offer){

                        $off=$offer['discountPercentage']."% "."Off ". $offer['product']." -".$sign.$offer['discount']*$factor;
                        array_push($offers_arr,$off);
                        $offers_sum+=$offer['discount'];
                    }
                    $this->bill_arr['Discount']=$offers_arr;
                    $this->bill_arr['Total']=($this->subtotal-$offers_sum+$this->taxes)*$factor.$sign;
                }
                else {return "currency isn't specified";}
            }

            else {return $product." is not exist";}


        }

        return $this->bill_arr;
    }


    // validation function 
    public function validation($input){
        $input=strtolower($input);
        $input=htmlspecialchars($input);
        $input=stripslashes($input);
        $input=trim($input);
        return $input;}




}
?>