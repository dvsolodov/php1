window.onload = function () {

    document.addEventListener("change", function (event) {

        let select = event.target;
        let indexSelected = select.selectedIndex; 
        let options = select.querySelectorAll('option');
        let option = options[indexSelected];
        let statusId = option.dataset.statusId;
        let orderId = option.dataset.orderId;
        
        (async () => {
            const response = await fetch('/admin/order/status/update', {
                method: 'POST',
                headers: new Headers({
                    'Content-Type': 'application/json'
                }),
                body: JSON.stringify({
                    statusId: statusId,
                    orderId: orderId
                }),
            });
            const answer = await response.json();

            if (answer['status'] == 'ok') {
                options.forEach(function (item, i, options) {
                    item.removeAttribute('selected');
                });

                option.setAttribute('selected', 'selected');
            } else {
                let p = document.createElement("p");
                p.innerHTML = 'Что-то пошло не так'; 
                
                parentElem.before(p);

                setTimeout(function () {
                   p.remove();
                }, 2000)
            }
        })();
    });
}


