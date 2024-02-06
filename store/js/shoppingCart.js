function back() {
    shoppingCartIframe = parent.document.querySelector("#shoppingCart");
    shoppingCartIframe.src = "components/shoppingCart.php?checkout=-2&id=0&num=0&remove=0";
    productDetailIframe = parent.document.querySelector("#productDetailIframe");
    productDetailIframe.src = "components/productDetail.php?id=0&checkout=-2";
}

function removeAll() {
    shoppingCartIframe = parent.document.querySelector("#shoppingCart");
    shoppingCartIframe.src = "components/shoppingCart.php?id=0&checkout=-1&num=0&remove=1";
}

function checkOut(cartsNum) {
    if (cartsNum > 0) {
        shoppingCartIframe = parent.document.querySelector("#shoppingCart");
        shoppingCartIframe.src = "components/shoppingCart.php?checkout=1&id=0&num=0&remove=0";
        productDetailIframe = parent.document.querySelector("#productDetailIframe");
        productDetailIframe.src = "components/productDetail.php?id=0&checkout=1";
    } else {
        alert('Shopping cart no have product, Please add.');
    }
}

function checkInfo() {
    var name = document.getElementById('name').value;
    var country = document.getElementById('country').value;
    var state = document.getElementById('state').value;
    var suburbs = document.getElementById('suburbs').value;
    var address = document.getElementById('address').value;
    var email = document.getElementById('email').value;
    var emptyInfo = '';
    var emptyNum = 0;
    if (name == '') {
        emptyNum += 1;
        emptyInfo += 'Name,';
    }
    if (country == '') {
        emptyNum += 1;
        emptyInfo += 'Country,';
    }
    if (state == '') {
        emptyNum += 1;
        emptyInfo += 'State,';
    }
    if (suburbs == '') {
        emptyNum += 1;
        emptyInfo += 'Suburbs,';
    }
    if (address == '') {
        emptyNum += 1;
        emptyInfo += 'Address,';
    }
    if (email == '') {
        emptyNum += 1;
        emptyInfo += 'Email,';
    }
    if (emptyNum > 0) {
        emptyInfo += "can`t be empty."
        alert(emptyInfo);
        return false;
    }
    if (email.search(/^[a-z0-9A-Z]+[- | a-z0-9A-Z . _]+@+[a-z0-9A-Z]+.+[a-zA-Z]$/) == -1) {
        alert("Email format is incorrect, please re-enter");
        return false;
    }
}