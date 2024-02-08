export default (value) => {
    let dt = new Date(value);

    return (
        Object.prototype.toString.call(dt) === "[object Date]" &&
        !isNaN(dt.getTime()) &&
        dt.getTime() > 1
    );
}
