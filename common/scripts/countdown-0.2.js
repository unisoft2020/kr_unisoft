;

// Requires TweenLite

window.CountDown = (function() {
  var endDate;
  var callBacks;

  function CountDown(_endDate, _callBacks) {
    endDate = _endDate;
    callBacks = $.extend({}, {
      after: undefined,
    }, _callBacks);

    init();
  }

  CountDown.formatValue = function (string) {
    var value = parseInt(string);

    if(value < 10)
      value = '0' + value;

    return value;
  };

  updateCountDown = function (data) {
    if (undefined === data) {
      var data = getCountDownData();
    } else {
      data = {
        days: Math.floor(data.days),
        hours: Math.floor(data.hours),
        minutes: Math.floor(data.minutes),
        seconds: Math.floor(data.seconds)
      }
    }

    var formatFn = data ? CountDown.formatValue : function() { return 0; }
    $('#ka_countdown_days').text(formatFn(data.days));
    $('#ka_countdown_hours').text(formatFn(data.hours));
    $('#ka_countdown_minutes').text(formatFn(data.minutes));
    $('#ka_countdown_seconds').text(formatFn(data.seconds));
  }

  function init() {
    var that = this;
    $( document ).ready(function onDocumentReady() {
      incrementToTargetedTime();
      updateCountDown();
      setInterval(updateCountDown, 1000);
    });
  }

  incrementToTargetedTime = function() {
    var targetedTime = getCountDownData();

    var currentTime = {
      days: 0,
      hours: 0,
      minutes: 0,
      seconds: 0
    };

    var tween = TweenLite.to(currentTime, 1, {
      days: targetedTime.days,
      hours:targetedTime.hours,
      minutes:targetedTime.minutes,
      seconds:targetedTime.seconds,
      onUpdate: updateCountDown,
      onUpdateParams: [currentTime],
      onComplete: updateCountDown
    });
  }

  getCountDownData = function () {
    var now = new Date(),
      difference = Math.ceil(endDate.getTime() - now.getTime())/1000;

    if(difference <= 0) {
      if(callBacks.after) callBacks.after();
    }

    return {
      days: Math.floor(difference / 60 / 60 / 24),
      hours: Math.floor(difference / 60 / 60) % 24,
      minutes: Math.floor(difference / 60) % 60,
      seconds: difference % 60
    };
  }

  return CountDown;
})();
