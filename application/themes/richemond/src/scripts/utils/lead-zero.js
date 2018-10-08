export default function leadZero(int) {
    return (0 <= int && int < 10) ? ("0" + int) : int;
}
