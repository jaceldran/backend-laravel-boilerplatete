export default (number, lang, currency) => {
    lang = lang || "es-ES";
    currency = currency || "EUR";


    return new Intl.NumberFormat(lang, {
        style: "currency",
        useGrouping: true,
        currency,
    }).format(number);
}
