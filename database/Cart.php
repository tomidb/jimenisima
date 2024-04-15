<?php

// php cart class
class Cart
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }


    // to insert into cart table
    public  function addToCart($userid, $itemid, $itemname, $itemimage, $itemprice){
        if (isset($userid) && isset($itemid)){
              $insert_query = "INSERT INTO cart (user_id, item_id, item_name, item_image, item_price) VALUES ('$userid', '$itemid', '$itemname', '$itemimage', '$itemprice')";
              $insert_query_run = $this->db->con->query($insert_query);
                header("Location: " . $_SERVER['PHP_SELF']);
            }
        }
    
    //  update cart item qty
    public function UpdateCartQuantity($itemid, $userid, $qty) {
    if ($itemid != null && $qty != null && $userid != null) {
        $query = "UPDATE cart SET qty = $qty WHERE item_id = $itemid AND user_id = $userid";
        $result = $this->db->con->query($query);
        return $result;
    }
}

// get cart item qty

public function getCartItemQty($itemid, $userid){
   if ($itemid != null && $userid != null)
        $query = "SELECT qty FROM cart WHERE item_id = $itemid AND user_id = $userid";
        $result = $this->db->con->query($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc(); // Obtenemos el primer resultado como un array asociativo
            return $row['qty']; // Devolvemos el valor de la cantidad
        } else {
            return 0; // Si no hay resultados, devolvemos 0
        }
}

    // delete cart item using cart item id
    public function deleteCart($item_id = null, $table = 'cart'){
        if($item_id != null){
            $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$item_id}");
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    // get items from cart table with user_id
    public function getUserCartItems($user_id)
    {
        $query = "SELECT * FROM cart WHERE user_id = $user_id";
        $result = $this->db->con->query($query);

        $userCartItems = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $userCartItems[] = $row;
            }
        }

        return $userCartItems;
    }

    // calculate sub total
    public function getSum($arr){
        if(isset($arr)){
            $sum = 0;
            foreach ($arr as $item){
                $sum += floatval($item[0]);
            }
            return sprintf('%.2f' , $sum);
        }
    }

    // get item_iD of shopping cart list
    public function getCartId($cartArray = null, $key = "item_id"){
        if ($cartArray != null){
            $cart_id = array_map(function ($value) use($key){
                return $value[$key];
            }, $cartArray);
            return $cart_id;
        }
    }

    // Save for later
    public function saveForLater($item_id = null, $saveTable = "wishlist", $fromTable = "cart"){
        if ($item_id != null){
            $query = "INSERT INTO {$saveTable} SELECT * FROM {$fromTable} WHERE item_id={$item_id};";
            $query .= "DELETE FROM {$fromTable} WHERE item_id={$item_id};";

            // execute multiple query
            $result = $this->db->con->multi_query($query);

            if($result){
                header("Location :" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }


}