export default (index, format, lang) => {
    format = format || 'short';
    lang = lang || 'en-GB';
    const date = new Date();
    date.setMonth(index);

    return date.toLocaleString(lang, { month: format });
}
