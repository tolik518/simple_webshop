let attributes_quantity_name = "attributes_quantity";
let attributes_shipping_name = "attributes_shipping";

let attributenames: string[] = getAllAttributeNames();

setPriceToHTML(calculatePrice());
setSelectedItemToHTML(attributenames);


attributenames.forEach(function (attributeName: string)
{
    let radiobuttons = <NodeListOf<HTMLInputElement>> document.querySelectorAll('input[name="radio'+attributeName+'"]');
    radiobuttons.forEach(function (radio: HTMLInputElement)
    {
        radio.addEventListener("change", function ()
        {
            setPriceToHTML(calculatePrice()); //Update the prices
            setSelectedItemToHTML(attributenames);
        })
    })
})

function setSelectedItemToHTML(attributenames: string[])
{
    attributenames.forEach(function (attributeName){ //update the selected item in the "summary"
        let currentSelected = <HTMLInputElement>document.getElementById("currentSelected"+attributeName);
        currentSelected.value = getSelectedName("radio"+attributeName);
    })

    attributenames.forEach(function (attributeName){ //update the selected item in the "summary_clean (for db)"
        let currentSelected_clean = <HTMLInputElement>document.getElementById("currentSelected_clean"+attributeName);
        currentSelected_clean.value = getSelectedValue("radio"+attributeName);
    })
}

function setPriceToHTML(price: number)
{
    let priceelem: HTMLElement = document.getElementById("currentPrice")
    let priceformatted: string = (Math.round(price * 100) / 100).toFixed(2) + "€";
    priceelem.innerHTML = priceformatted;
}

function calculatePrice(): number
{
    let attributes: string[] = getAllAttributeNames();

    let attributesclean: string[] = attributes.filter(function (elem){
        return elem != attributes_shipping_name && elem != attributes_quantity_name;
    });

    let priceForOneItem: number = 0;
    let fixedPrice: number      = 0;

    attributesclean.forEach(attribute =>
        priceForOneItem += getSelectedPrice("radio"+attribute)
    );

    fixedPrice = getSelectedPrice("radio"+attributes_shipping_name) + getSelectedPrice("radio"+attributes_quantity_name);

    return (priceForOneItem * getItemCount() + fixedPrice);
}

function getItemCount(): number
{
    let radios = <NodeListOf<HTMLInputElement>> document.getElementsByName("radio"+attributes_quantity_name);
    let value: number = 0;
    radios.forEach(function (radio){
        if (radio.checked) {
            value = Number(radio.labels[0].innerHTML);
        }
    })
    return value;
}

function getAllAttributeNames(): string[]
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
    let radios = <NodeListOf<HTMLInputElement>> document.getElementsByName(itemName);
    let value: number = 0;
    radios.forEach(function (radio: HTMLInputElement){
        if (radio.checked) {
            value = Number(radio.value);
        }
    })
    return value;
}

function getSelectedName(itemName: string): string
{
    let radios = <NodeListOf<HTMLInputElement>> document.getElementsByName(itemName);
    let name: string = "none";
    radios.forEach(function (radio: HTMLInputElement){
        if (radio.checked) {
            name = radio.labels[0].innerHTML;
        }
    })
    return name;
}

function getSelectedValue(itemName: string): string
{
    let radios = <NodeListOf<HTMLInputElement>> document.getElementsByName(itemName);
    let name: string = "none";
    radios.forEach(function (radio: HTMLInputElement){
        if (radio.checked) {
            name = radio.getAttribute("label");
        }
    })
    return name;
}
