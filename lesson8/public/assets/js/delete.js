window.onload = function () {

    document.addEventListener("click", function (event) {

        let elem = event.target;
        
        if (elem.hasAttribute('data-action-delete')) {
            let productId = elem.dataset.prodId;
            let delElem = document.querySelector('[data-prod-id="' + productId + '"]');

            (async () => {
                const response = await fetch('/cart/products/delete', {
                    method: 'POST',
                    headers: new Headers({
                        'Content-Type': 'application/json'
                    }),
                    body: JSON.stringify({
                        action: 'delete',
                        productId: productId,
                    }),
                });
                const answer = await response.json();

                if (answer['status'] == 'ok') {
                    let tr = document.getElementsByTagName('tr').length;

                    if (tr == 3) {
                        let div = document.querySelector('div').remove();
                        let p = document.createElement("p");
                        p.innerHTML = 'Корзина пуста'; 
                        document.body.append(p);
                    } else {
                        delElem.remove();
                        totalPriceForProd();
                        totalPriceForCart();
                    }
                } else if (answer['status'] == 'all') {
                    let div = document.querySelector('div').remove();
                    let p = document.createElement("p");
                    p.innerHTML = 'Корзина пуста'; 
                    document.body.append(p);
                }

                let count = document.getElementById('count');
                count.innerHTML = answer['count'];
                
            })();
        }
    });
}


