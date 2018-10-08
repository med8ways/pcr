export default function () {
  return /MSIE \d|Trident.*rv:/.test(navigator.userAgent) || /Edge/.test(navigator.userAgent);
}
