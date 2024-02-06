<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grocery Store</title>
    <link rel="stylesheet" href="./css/index.css">
   
</head>
<body class="bodyStyle">
<div class="productListStyle">
    <h1 class="h1Style">GROCERY STORE</h1>
    <div id="navigationBar" class="navigationStyle">
        <div onmouseover="switchNavigationBar('FrozenFood')">Frozen-Food</div>
        <div onmouseover="switchNavigationBar('FreshFood')">Fresh-Food</div>
        <div onmouseover="switchNavigationBar('Beverages')">Beverages</div>
        <div onmouseover="switchNavigationBar('HomeHealth')">Home-Health</div>
        <div onmouseover="switchNavigationBar('PetFood')">Pet-Food</div>
    </div>
    <div class="imageMapStyle">
        <div class="showImageMap">
            <?php
            include 'components/createProductImageMap.php';
            ?>
        </div>
        <div class="selectTips">
            Please select the food type.
        </div>
    </div>
</div>
<div class="paymentOperationStyle">
    <div class="productDetailStyle">
        <iframe id="productDetailIframe" src="components/productDetail.php?id=0&checkout=-1" width="100%" height="100%"
                frameborder="0"></iframe>
    </div>
    <div class="shoppingStyle">
        <iframe id="shoppingCart" src="components/shoppingCart.php?id=0&num=0&checkout=-1&remove=0" width="100%"
                height="100%" frameborder="0"></iframe>
    </div>
</div>
</body>
<script src="js/index.js"></script>
</html>