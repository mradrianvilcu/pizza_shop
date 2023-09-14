# pizza_shop
Website and App to run a pizza shop.
In order to make it work you have to configure some things:
<b>CONFIGURATION FOR WEBSITE</b>
1. First you need 2 databases, one is supposed to be online and one local (in my case I used Xampp). By the way in the folder database I put a database with some data, so basically import that one.
2. On "website/reciclado/connect_database.php" configure the online one.
3. When a customer makes an online order, they receive a confirmation so you have to set up the details for PHPMAILER into
   "RO/manipulador/send_order.php" and "EN/manipulador/send_order.php". 
 
