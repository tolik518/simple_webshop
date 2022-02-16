import { cc, convert } from "./currency_converter.js";
cc.getPrices().then(() => { convert(); });
