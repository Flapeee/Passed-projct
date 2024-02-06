<?php
include_once 'connectMysql.php';
include_once 'data.php';
$productId =
$productId = $_GET['id'];
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

$sessionId = session_id();
$setTipsHidden = '';
$setproductDetailHidden = '';
$productDetailDivHidden = '';
$checkOutDivHidden = '';
if ($productId > 0) {
    $sql = "select * from products where product_id = $productId";
    $res = $conn->query($sql);
    $rowNum = mysqli_num_rows($res);
    if ($rowNum > 0) {
        while ($row = mysqli_fetch_array($res)) {
            $productDetail = $row;
        }
    }
    $cartSql = "select * from carts where product_id = $productId";
    $cartRes = $conn->query($cartSql);
    $cartRowNum = mysqli_num_rows($cartRes);
    $cartProductNum = 0;
    if ($cartRowNum > 0) {
        while ($cartRow = mysqli_fetch_array($cartRes)) {
            $cartProductNum += $cartRow['quantity'];
        }
    }
    $nowStock = $productDetail['in_stock'] - $cartProductNum;
    $setTipsHidden = 'hidden';
    $categoryNum = (int)($productId / 1000);
    $foodCategory = $imageMapSvgCategory[$categoryNum];
} else {
    $setproductDetailHidden = 'hidden';
}
if ($checkout == 1) {
    $_SESSION['checkout'] = 1;
    $cartsSql = "select p.product_name as productName, p.unit_price as productPrice, p.unit_quantity as productQuantity, c.quantity as cartsQuantity from carts c left join products p on c.product_id = p.product_id where c.session_id='$sessionId'";
    $cartsRes = $conn->query($cartsSql);
    $cartsNum = mysqli_num_rows($cartsRes);
    $productDetailDivHidden = 'hidden';
} else {
    $checkOutDivHidden = 'hidden';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/base.css"/>
    <link rel="stylesheet" href="../css/detail.css"/>
    <title></title>
</head>
<body style="background-color: #F0FFF0">
<div id="productDetailDiv" <?= $productDetailDivHidden; ?>>
    <div id="productDetailTips" class="productDetailTipsStyle" <?= $setTipsHidden; ?>>
        Please select a product.
    </div>
    <div id="productDetail" class="productDetail" <?= $setproductDetailHidden; ?>>
        <div class="urlLink">
            <ul>
                <li><a href="#">GROCERY STORE</a>&nbsp;&gt;</li>
                <li><a href="#"><?= $foodCategory; ?></a>&nbsp;&gt;</li>
                <li><a href="#"><?= $productDetail['product_name']; ?></a>&nbsp;&gt;</li>
                <li><a href="#"><?= $productDetail['unit_quantity']; ?></a></li>
            </ul>
        </div>
        <div class="goodsPic"></div>
        <div class="goodsDetail">
            <h2 style="margin-top: 5px"><?= $productDetail['product_name']; ?></h2>
            <p class="redTip">Join the shopping cart if you like</p>
            <div class="detailRed">
                <div class="priceCol">
                    <div class="priceTag">Price</div>
                    <div class="priceValue">$ <?= $productDetail['unit_price']; ?></div>
                </div>
                <div class="unitCol">
                    <div class="unitTag">Unit</div>
                    <div class="unitValue"><?= $productDetail['unit_quantity']; ?></div>
                </div>
                <div class="stockCol">
                    <div class="stockTag">Stock</div>
                    <div class="stockValue" id="nowStock"><?= $nowStock; ?></div>
                </div>
            </div>
            <div class="addShoping">
                <input type="text" id="cartNum" value="0" onblur="checkStock()"/>
                <input type="text" id="cartNumBack" value="0" hidden/>
                <div class="controlNum">
                    <div class="add" onclick="addNum()">+</div>
                    <div class="sub" onclick="subNum()">-</div>
                </div>
                <button class="addShopCart" onclick="addToShoppingCart('<?= $productDetail['product_id']; ?>')">Add To
                    Shopping Cart
                </button>
            </div>
        </div>
    </div>
</div>
<div id="checkOutInfo" class="checkOutStyle" <?= $checkOutDivHidden; ?>>
    <h3>Shoping Cart Product Info</h3>
    <table class="laoye-table" border="1" cellspacing="10" cellpadding="20">
        <tr>
            <th width="180px">Product Name</th>
            <th width="80px">Number</th>
            <th width="100px">Total</th>
        </tr>
        <?php
        $cartsTotal = 0;
        if($checkout > 0){
            while ($cartsRow = mysqli_fetch_array($cartsRes)) {
            $productName = $cartsRow['productName'];
            $productPrice = $cartsRow['productPrice'];
            $productQuantity = $cartsRow['productQuantity'];
            $cartsQuantity = $cartsRow['cartsQuantity'];
            $cartsTotal += $productPrice * $cartsQuantity;
            $tr = '<tr>
                        <td>' . $productName . '</td>
                        <td>' . $cartsQuantity . '</td>
                        <td>$ ' . $productPrice * $cartsQuantity . '</td>
                    </tr>';
            echo $tr;
        }
        }
        ?>
        <tr style="border: 1px">
            <td>Total</td>
            <td></td>
            <td>$ <?= $cartsTotal; ?></td>
        </tr>
    </table>
</div>
<script src="../js/productDetail.js"></script>
</body>
</html>