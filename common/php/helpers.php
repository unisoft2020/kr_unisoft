<?php

function ID() { global $ID; return $ID; }
function LANG() { global $LANG; return $LANG; }
function PROD() { global $PROD; return $PROD; }
function RELEASE() { return getenv('HEROKU_RELEASE_VERSION') ?: 'v0'; }
function SHORT_LANG() { return explode('-', LANG())[0]; }
function VERSION() { return isset($_GET['version']) ? $_GET['version'] : (getenv('VERSION') ?: DEFAULT_VERSION); }

function PATH_TO_IMAGES() {
  global $PATH_TO_IMAGES;

  if(isset($PATH_TO_IMAGES))
    return $PATH_TO_IMAGES;

  $path = 'images/' . ID();

  return $path;
}

function path_to_image($file_name) {
  return PATH_TO_IMAGES() . '/'. $file_name .'?$staticlink$';
}

function parse_rich_text($text) {
  return preg_replace_callback('/\[([^\]\n]+)\]/', function($matches) {
    $string = trim($matches[1]);

    $chunks = explode(' ', $string, 2);

    switch (mb_strtolower($chunks[0])) {
      case 'link':
        return sprintf('<a href="%s" target="_blank">', word('URL_' . $chunks[1]));
        break;

      case '/link':
        return '</a>';
        break;

      default:
        error_log("\tUnexpected value for custom variable: '$string'\n", 3, "erros.log");
        break;
    }

    return $matches[0];
  }, $text);
}

function word($id, $raise_if_not_found = false) {
  global $words, $LANG;

  try {
    $temp_words = $words[$id];

    $string = empty( $temp_words[ $LANG ] ) ? $temp_words[ 'ALL' ] : $temp_words[ $LANG ];

    if(0 === strpos($id, 'URL'))
      return long_url($string);

    $string = parse_rich_text($string);

    return nl2br($string, false);

  } catch (Exception $e) {
    if(true === $raise_if_not_found)
      throw $e;
    else
      error_log("\t/!\ ERROR /!\\\t/!\ ERROR /!\\\t/!\ ERROR /!\\\t/!\ ERROR /!\\");
      error_log($e->getMessage());
      error_log($e->getTraceAsString());
      return '';
  }
}
function word_responsive($id, $classes = 'hidden-xs hidden-on-mobile d-none d-sm-inline') {
  return str_replace('<br>', '<br class="' . $classes . '">', word($id));
}
function duplicate_words($lang_from, $lang_to) {
  global $words;

  foreach ($words as $key => $values) {
    if(empty($values[$lang_to]) && !empty($values[$lang_from]))
      $words[$key][$lang_to] = $values[$lang_from];
  }
}

function long_url($short_url) {
  global $BASE_DOMAIN;

  $short_url = str_replace("'", '', $short_url);

  if(empty($short_url))
    return null;

  if(PROD())
    return $short_url;
  else {
    $chunks = array_map('trim', explode(',', rtrim($short_url, ')')));

    $type = array_shift($chunks);

    $get_query_string = function($chunks) {
      $string = '';
      foreach ($chunks as $index => $chunk) {
        if($index % 2 === 0) {
          if('' !== $string)
            $string .= '&';
          $string .= $chunk;
        } else {
          $string .= '=' . $chunk;
        }
      }

      return $string;
    };

    $query_string = $get_query_string($chunks);

    switch (strtolower($type)) {
      case "url(product-show":
      case "httpurl(product-show":
      case "httpsurl(product-show":
        return 'https://' . KrConfig::$SUB_DOMAIN . '.' . KrConfig::$BASE_DOMAIN . '/on/demandware.store/' . KrConfig::$DEMANDWARE_ID . '/fr/Product-Variation?' . $query_string;
        break;

      case "include(product-getproductinfo":
        switch($chunks[3]) {
          case 'name':
          case 'smcp_subTitle':
            return 'Titre Produit';
            break;

          case 'price':
            return 'XXX €';
            break;
        }
        break;

      case "url(search-show":
      case "httpurl(search-show":
      case "httpsurl(search-show":
        return 'https://' . KrConfig::$SUB_DOMAIN . '.' . KrConfig::$BASE_DOMAIN . '/on/demandware.store/' . KrConfig::$DEMANDWARE_ID . '/fr/Search-Show?cgid=' . urlencode($chunks[1]);
        break;

      default:
        return $short_url;
        break;
    }
  }
}

function show_image($file_name, $class = 'img-fluid', $alt = '') {
  error_log('show_image() has been deprecated. Please use path_to_image() instead. We no longer src/srcset attributes');
  return '<img alt="' . $alt . '" class="' . $class . '" src="' . path_to_image($file_name) . '" />';
}

function get_words_filter_by_prefix($prefix) {
  global $words;

  return array_filter($words, function($key) use ($prefix) {
    return 0 === strpos($key, $prefix);
  }, ARRAY_FILTER_USE_KEY);
}

/*
 * Loop over multiple items from the Google Doc
 *
 * Doc is like this:
 * TXT_SLIDER_1__SLIDE_1    FOO
 * TXT_SLIDER_1__SLIDE_2    BAR
 *
 * Then, do this:
 * <ul>
 * <?php loop_over('TXT_SLIDER_1__SLIDE_', function($slide_id) { ?>
 *   <li>Slide #<?= $slide_id ?>: <?= word('TXT_SLIDER_1__SLIDE_' . $slide_id) ?></li>
 * <?php });
 * </ul>
 */
function loop_over($prefix, $callback) {
  global $words;

  $matching_ids = get_words_filter_by_prefix($prefix);

  $counters = array_map(function($key) use ($prefix) {
    return intval(str_replace($prefix, '', $key));
  }, array_keys($matching_ids));

  foreach (array_unique($counters) as $count)
    $callback($count);
}

function kr_spacer($xs = null, $sm = null, $md = null, $lg = null, $xl = null) {
  if(null === $xs) $xs = 0;
  if(null === $sm) $sm = $xs;
  if(null === $md) $md = $sm;
  if(null === $lg) $lg = $md;
  if(null === $xl) $xl = $lg;
?>
<div class="clear kr_spacer">
  <div class="d-block d-sm-none" style="height: <?= $xs ?>px">&nbsp;</div>
  <div class="d-none d-sm-block d-md-none" style="height: <?= $sm ?>px">&nbsp;</div>
  <div class="d-none d-md-block d-lg-none" style="height: <?= $md ?>px">&nbsp;</div>
  <div class="d-none d-lg-block d-xl-none" style="height: <?= $lg ?>px">&nbsp;</div>
  <div class="d-none d-xl-block" style="height: <?= $xl ?>px">&nbsp;</div>
</div>
<?php
}

function show_button_to_top() {
  if(KrConfig::$CLIENT == KrConfig::CLIENT_MAJE
    && KrConfig::$PAGE_TYPE != KrConfig::PAGE_TYPE_HOME)

    include 'common/php/button_top.php';
}

function load_font_file($font_family, $file_name, $font_weight = 'normal', $font_style = 'normal') {
  static $types = [
    'ttf'   => ['type' => 'truetype', 'mime' => 'font/ttf'],
    'otf'   => ['type' => 'truetype', 'mime' => 'font/otf'],
    'woff'  => ['type' => 'woff',     'mime' => 'font/woff'],
    'woff2' => ['type' => 'woff2',    'mime' => 'font/woff2'],
    'eot'   => ['type' => 'embedded-opentype', 'mime' => 'application/vnd.ms-fontobject'],
    'svg'   => ['type' => 'svg', 'mime' => 'image/svg+xml'],
  ];

  $extension = strtolower(pathinfo($file_name)['extension']);
  $data = $types[$extension];
?>
@font-face {
  font-family: '<?= addslashes($font_family) ?>';
  src: url(fonts/<?= $file_name ?>?$staticlink$) format('<?= $data['type'] ?>');
  font-weight: <?= $font_weight ?>;
  font-style: <?= $font_style ?>;
}
<?php
}

// Deprecated
function load_font_file_inline($font_family, $file_name, $font_weight = 'normal', $font_style = 'normal') {
  static $types = [
    'ttf'   => ['type' => 'truetype', 'mime' => 'font/ttf'],
    'otf'   => ['type' => 'truetype', 'mime' => 'font/otf'],
    'woff'  => ['type' => 'woff',     'mime' => 'font/woff'],
    'woff2' => ['type' => 'woff2',    'mime' => 'font/woff2'],
    'eot'   => ['type' => 'embedded-opentype', 'mime' => 'application/vnd.ms-fontobject'],
    'svg'   => ['type' => 'svg', 'mime' => 'image/svg+xml'],
  ];

  $extension = strtolower(pathinfo($file_name)['extension']);
  $data = $types[$extension];

  $base64 = base64_encode(file_get_contents(BASE_DIRECTORY . '/src/fonts/' . $file_name));
?>
@font-face {
  font-family: '<?= addslashes($font_family) ?>';
  src: url(data:<?= $data['mime'] . ';charset=utf-8;base64,' . $base64 ?>) format('<?= $data['type'] ?>');
  font-weight: <?= $font_weight ?>;
  font-style: <?= $font_style ?>;
}
<?php
}
