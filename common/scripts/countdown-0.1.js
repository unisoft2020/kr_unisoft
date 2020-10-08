;

window.CountDown = (function() {
  var endDate;

  function CountDown(_endDate) {
    endDate = _endDate;
    init();
  }

  CountDown.formatValue = function (string) {
    var value = parseInt(string);

    if(value < 10)
      value = '0'+value;

    return value;
  };

  updateCountDown = function () {
    var data = getCountDownData();

    var formatFn = data ? CountDown.formatValue : function() { return 0; }

    $('#ka_countdown_days').text(data.days);
    $('#ka_countdown_hours').text(formatFn(data.hours));
    $('#ka_countdown_minutes').text(formatFn(data.minutes));
    $('#ka_countdown_seconds').text(formatFn(data.seconds));
  }

  function init() {
    var that = this;
    $( document ).ready(function onDocumentReady() {
      updateCountDown();
      setInterval(updateCountDown, 1000);
    });
  }

  getCountDownData = function () {
    var now = new Date(),
      difference = Math.ceil(endDate.getTime() - now.getTime())/1000;

      if(difference < 0)
        return false;

      return {
        days: Math.floor(difference / 60 / 60 / 24),
        hours: Math.floor(difference / 60 / 60) % 24,
        minutes: Math.floor(difference / 60) % 60,
        seconds: difference % 60
      };
  }

  return CountDown;
})();
