let attributenames = getAllAttributeNames();

setPriceToHTML(calculatePrice());
setSelectedItemToHTML(attributenames);

attributenames.forEach(function (attributeName){
    let radiobuttons = document.querySelectorAll('input[name="radio'+attributeName+'"]');
    radiobuttons.forEach(function (radio: HTMLInputElement)
    {
        radio.addEventListener("change", function ()
        {
            setPriceToHTML(calculatePrice()); //Update the prices
            setSelectedItemToHTML(attributenames);
        })
    })
})

function setSelectedItemToHTML(attributenames){
    attributenames.forEach(function (attributeName){ //update the selected item in the "summary"
        let currentSelected = document.getElementById("currentSelected"+attributeName);
        currentSelected.innerHTML = getSelectedName("radio"+attributeName);
    })
}

function setPriceToHTML(price: number){
    let priceelem: HTMLElement = document.getElementById("currentPrice")
    let priceformatted: string = (Math.round(price * 100) / 100).toFixed(2) + "€";
    priceelem.innerHTML = priceformatted;
}

function calculatePrice(){
    let attributes = getAllAttributeNames();

    let attributescleaned = attributes.filter(function (elem){
        return elem != "Versand" && elem != "Auflage";
    });

    let priceForOneItem = 0;
    let fixedPrice      = 0;

    attributescleaned.forEach(attribute =>
        priceForOneItem += getSelectedPrice("radio"+attribute)
    );

    fixedPrice = getSelectedPrice("radioVersand") + getSelectedPrice("radioAuflage");

    return (priceForOneItem * getItemCount() + fixedPrice);
}

function getItemCount()
{
    let radios: NodeListOf<HTMLElement> = document.getElementsByName("radioAuflage");
    let value = 0;
    radios.forEach(function (radio: HTMLInputElement){
        if (radio.checked) {
            value = Number(radio.labels[0].innerHTML);
        }
    })
    return value;
}

function getAllAttributeNames()
{
    let elements: HTMLCollectionOf<Element> = document.getElementsByClassName("configPoint");
    let attributes: Array<string> = [];

    for(let i = 0; i < elements.length; i++){
        attributes.push(elements[i].id);
    }
    return attributes;
}

function getSelectedPrice(itemName: string): number
{
    let radios: NodeListOf<HTMLElement> = document.getElementsByName(itemName);
    let value = 0;
    radios.forEach(function (radio: HTMLInputElement){
        if (radio.checked) {
            value = Number(radio.value);
        }
    })
    return value;
}

function getSelectedName(itemName: string): string
{
    let radios: NodeListOf<HTMLElement> = document.getElementsByName(itemName);
    let value = "0";
    radios.forEach(function (radio: HTMLInputElement){
        if (radio.checked) {
            value = radio.labels[0].innerHTML;
            //radio.labels[0].innerHTML
        }
    })
    return value;
}