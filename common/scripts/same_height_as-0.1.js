;

window.SameHeightAs = function() {
  SameHeightAs.onSameHeightAsDivs = function() {
    var $that = $(this),
      same_height_as_selector = $that.data('same-height-as'),
      $same_height_as = $(same_height_as_selector).first(),

      // ignore_full = $that.data('ignore-full'),
      ignore_full = true,
      fixed_size = $that.data('fixed-size'),
      use_inner_height = $that.data('use-inner-height');

    // $same_height_as.find('img').on('load', fn_onSameHeightAsDivs);
    // $same_height_as.find('img').on('load', function() {
    //   console.debug(this, ' just loaded !');
    //   fn_onSameHeightAsDivs();
    // });

    $same_height_as.on('load', fn_onSameHeightAsDivs);

    if( 0 == $same_height_as.length ) {
      console.debug('Could not find element');
      return true;
    }

    if( ! $same_height_as.is(':visible') ) {
      console.debug('Element is not visible');
      return ;
    }

    if( ! ignore_full && $same_height_as.parent().width() == $same_height_as.outerWidth() ) {
      console.debug('Disabled on full-width element');
      return;
    }

    var new_height = use_inner_height ? $same_height_as.innerHeight() : $same_height_as.height();

    $that.css('min-height', new_height);
    if(fixed_size)
      $that.css('height', new_height);
  }

  function fn_onSameHeightAsDivs() {
    $('div[data-same-height-as]').each(SameHeightAs.onSameHeightAsDivs);
  }

  $( document ).ready(fn_onSameHeightAsDivs);
  $( window ).resize(fn_onSameHeightAsDivs);

  fn_onSameHeightAsDivs();
};
