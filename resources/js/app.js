import { makeid } from "./util";

// on click event for adding a product
var addProduct = document.getElementById('add_product');
if (addProduct != null) {
    addProduct.addEventListener('click', f);    
}

// settings-enableWebhook
let enableWebhooks = document.getElementById('settings-enableWebhook');
let targetWebhookSecret;
if (enableWebhooks != null) {
    targetWebhookSecret = document.getElementById('settings-webhookSecret-field');
    enableWebhooks.addEventListener('click', g);
}


function f(){
    console.log('hey, add another product dropdown')

    let prefix = 'product_select-field';
    // insert elemnts into products_added
    var productSelection = document.getElementById('product_select-field');
    const selection = productSelection.cloneNode(true);
    productSelection.after(selection);

    const id = makeid(7);

    selection.setAttribute('id', prefix + '-' + id);
    // remove the label - class="heading"

}


function g() {
    // check if the lightswitch is on
    const webhookEnabled = enableWebhooks.classList.contains('on');
    const shouldToggle = !webhookEnabled;
    targetWebhookSecret.classList.toggle('hidden', shouldToggle);
    return shouldToggle;
}

