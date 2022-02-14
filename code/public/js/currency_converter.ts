window.addEventListener('load', async function()
{
    let priceHtml = document.getElementsByClassName("price");
    let currencysymbols = {"USD":"$","EUR":"€","GBP": "£","RUB":"₽","CNY":"¥"};
    let currency: string = getCurrencyFromCookie();

    fetch("../data/currencies.json")
        .then(response => response.json())
        .then(json => json.data[currency])
        .then((conversionrate) => {
            for (let i = 0; i < priceHtml.length; i++) {
                let currentprice: number = parseFloat(priceHtml.item(i).children[0].innerHTML);
                console.log(currentprice);
                let newprice = (Math.round((currentprice*conversionrate) * 100) / 100).toFixed(2);
                priceHtml.item(i).children[0].innerHTML = newprice;
                priceHtml.item(i).children[1].innerHTML = currencysymbols[currency];
            }
        });
});

function getCurrencyFromCookie(): string
{
    return document.cookie
        .split('; ')
        .find(row => row.startsWith('currency='))
        .split('=')[1];
}