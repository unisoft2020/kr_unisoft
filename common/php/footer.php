<?php
use MatthiasMullie\Minify;

foreach ($SCRIPTS_EXTERNAL as $script_external)
  echo "<script src='${script_external}'></script>";

foreach ($SCRIPTS_ASYNC as $name => $script_async) {
  if( ! file_exists($script_async) )
    throw new Exception("Request file '$script_async' does not exist", 1);

  if( $PROD ) {
    $js_minifier = new Minify\JS();
    $js_minifier->add($script_async);

    $content = $js_minifier->minify();
  } else {
    $content = file_get_contents($script_async);
  }
  echo '<script>function knr_load_' . $name . ' () {' . $content . '}</script>';
}

foreach ($SCRIPTS as $script) {
  if( ! file_exists($script) )
    throw new Exception("Request file '$script' does not exist", 1);

  if( $PROD ) {
    $js_minifier = new Minify\JS();
    $js_minifier->add($script);

    $content = $js_minifier->minify();
  } else
    $content = file_get_contents($script);

  echo '<script>' . $content . '</script>';
}

if(!$PROD)
  if( KrConfig::PAGE_TYPE_RAW != KrConfig::$PAGE_TYPE )
    echo rebase('common/html/' . KrConfig::$CLIENT . '_' . KrConfig::$PAGE_TYPE . '_post.html');
