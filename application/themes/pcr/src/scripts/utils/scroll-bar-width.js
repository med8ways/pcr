export default function () {
  const scrollDiv = document.createElement('div');
  scrollDiv.style.overflow = 'scroll';
  scrollDiv.style.width = '30px';
  document.body.appendChild(scrollDiv);

  const scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;

  document.body.removeChild(scrollDiv);
  return scrollbarWidth;
}
