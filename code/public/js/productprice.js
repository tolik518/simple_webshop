let attributes_quantity_name = "attributes_quantity";
let attributes_shipping_name = "attributes_shipping";
let attributenames = getAllAttributeNames();
setPriceToHTML(calculatePrice());
setSelectedItemToHTML(attributenames);
attributenames.forEach(function (attributeName) {
    let radiobuttons = document.querySelectorAll('input[name="radio' + attributeName + '"]');
    radiobuttons.forEach(function (radio) {
        radio.addEventListener("change", function () {
            setPriceToHTML(calculatePrice()); //Update the prices
            setSelectedItemToHTML(attributenames);
        });
    });
});
function setSelectedItemToHTML(attributenames) {
    attributenames.forEach(function (attributeName) {
        let currentSelected = document.getElementById("currentSelected" + attributeName);
        currentSelected.value = getSelectedName("radio" + attributeName);
    });
    attributenames.forEach(function (attributeName) {
        let currentSelected_clean = document.getElementById("currentSelected_clean" + attributeName);
        currentSelected_clean.value = getSelectedValue("radio" + attributeName);
    });
}
function setPriceToHTML(price) {
    let priceelem = document.getElementById("currentPrice");
    let priceformatted = (Math.round(price * 100) / 100).toFixed(2) + "€";
    priceelem.innerHTML = priceformatted;
}
function calculatePrice() {
    let attributes = getAllAttributeNames();
    let attributesclean = attributes.filter(function (elem) {
        return elem != attributes_shipping_name && elem != attributes_quantity_name;
    });
    let priceForOneItem = 0;
    let fixedPrice = 0;
    attributesclean.forEach(attribute => priceForOneItem += getSelectedPrice("radio" + attribute));
    fixedPrice = getSelectedPrice("radio" + attributes_shipping_name) + getSelectedPrice("radio" + attributes_quantity_name);
    return (priceForOneItem * getItemCount() + fixedPrice);
}
function getItemCount() {
    let radios = document.getElementsByName("radio" + attributes_quantity_name);
    let value = 0;
    radios.forEach(function (radio) {
        if (radio.checked) {
            value = Number(radio.labels[0].innerHTML);
        }
    });
    return value;
}
function getAllAttributeNames() {
    let elements = document.getElementsByClassName("configPoint");
    let attributes = [];
    for (let i = 0; i < elements.length; i++) {
        attributes.push(elements[i].id);
    }
    return attributes;
}
function getSelectedPrice(itemName) {
    let radios = document.getElementsByName(itemName);
    let value = 0;
    radios.forEach(function (radio) {
        if (radio.checked) {
            value = Number(radio.value);
        }
    });
    return value;
}
function getSelectedName(itemName) {
    let radios = document.getElementsByName(itemName);
    let name = "none";
    radios.forEach(function (radio) {
        if (radio.checked) {
            name = radio.labels[0].innerHTML;
        }
    });
    return name;
}
function getSelectedValue(itemName) {
    let radios = document.getElementsByName(itemName);
    let name = "none";
    radios.forEach(function (radio) {
        if (radio.checked) {
            name = radio.getAttribute("label");
        }
    });
    return name;
}
