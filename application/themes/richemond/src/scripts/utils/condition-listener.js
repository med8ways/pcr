export default function(condition, onTrue, onFalse) {
    let value;
    window.addEventListener('resize', _resize);
    _resize();
    function _resize() {
        const newValue = condition();
        if (newValue === value) return;
        value = newValue;
        value ? onTrue() : onFalse();
    }
}