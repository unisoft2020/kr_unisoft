<?php

use MatthiasMullie\Minify;

if(true !== KrConfig::$is_init)
  throw new Exception("KrConfig was not init");

duplicate_words('FR', 'BE-FR');
duplicate_words('UK', 'BE-EN');
duplicate_words('NL', 'BE-NL');
duplicate_words('UK', 'IE');
duplicate_words('UK', 'US');
duplicate_words('IE', 'EU');
duplicate_words('FR', 'CH-FR');
duplicate_words('DE', 'CH-DE');
duplicate_words('UK', 'CH-EN');
duplicate_words('IT', 'CH-IT');
duplicate_words('UK', 'AS');

function rebase($file) {
  global $BASE_DOMAIN;

  if(!file_exists($file))
    shell_exec('php bin/update_html.php');

  $BASE_URL = 'https://' . KrConfig::$SUB_DOMAIN .'.' . KrConfig::$BASE_DOMAIN . '/';

  $pre = str_replace([
    '__ID__',

    'href="//',

    'href="/',

    'data-srcset="/',
    'data-srcset=\'/',

    'src="//',
    'src=\'//',

    'src="/',
    'src=\'/',

    '"/on/demandware',
    "'/on/demandware",
    ', /on/demandware',
    '&quot;/on/demandware',

    '//on/',
  ], [
    strtoupper(ID()),

    'href="https://',

    'href="' . $BASE_URL,

    'data-srcset="' . $BASE_URL,
    'data-srcset=\'' . $BASE_URL,

    'src="https://',
    'src=\'https://',

    'src="' . $BASE_URL,
    'src=\'' . $BASE_URL,

    '"' . $BASE_URL . '/on/demandware',
    "'" . $BASE_URL . '/on/demandware',
    ', ' . $BASE_URL . '/on/demandware',
    '&quot;' . $BASE_URL . '/on/demandware',

    '/on/',
  ], file_get_contents($file));

  return $pre;
}

function str_replace_first($search, $replace, $subject) {
  $pos = strpos($subject, $search);
  if ($pos !== false)
    $subject = substr_replace($subject, $replace, $pos, strlen($search));
  return $subject;
}

function get_file_extension($path) {
  return pathinfo($path)['extension'];
}

function complile_scss_with_cache($compiler, $style_file) {
  global $BUST_CACHE_FOR_SCSS;

  $output = null;

  $temp_file = implode([
    sys_get_temp_dir(),
    '/assets-scss-',
    str_replace(['/', '.'], '_', $style_file),
    implode('_', [ID(), LANG(), PROD(), VERSION()])
  ]);

  if( file_exists($temp_file) ) {
    $last_time_cached = filemtime($temp_file);
    $last_time_modified = filemtime($style_file);

    if($last_time_cached >= $last_time_modified)
      $output = file_get_contents($temp_file);
  }

  if(null === $output || true === @$BUST_CACHE_FOR_SCSS) {
    $output = $compiler->compile( file_get_contents($style_file) );
    file_put_contents($temp_file, $output);
  }

  return $output;
}

function handle_style_file($style_file) {
  switch (get_file_extension($style_file)) {
    case 'css':
      return file_get_contents($style_file);
      break;

    case 'php':
      ob_start(); require $style_file; return ob_get_clean();
      break;

    case 'scss':
      $compiler = new \ScssPhp\ScssPhp\Compiler();
      $compiler->setVariables(array(
        'ID' => ID(),
        'LANG' => LANG(),
        'PATH_TO_IMAGES' => PATH_TO_IMAGES(),

        'CLIENT' => KrConfig::$CLIENT,
        'PAGE_TYPE' => KrConfig::$PAGE_TYPE,
        ));
      $compiler->addImportPath(BASE_DIRECTORY . '/common/styles/scss');
      $compiler->addImportPath(PROJECT_DIRECTORY);
      $compiler->addImportPath(BASE_DIRECTORY . '/vendor/twbs/bootstrap/scss');

      return complile_scss_with_cache($compiler, $style_file);
      break;

    default:
      throw new Exception("Don't know how to handle this type of style file: ${style_file}", 1);
  }

  return '';
}

if( (!$PROD) && KrConfig::PAGE_TYPE_RAW != KrConfig::$PAGE_TYPE )
  echo rebase('common/html/'. KrConfig::$CLIENT . '_' . KrConfig::$PAGE_TYPE . '_pre.html');

if ( ! $PROD )
  $STYLES = array_merge($STYLES, $STYLES_ONLY_LOCAL);

echo '<style type="text/css">' ;
if( $PROD ) {
  $css_minifier = new Minify\CSS();

  foreach ($STYLES as $style)
    $css_minifier->add( handle_style_file($style) );

  echo $css_minifier->minify();
} else {

  foreach ($STYLES as $style)
    echo handle_style_file($style);

}
echo '</style>';

foreach ($STYLES_EXTERNAL as $styles_external)
  echo "<link href='${styles_external}' rel='stylesheet' type='text/css'>";
