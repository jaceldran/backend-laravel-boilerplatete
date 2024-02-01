
// https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Intl/NumberFormat/NumberFormat


export default (number, options) => {
    const compact = (number) => {

        const suffix = ['', 'K', 'M', 'B', 'T'];

        let magnitude = 0;
        while (number >= 1000) {
            number /= 1000;
            magnitude++;
        }

        return { suffix: suffix[magnitude], number };
    }

    const setDefaultValue = (propertyName, defaultValue) => {
        if (!options.hasOwnProperty(propertyName)) {
            options[propertyName] = defaultValue;
        }
    }

    options = options || {};
    let suffix = '';

    setDefaultValue("lang", "es-ES");
    setDefaultValue("style", "decimal");
    setDefaultValue("useGrouping", true);
    setDefaultValue("trailingZeroDisplay", "auto");

    if (options.hasOwnProperty('currency')) {
        options.style = "currency";
    }

    if (options.style === 'currency') {
        setDefaultValue("currency", "EUR");
    }

    if (options.compact === true) {
        let compacted = compact(number);
        suffix = compacted.suffix;
        number = compacted.number;
        options.maximumFractionDigits = 0;
    }

    return new Intl
        .NumberFormat(options.lang, options)
        .format(number) + suffix;
};
