;

/*
This script fires the event 'jquery:loaded' when jQuery becomes available to use.

How tu use:
1 - make sure that jQuery.js is loaded on the page
  (if jQuery is not preent in the client's HTML ; make sure to add it in your config.php via $SCRIPTS_EXTERNAL)
2 - add this script to your config.php
3 - use this handle in your script.js:

window.addEventListener('jquery:loaded', function() {
  alert('jQuery is loaded !');
});
*/

(function() {
  var detect = function() {
    if(window.jQuery) {
      clearInterval(interval);
      window.dispatchEvent(new Event('jquery:loaded'));
    }
  };

  var interval = setInterval(detect, 1000);
  window.addEventListener('load', detect);
  detect();
})();
