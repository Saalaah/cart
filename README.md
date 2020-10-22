# Cart
REST API For Calculating the cart Products .<br />
In this project you will be able to.<br />
1- add products to the cart .<br />
2- add the currency .<br />

# Starting the Project

After cloning the project move it to htdocs folder (the localhost directory).<br />
Run Xampp to start apache (or any server client).<br />
Open Postman (or any client to send the API request from it). <br />
Type [http://localhost/cart/api/](http://localhost/cart/api/) and  Select POST rquest .<br />
Set the post request body to be a valid JSON like .<br />

{
    "currency":"usd",
    "products":["shoes","shoes","jacket","t-shirt"]
}
<br />
## About the project

1-The available currencies are EGP & USD (not case sensitve).<br />
2-You can add any currency (and its value according to 1 dollar) or Products at cart/models/Data.php.<br />
3-You can add discount to any Product at cart/models/Data.php.<br />

## How does it work ?
The API file (api/index.php) gets the User Input JSON from The API client(postman).<br />
The Objects that represents the Database is inside models/Data.php.<br />
The Cart Class (at models/Cart.php) have some functions : .<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  1-Validation Function: validates the input object .<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  2-SpecialOffers Function: handle the special offer (2 t-shirts-> jacket 50% discount).<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  3-Bill Function: Calculate the total price before and after Taxes and discounts AND BE Returned TO THE API FILE.<br />
The API file give the Cart Class the input and the DATA from the Data model then  gets the returned Object from the Bill function