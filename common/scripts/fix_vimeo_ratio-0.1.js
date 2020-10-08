;

(function() {
  var $elements = $("iframe[src^='https://player.vimeo.com'], .fix-my-ratio");

  $elements.each(function() {

    $(this)
      .data('aspectRatio', this.height / this.width)

      .removeAttr('height')
      .removeAttr('width');

  });

  $(window).resize(function() {
    $elements.each(function() {
      var newWidth = $(this).parent().width();

      var $el = $(this);
      $el
        .width(newWidth)
        .height(newWidth * $el.data('aspectRatio'));
    });
  }).resize();
})();
