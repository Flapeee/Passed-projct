<?php
session_start();
require('connectMysql.php');
$sessionId = session_id();
$productId = $_GET['id'];
$remove = $_GET['remove'];
$checkout = $_GET['checkout'];
if (!$checkout) {
    $checkout = $_SESSION['checkout'];
}
if ($checkout == -1) {
    if($_SESSION['checkout']){
        $checkout = $_SESSION['checkout'];
    }
}
if ($checkout == -2) {
    $_SESSION['checkout'] = 0;
}
$num = $_GET['num'];
$setTipsHidden = '';
$shoppingCartPageHidden = '';
$setproductListHidden = '';
$checkOutDivHidden = '';
if ($remove == 1) {
    $deleteSql = "delete from carts where session_id='$sessionId'";
    $deleteRes = $conn->query($deleteSql);
}

if ($checkout == 1) {
    $shoppingCartPageHidden = 'hidden';
} else {
    $checkOutDivHidden = 'hidden';
}

if ($productId > 0 && $num > 0) {
    $querySql = "select * from carts where session_id='$sessionId' and product_id =$productId";
    $queryRes = $conn->query($querySql);
    $queryNum = mysqli_num_rows($queryRes);
    if ($queryNum) {
        $updateSql = "update carts set quantity = quantity+$num where session_id='$sessionId' and product_id =$productId";
        $updateRes = $conn->query($updateSql);
    } else {
        $insertSql = "insert into carts (`session_id`, `product_id`, `quantity`) VALUES ('$sessionId',  $productId, $num)";
        $insertRes = $conn->query($insertSql);
    }
}
$cartsSql = "select p.product_name as productName, p.unit_price as productPrice, p.unit_quantity as productQuantity, c.quantity as cartsQuantity from carts c left join products p on c.product_id = p.product_id where c.session_id='$sessionId'";
$cartsRes = $conn->query($cartsSql);
$cartsNum = mysqli_num_rows($cartsRes);
if ($cartsNum > 0) {
    $setTipsHidden = 'hidden';
} else {
    $setproductListHidden = 'hidden';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/base.css"/>
    <link rel="stylesheet" href="../css/shopingCart.css"/>
    <title></title>
</head>
<body style="background-color: #F0FFF0">
<div id="shoppingCartPage" <?= $shoppingCartPageHidden; ?>>
    <div class="shoppingCart">
        <div class="noProducts" <?= $setTipsHidden; ?>>
            Please add a product.
        </div>
        <div class="productListInCart" <?= $setproductListHidden; ?>>
            <?php
            $cartsTotal = 0;
            while ($cartsRow = mysqli_fetch_array($cartsRes)) {
                $productName = $cartsRow['productName'];
                $productPrice = $cartsRow['productPrice'];
                $productQuantity = $cartsRow['productQuantity'];
                $cartsQuantity = $cartsRow['cartsQuantity'];
                $cartsTotal += $productPrice * $cartsQuantity;
                $cartsDiv = '<div class="product">
                            <div class="productInfo">' . $productName . '&nbsp;&nbsp;(' . $productQuantity . ') &nbsp;&nbsp;*&nbsp;&nbsp; ' . $cartsQuantity . '</div>
                            <div class="productTotal">$ ' . $productPrice * $cartsQuantity . '</div>
                        </div>';
                echo $cartsDiv;
            }
            ?>
        </div>
    </div>
    <div class="operationShoppingCart">
        <div class="operationTotal">Total: $ <?= $cartsTotal; ?> </div>
        <button class="operationRemoveAll" onclick="removeAll()">Remove All</button>
        <button class="operationCheckOut" onclick="checkOut(<?= $cartsNum; ?>)">Check out</button>
    </div>
</div>
<div id="checkOutPage" <?= $checkOutDivHidden; ?>>
    <div class="back">
        <button onclick="back()">Back Shopping carts</button>
    </div>
    <div class="form">
        <form action="submitInfo.php" method="post" onSubmit="return checkInfo();">
            <div class="inputLine">
                <div class="label"><label for="name">Name *</label></div>
                <input name="name" id="name" type="text"/></div>
            <div class="inputLine">
                <div class="label"><label for="country">Country *</label></div>
                <input name="country" id="country" type="text"/>
            </div>
            <div class="inputLine">
                <div class="label"><label for="state">State *</label></div>
                <input name="state" id="state" type="text"/>
            </div>
            <div class="inputLine">
                <div class="label"><label for="suburbs">Suburbs *</label></div>
                <input name="suburbs" id="suburbs" type="text"/>
            </div>
            <div class="inputLine">
                <div class="label"><label for="address">Address *</label></div>
                <input name="address" id="address" type="text"/>
            </div>
            <div class="inputLine">
                <div class="label"><label for="email">Email *</label></div>
                <input name="email" id="email" type="email"/>
            </div>
            <div class="submit">
                <input id="submit" type="submit" name="submit" value="Buy"/>
            </div>
        </form>
    </div>
</div>
<script src="../js/shoppingCart.js"></script>
</body>
</html>


