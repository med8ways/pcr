/**
 * Utitlity function that accepts DOM Element, NodeList or selector and returns array of
 * DOM Elements
 */
export default function (elements) {
  if (elements instanceof HTMLElement) {
    return [elements];
  } else if (typeof elements === 'string') {
    return Array.from(document.querySelectorAll(elements));
  } else if (elements.length) {
    return Array.from(elements);
  }
  throw new Error(`Cannot convert to elements array: ${elements}`);
}
