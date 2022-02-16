console.log(document.cookie);

class CurrencyConverter
{
    private _currencyfactor = 0.0;
    public currency: string = "";

    constructor()
    {
        this.currency = this.getCurrencyFromCookie();
        //this.getPrices();
    }

    private getCurrencyFromCookie(): string
    {

        return document.cookie
            .split('; ')
            .find(row => row.startsWith('currency='))
            .split('=')[1];
    }

    public getCurrency()
    {
        return this.currency;
    }

    public async getPrices()
    {
        console.log("before->this._currencyfactor: " + this._currencyfactor);
        if(this._currencyfactor == 0.0)
        {
            let response = await fetch("../data/currencies.json")
            let currencyTable = (await response.json()).data;
            this._currencyfactor = currencyTable[this.currency];
        }
        console.log("after->this._currencyfactor: " + this._currencyfactor);
        return this._currencyfactor;
    }

    public getFactor(){
        return this._currencyfactor;
    }
}

export let cc = new CurrencyConverter();
let currencysymbols = {"USD":"$","EUR":"€","GBP": "£","RUB":"₽","CNY":"¥"};


export function convert(){
    let priceHtml = document.getElementsByClassName("price");

    for (let i = 0; i < priceHtml.length; i++)
    {
        let currentprice: number = parseFloat(priceHtml.item(i).children[0].innerHTML);
        let newprice = (Math.round((currentprice* cc.getFactor()) * 100) / 100).toFixed(2);
        priceHtml.item(i).children[0].innerHTML = newprice;
        priceHtml.item(i).children[1].innerHTML = currencysymbols[cc.getCurrency()];
    }
}
