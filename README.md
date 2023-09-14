# pizza_shop
Website and App to run a pizza shop.
In order to make it work you have to configure some things: <br/><br/><br/>
<b>CONFIGURATION FOR WEBSITE:</b>
1. First you need 2 databases, one is supposed to be online and one local (in my case I used Xampp). By the way, in the folder database I put a database with some data, so basically import that one.
2. On "website/reciclado/connect_database.php" configure the online one.
3. When a customer makes an online order, they receive a confirmation so you have to set up the details for PHPMAILER into
   "RO/manipulador/send_order.php" and "EN/manipulador/send_order.php". <br/><br/><br/>
   <b>CONFIGURATION FOR APP:</b>
1. On "app/reciclado/conectar_base_datos.php" use your localhost database and on "app/reciclado/conectar_base_datos_online.php" use your online database.
2. On "app/kitchen.php" on line 166 you have the printers you want to send the kitchen's ticket. I am using 3 thermal printers, you can use your default printer if you want.
3. On "app/delete_order.php" you have the same printers so make sure you change that too.
