export default function (name) {
  if (typeof (Event) === 'function') {
    return new Event(name);
  } else {
    const event = document.createEvent('Event');
    event.initEvent(name, true, true);
    return event;
  }
}