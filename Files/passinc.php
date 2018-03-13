<?php
session_start();
$m=new MongoClient();
$db=$m->clickfurnish;
$collection=$db->cart;

$prod_id=$_SESSION['prod_id'];

$collection=update(array(),('$push'=>array()));
