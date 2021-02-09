function totalPriceForProd()
{
    let tdTotal = document.querySelectorAll('[data-total-for-prod]');

    tdTotal.forEach(function(entry) {
        let prodId = entry.dataset.totalForProd;
        let prodPrice = document.querySelector('[data-price="' + prodId + '"]').innerHTML;
        let prodQuantity = document.querySelector('[data-quantity="' + prodId + '"]').innerHTML;
        entry.innerHTML = prodPrice * prodQuantity;
    });
}

function totalPriceForCart()
{
    let tdTotal = document.querySelectorAll('[data-total-for-prod]');
    let tdTotalForCart = document.querySelector('[data-total-for-cart]');
    let totalPrice = 0;

    tdTotal.forEach(function(entry) {
        totalPrice += +entry.innerHTML;
    });

    if (totalPrice > 0) {
        tdTotalForCart.innerHTML = totalPrice;
    }
}

totalPriceForProd();
totalPriceForCart();
