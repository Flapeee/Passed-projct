function switchNavigationBar(NavigationBar) {
    var frozenFood = document.getElementById('FrozenFood');
    var tips = document.getElementsByClassName('selectTips');
    var navigationBarList = document.querySelector("#navigationBar").querySelectorAll("div");
    var freshFood = document.getElementById('FreshFood');
    var beverages = document.getElementById('Beverages');
    var homeHealth = document.getElementById('HomeHealth');
    var petFood = document.getElementById('PetFood');
    navigationBarList[0].setAttribute("style", "background-color: #E1BEE7;");
    navigationBarList[1].setAttribute("style", "background-color: #E1BEE7;");
    navigationBarList[2].setAttribute("style", "background-color: #E1BEE7;");
    navigationBarList[3].setAttribute("style", "background-color: #E1BEE7;");
    navigationBarList[4].setAttribute("style", "background-color: #E1BEE7;");
    frozenFood.setAttribute("style", "display: none;");
    freshFood.setAttribute("style", "display: none;");
    beverages.setAttribute("style", "display: none;");
    homeHealth.setAttribute("style", "display: none;");
    petFood.setAttribute("style", "display: none;");
    if (NavigationBar === 'FrozenFood') {
        frozenFood.setAttribute("style", "display: flex;");
        navigationBarList[0].setAttribute("style", "background-color: #FCEBFF;");
    } else if (NavigationBar === 'FreshFood') {
        navigationBarList[1].setAttribute("style", "background-color: #FCEBFF;");
        freshFood.setAttribute("style", "display: flex;");
    } else if (NavigationBar === 'Beverages') {
        navigationBarList[2].setAttribute("style", "background-color: #FCEBFF;");
        beverages.setAttribute("style", "display: flex;");
    } else if (NavigationBar === 'HomeHealth') {
        navigationBarList[3].setAttribute("style", "background-color: #FCEBFF;");
        homeHealth.setAttribute("style", "display: flex;");
    } else if (NavigationBar === 'PetFood') {
        navigationBarList[4].setAttribute("style", "background-color: #FCEBFF;");
        petFood.setAttribute("style", "display: flex;");
    }
    tips[0].setAttribute("style", "display: none;");
}

function getProductDetail(productId) {
    productDetailIframe = document.querySelector("#productDetailIframe");
    productDetailIframe.src = "components/productDetail.php?id=" + productId+"&checkout=-1";
}