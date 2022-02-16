console.log(document.cookie);
class CurrencyConverter {
    _currencyfactor = 0.0;
    currency = "";
    constructor() {
        this.currency = this.getCurrencyFromCookie();
        //this.getPrices();
    }
    getCurrencyFromCookie() {
        return document.cookie
            .split('; ')
            .find(row => row.startsWith('currency='))
            .split('=')[1];
    }
    getCurrency() {
        return this.currency;
    }
    async getPrices() {
        console.log("before->this._currencyfactor: " + this._currencyfactor);
        if (this._currencyfactor == 0.0) {
            let response = await fetch("../data/currencies.json");
            let currencyTable = (await response.json()).data;
            this._currencyfactor = currencyTable[this.currency];
        }
        console.log("after->this._currencyfactor: " + this._currencyfactor);
        return this._currencyfactor;
    }
    getFactor() {
        return this._currencyfactor;
    }
}
export let cc = new CurrencyConverter();
let currencysymbols = { "USD": "$", "EUR": "€", "GBP": "£", "RUB": "₽", "CNY": "¥" };
export function convert() {
    let priceHtml = document.getElementsByClassName("price");
    for (let i = 0; i < priceHtml.length; i++) {
        let currentprice = parseFloat(priceHtml.item(i).children[0].innerHTML);
        let newprice = (Math.round((currentprice * cc.getFactor()) * 100) / 100).toFixed(2);
        priceHtml.item(i).children[0].innerHTML = newprice;
        priceHtml.item(i).children[1].innerHTML = currencysymbols[cc.getCurrency()];
    }
}
