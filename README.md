# Cart
REST API For Calculating the cart Products .<br />
1In this project you will be able to.<br />
1- add products to the cart .<br />
2- add the currency .<br />

# Starting the Project

After cloning the project move it to htdocs folder (the localhost directory).<br />
Run Xampp to start apache (or any server client).<br />
Open Postman (or any client to send the API request from it). <br />
Type [http://localhost/cart/api/](http://localhost/cart/api/) and  Select POST rquest .<br />
Set the post request body to be a valid JSON body like .<br />

{
    "currency":"usd",
    "products":["shoes","shoes","jacket","t-shirt"]
}
