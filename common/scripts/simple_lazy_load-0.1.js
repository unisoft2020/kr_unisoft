// LAZY LOAD GIFs
var elements = document.querySelectorAll('[data-src-after-load]');
var n = elements.length;

for (var i = 0; i < n; i++) {
  elements[i].src = elements[i].dataset.srcAfterLoad;
}

var elements = document.querySelectorAll('[data-background-after-load]');
var n = elements.length;

for (var i = 0; i < n; i++) {
  var b = elements[i].dataset.backgroundAfterLoad;

  if(0 !== b.indexOf('url(')) b = 'url(' + b + ')';

  elements[i].backgroundImage = b;
}
