function cartValueTypeConversion() {
    var cartNumObj = document.getElementById("cartNum");
    var cartNum = cartNumObj.value;
    var reg = /^[0-9]+.?[0-9]*$/;
    if (reg.test(cartNum)) {
        return parseInt(cartNum);
    }
    return false;
}

function cartBackValueTypeConversion() {
    var cartNumBackObj = document.getElementById("cartNumBack");
    var cartNumBack = cartNumBackObj.value;
    var reg = /^[0-9]+.?[0-9]*$/;
    if (reg.test(cartNumBack)) {
        return parseInt(cartNumBack);
    }
    return false;
}

function stockValueTypeConversion() {
    var nowStockObj = document.getElementById("nowStock");
    var nowStock = nowStockObj.innerHTML;
    var reg = /^[0-9]+.?[0-9]*$/;
    if (reg.test(nowStock)) {
        return parseInt(nowStock);
    }
    return false;
}

function addNum() {
    var cartValue = cartValueTypeConversion();
    var stockValue = stockValueTypeConversion();
    if (cartValue || cartValue === 0) {
        if (cartValue < stockValue) {
            document.getElementById("cartNumBack").value = (cartValue).toString();
            document.getElementById("cartNum").value = (cartValue + 1).toString();
            document.getElementById("nowStock").innerHTML = (stockValue - 1).toString();
        } else {
            alert('The value you entered exceeds the inventory, please re-enter');
            parent.document.querySelector("#productDetailIframe").contentWindow.location.reload();
        }
    } else {
        alert('The value in the input box is abnormal, please re-enter');
        parent.document.querySelector("#productDetailIframe").contentWindow.location.reload();
    }
}

function subNum() {
    var cartValue = cartValueTypeConversion();
    var stockValue = stockValueTypeConversion();
    if (cartValue > 0) {
        document.getElementById("cartNumBack").value = (cartValue).toString();
        document.getElementById("cartNum").value = (cartValue - 1).toString();
        document.getElementById("nowStock").innerHTML = (stockValue + 1).toString();
    }
}

function checkStock() {
    var cartValue = cartValueTypeConversion();
    var stockValue = stockValueTypeConversion();
    var cartNumBackValue = cartBackValueTypeConversion();
    if (cartValue || cartValue === 0) {
        if (cartValue <= stockValue + cartNumBackValue) {
            document.getElementById("nowStock").innerHTML = (stockValue + cartNumBackValue - cartValue).toString();
            document.getElementById("cartNumBack").value = (cartValue).toString();
        } else {
            alert('The value you entered exceeds the inventory, please re-enter');
            parent.document.querySelector("#productDetailIframe").contentWindow.location.reload();
        }
    } else {
        alert('The value in the input box is abnormal, please re-enter');
        parent.document.querySelector("#productDetailIframe").contentWindow.location.reload();
    }
}

function addToShoppingCart(productId) {
    var cartValue = cartValueTypeConversion();
    var stockValue = stockValueTypeConversion();
    var cartNumBackValue = cartBackValueTypeConversion();
    if (cartValue <= stockValue + cartNumBackValue && cartValue !== 0) {
        shoppingCartIframe = parent.document.querySelector("#shoppingCart");
        shoppingCartIframe.src = "components/shoppingCart.php?id=" + productId + "&num=" + cartValue + "&remove=0&checkout=0";
        parent.document.querySelector("#productDetailIframe").contentWindow.location.reload();
    } else {
        alert('The value in the input box is abnormal, please re-enter');
        parent.document.querySelector("#productDetailIframe").contentWindow.location.reload();
    }
}