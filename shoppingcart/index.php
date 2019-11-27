<?php
require ('shoppingcart.php');
session_start();
// if session not set add shopping cart
if (!isset($_SESSION['shoppingcart']) or$_SESSION['shoppingcart']=='')  {
    $cart = new shoppingcart();
    $_SESSION['shoppingcart'] = $cart;
}
// clear session
if (isset($_GET['submit']) && ($_GET['submit'])=='Clear') {
    unset($_SESSION['shoppingcart']);
    unset($_GET);
}
// get item code add or remove items
 if (isset($_GET['item'])) {
     $details = explode(',',$_GET['item']);
      $code = $details[0];
      $quantity = $_GET['qty'];
      if (($quantity<intval(1)) || empty($quantity)) {
          $quantity = 1;
      }
     if (($_GET['submit'])=='Add') {
         unset($_GET);
         $name = $details[1];
         $description = $details[2];
         $price = $details[3];
         $_SESSION['shoppingcart']->set_item($code,$name,$description,$price,$quantity);
         unset($_GET);
     } else {
        $_SESSION['shoppingcart']->remove_items($code,$quantity);
        unset($_GET);
     }
 }?>
<html>
    <head>
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <select name="item">
        <option value="1,pen, red pen,6.00">Red Pen £6.00</option>
        <option value="2,pen, blue pen,7.00">Blue Pen £7.00 </option>
        <option value="3,pen, green pen,8.00">Green Pen £8.00</option>
        </select>
         Qty: <input name="qty" type="text" value="1">
        <input type="submit" name="submit" value="Add" />
        <input type="submit" name="submit" value="Delete" />
        <input type="submit" name="submit" value="Clear" />
        </form>

    </body>
        <table>
            <tr><th>Item Name</th><th>Item Description</th><th>Item Price</th><th>quantity</th></tr>
    <?php // display shopping cart items
    if (isset($_SESSION['shoppingcart']) && !empty($_SESSION['shoppingcart'])) {
            $productsincart = $_SESSION['shoppingcart']->get_items();
            if (!empty($productsincart)) {
                foreach ($productsincart as $product) {
                echo "<tr><td>".$product['product']->get_name()."</td><td>".$product['product']->get_description()."</td>".
                "<td>£".sprintf('%0.2f',$product['product']->get_price())."</td><td>".$product['quantity']."</td></tr>";
                }
            }
        }
    ?>
        </table>

</html>
