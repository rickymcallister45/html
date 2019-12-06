<?php
include_once "../../resources/store/config.php";
include_once '../../resources/store/functions.php';

  if(isset($_GET['add'])) {
    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']) . " ");
    confirm($query);
    
    while($row = fetch_array($query)) {
      if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {
        $_SESSION['product_' . $_GET['add']] +=1;
        redirect('./checkout.php');
      }else{
        set_message("We only have " . $row['product_quantity'] . " " . $row['product_limit_reached'] . " Available");
        redirect('./checkout.php');
      }
    }
  }
  
  if(isset($_GET['remove'])) {
    $_SESSION['product_' . $_GET['remove']] --;
    if($_SESSION['product_' . $_GET['remove']] < 1) {
      unset($_SESSION['item_total']);
      unset($_SESSION['item_quantity']);
      redirect('./checkout.php');
    }else{
      redirect('./checkout.php');
    }
  }
  
  if(isset($_GET['delete'])) {
    $_SESSION['product_' . $_GET['delete']] = '0';
    unset($_SESSION['item_total']);
    unset($_SESSION['item_quantity']);
    redirect('./checkout.php');
  }

function cart() {
  $totalPrice = 0;
  $item_quantity = 0;
  $paypal_item_name = 1;
  $paypal_item_number = 1;
  $paypal_ammount = 1;
  $paypal_quantity = 1;
  
  foreach($_SESSION as $name => $value) {
    if($value > 0) {
    if(substr($name, 0, 8) == "product_" ) {
      $length = strlen($name - 8);
      $id = substr($name, 8, $length);
      $query = query("SELECT * FROM products WHERE product_id =" . escape_string($id). "");
      confirm($query);
  
  while($row = fetch_array($query)) {
    $subTotal = $row['product_price'] * $value;
    $item_quantity += $value;
        
    echo "<tr>
          <td>{$row['product_title']}</td>
          <td>&#36;{$row['product_price']}</td>
          <td>{$value}</td>
          <td>{$subTotal}</td>
          <td>
              <a class='btn btn-warning' href='./cart.php?remove={$row['product_id']}'><span class='glyphicon glyphicon-minus'></span></a>
              <a class='btn btn-success' href='./cart.php?add={$row['product_id']}'><span class='glyphicon glyphicon-plus'></span></a>
              <a class='btn btn-danger'  href='./cart.php?delete={$row['product_id']}'><span class='glyphicon glyphicon-remove'></span></a>
          </td>
          <td></td>
          </tr>
          <input type='hidden' name='item_name_{$paypal_item_name}' value='{$row['product_title']}'>
          <input type='hidden' name='item_number_{$paypal_item_number}' value='{$row['product_id']}'>
          <input type='hidden' name='amount_{$paypal_ammount}' value='{$row['product_price']}'>
          <input type='hidden' name='quantity_{$paypal_quantity}' value='{$value}'>";
  
  $paypal_item_name++;
  $paypal_item_number++;
  $paypal_ammount++;
  $paypal_quantity++;
    
        }
      $_SESSION['item_total'] = $totalPrice += $subTotal;
      $_SESSION['item_quantity'] = $item_quantity;
      }
    }
  }
}

function show_paypal_button() {
  if(isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >= 1) {
    echo "<input type='image' name='upload'
            src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif'
            alt='PayPal - The safer, easier way to pay online'>";
  }
}
  
?>