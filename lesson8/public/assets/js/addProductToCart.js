window.onload = function () {

    document.addEventListener("click", function (event) {

        let elem = event.target;
        let parentElem = elem.parentElement;
        
        if (elem.hasAttribute('data-prod-id')) {
            let productId = elem.dataset.prodId;

            (async () => {
                const response = await fetch('/cart/products/add', {
                    method: 'POST',
                    headers: new Headers({
                        'Content-Type': 'application/json'
                    }),
                    body: JSON.stringify({
                        productId: productId,
                    }),
                });
                const answer = await response.json();
                let count = document.getElementById('count');
                count.innerHTML = answer['count'];
                let p = document.createElement("p");
                p.innerHTML = answer['buyMsg']; 
                
                parentElem.after(p);

                setTimeout(function () {
                   p.remove();
                }, 2000)
            })();
        }
    });
}
