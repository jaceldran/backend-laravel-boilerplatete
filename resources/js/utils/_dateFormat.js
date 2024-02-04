export default (isoDateString, options) => {
    options = options || {};

    const date = new Date(isoDateString);
    const lang = options.lang || 'es';

    // options.weekday = options.weekday || "short";
    options.month = options.month || "numeric";
    options.day = options.day || "numeric";
    options.year = options.year || "numeric";

    return date.toLocaleDateString(lang, options);
}
