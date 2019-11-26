<?php
// HELPER FUNCTIONS

function redirect($location) {
  header('LocationL $location');
}

function query($sql) {
  global $connection;
  return mysqli_query($conncection, $sql);
}

function confirm($result) {
  global $connection;
  if(!$result) {
    die('Query Failed ' . mysqli_error($connection));
  }
}

function escape_string($string) {
  global $connection;
  return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result) {
  return mysqli_fetch_array($result);
}

// FRONTEND FUNCTIONS

function get_products() {
  $query = query('SELECT * FROM products');
  confirm($query);
  while($row = fetch_array($query)) {
    echo "<div class='col-sm-4 col-lg-4 col-md-4'>
            <div class='thumbnail'>
              <a href='./item.php?id={$row['product_id']}'><img src='{$row['product_image']}' alt='{$row['product_title']}'></a>
              <div class='caption'>
                <h4 class='pull-right'>&#36;{$row['product_price']}</h4>
                <h4><a href='#'>{$row['product_title']}</a></h4>
                <p>{$row['product_short_description']}</p>
                <a class='btn btn-primary' target='_blank' href='#'>Add to cart</a>
              </div>
            </div>  
          </div>";
  }
}


// BACKEND FUNCTIONS

?>
