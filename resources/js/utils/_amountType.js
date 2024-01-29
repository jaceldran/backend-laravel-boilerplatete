export default (number) => {
    if (number === 0) { return "zero"; }
    return number < 0 ? "credit" : "debit";
}
