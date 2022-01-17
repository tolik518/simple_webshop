var attributenames = getAllAttributeNames();
setPriceToHTML(calculatePrice());
setSelectedItemToHTML(attributenames);
attributenames.forEach(function (attributeName) {
    var radiobuttons = document.querySelectorAll('input[name="radio' + attributeName + '"]');
    radiobuttons.forEach(function (radio) {
        radio.addEventListener("change", function () {
            setPriceToHTML(calculatePrice()); //Update the prices
            setSelectedItemToHTML(attributenames);
        });
    });
});
function setSelectedItemToHTML(attributenames) {
    attributenames.forEach(function (attributeName) {
        var currentSelected = document.getElementById("currentSelected" + attributeName);
        currentSelected.innerHTML = getSelectedName("radio" + attributeName);
    });
}
function setPriceToHTML(price) {
    var priceelem = document.getElementById("currentPrice");
    var priceformatted = (Math.round(price * 100) / 100).toFixed(2) + "€";
    priceelem.innerHTML = priceformatted;
}
function calculatePrice() {
    var attributes = getAllAttributeNames();
    var attributescleaned = attributes.filter(function (elem) {
        return elem != "Versand" && elem != "Auflage";
    });
    var priceForOneItem = 0;
    var fixedPrice = 0;
    attributescleaned.forEach(function (attribute) {
        return priceForOneItem += getSelectedPrice("radio" + attribute);
    });
    fixedPrice = getSelectedPrice("radioVersand") + getSelectedPrice("radioAuflage");
    return (priceForOneItem * getItemCount() + fixedPrice);
}
function getItemCount() {
    var radios = document.getElementsByName("radioAuflage");
    var value = 0;
    radios.forEach(function (radio) {
        if (radio.checked) {
            value = Number(radio.labels[0].innerHTML);
        }
    });
    return value;
}
function getAllAttributeNames() {
    var elements = document.getElementsByClassName("configPoint");
    var attributes = [];
    for (var i = 0; i < elements.length; i++) {
        attributes.push(elements[i].id);
    }
    return attributes;
}
function getSelectedPrice(itemName) {
    var radios = document.getElementsByName(itemName);
    var value = 0;
    radios.forEach(function (radio) {
        if (radio.checked) {
            value = Number(radio.value);
        }
    });
    return value;
}
function getSelectedName(itemName) {
    var radios = document.getElementsByName(itemName);
    var value = "0";
    radios.forEach(function (radio) {
        if (radio.checked) {
            value = radio.labels[0].innerHTML;
            //radio.labels[0].innerHTML
        }
    });
    return value;
}
