<?php
session_start();
$customerid=$_SESSION['cust_id'];
$prodid=$_GET['prodid'];
$id=new MongoId("$prodid");
$m=new MongoClient();
$db=$m->clickfurnish;
$collection=$db->cart;
if($collection->update(array('_id'=>"$customerid"),array('$pull'=> array("purchased"=> array("prod_id"=>$id)))))
echo "success";
header("Location: cart_wishlist.php");
?>
