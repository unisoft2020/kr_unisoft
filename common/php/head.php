<?php
$f = BASE_DIRECTORY . '/vendor/autoload.php';
if(!file_exists($f))
  die('[-] File `autoload.php` not found ! You need to run `composer install` first');
require_once $f;

@mkdir(BASE_DIRECTORY . '/data');

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Paris');

function errHandle($errNo, $errStr, $errFile, $errLine) {
  $msg = "[!] $errStr in $errFile on line $errLine";
  if ($errNo == E_NOTICE || $errNo == E_WARNING) {
    throw new ErrorException($msg, $errNo);
  } else {
    echo $msg;
  }
} set_error_handler('errHandle');

define('DEFAULT_LANG', 'FR');
define('DEFAULT_VERSION', 'HTML');

$LANG    = isset($_GET['language']) ? $_GET['language'] : (getenv('KNR_LANGUAGE') ?: DEFAULT_LANG);
$PROD    = 'true' == (isset($_GET['production']) ? $_GET['production'] : getenv('PROD'));

$words   = [];

class KrConfig {
  const CLIENT_IKKS       = 'ikks';
  const CLIENT_MAJE       = 'maje';
  const CLIENT_SANDRO     = 'sandro';
  const CLIENT_MINELLI    = 'minelli';
  const CLIENT_CLAUDIE    = 'claudie';
  const CLIENT_UNDIZ      = 'undiz';
  const CLIENT_YSL_BEAUTY = 'ysl_beauty';
  const CLIENT_GIVENCHY   = 'givenchy';
  const CLIENT_LANCOME    = 'lancome';

  const PAGE_TYPE_RAW           = 'raw';
  const PAGE_TYPE_HOME          = 'home';
  const PAGE_TYPE_LANDING       = 'landing';
  const PAGE_TYPE_GRID_HEADER   = 'grid_header';
  const PAGE_TYPE_PUSH_GRID     = 'push_grid';
  const PAGE_TYPE_PUSH_PRODUCT  = 'push_product';

  public static $CLIENT;
  public static $PAGE_TYPE;
  public static $VERSIONS;

  public static $SUB_DOMAIN;
  public static $BASE_DOMAIN;
  public static $DEMANDWARE_ID;

  public static $is_init = false;

  public static function init($_opts = []) {
    global $PATH_TO_IMAGES, $languages;

    $opts = array_merge([
      'versions' => [DEFAULT_VERSION],
    ], $_opts);

    self::$CLIENT = $opts['client'];
    self::$PAGE_TYPE = $opts['page_type'];
    self::$VERSIONS = $opts['versions'];

    switch (self::$CLIENT) {
      case self::CLIENT_MAJE:
        self::$SUB_DOMAIN = 'fr';
        self::$BASE_DOMAIN = 'maje.com';
        self::$DEMANDWARE_ID = 'Sites-Maje-FR-Site';
        $languages = ['FR', 'UK', 'DE', 'ES', 'IT', 'IE'];
        break;

      case self::CLIENT_CLAUDIE:
        self::$SUB_DOMAIN = 'fr';
        self::$BASE_DOMAIN = 'claudiepierlot.com';
        self::$DEMANDWARE_ID = 'Sites-Claudie-FR-Site';
        $languages = ['FR'];
        break;

      case self::CLIENT_SANDRO:
        self::$SUB_DOMAIN = 'fr';
        self::$BASE_DOMAIN = 'sandro-paris.com';
        self::$DEMANDWARE_ID = 'Sites-Sandro-FR-Site';
        $languages = ['FR', 'UK', 'IT', 'DE', 'ES'];

        if(PROD())
          $PATH_TO_IMAGES = ('landing' == $opts['page_type'] ? 'LP/' : '') . ID();

        break;

      case self::CLIENT_MINELLI:
        self::$SUB_DOMAIN = 'www';
        self::$BASE_DOMAIN = 'minelli.fr';
        self::$DEMANDWARE_ID = 'Sites-Minelli-FR-Site';
        $languages = ['FR'];

        if(PROD())
          $PATH_TO_IMAGES = 'LP/' . ID() . '/images';

        break;

      case self::CLIENT_UNDIZ:
        self::$SUB_DOMAIN = 'www';
        self::$BASE_DOMAIN = 'undiz.com';
        self::$DEMANDWARE_ID = 'Sites-UNDIZ_FR-Site';
        $languages = ['FR', 'EN', 'ES', 'NL', 'RU', 'PL'];
        break;

      case self::CLIENT_YSL_BEAUTY:
        self::$SUB_DOMAIN = 'www';
        self::$BASE_DOMAIN = 'yslbeauty.fr';
        self::$DEMANDWARE_ID = 'Sites-ysl-fr-Site';
        $languages = ['EN'];
        break;

      case self::CLIENT_GIVENCHY:
        self::$SUB_DOMAIN = 'www';
        self::$BASE_DOMAIN = 'givenchy.com';
        self::$DEMANDWARE_ID = 'Sites-GIV_FR-Site';
        $languages = ['EN'];
        break;

      case self::CLIENT_LANCOME:
        self::$SUB_DOMAIN = 'www';
        self::$BASE_DOMAIN = 'lancome.fr';
        self::$DEMANDWARE_ID = 'Sites-lancome-fr-Site';
        $languages = ['EN'];

        if(PROD())
          $PATH_TO_IMAGES = 'landing-page/' . ID() . '/images';

        break;

      case self::CLIENT_IKKS:
        self::$SUB_DOMAIN = 'www';
        self::$BASE_DOMAIN = 'ikks.com';
        self::$DEMANDWARE_ID = 'Sites-IKKS_COM-Site';
        $languages = ['FR', 'EN', 'ES', 'NL'];
        break;

      default:
        throw new Exception("Wrong configuration. Check your index.php file");
    }

    $GLOBALS['BASE_DOMAIN'] = self::$BASE_DOMAIN;

    self::$is_init = true;
  }
}

$STYLES_ONLY_LOCAL = [
  'common/styles/fonts.css.php',
  'common/styles/style_for_local_only.scss',
];
$SCRIPTS_ONLY_LOCAL = [];

$SCRIPTS = [];

$SCRIPTS_ASYNC = [];
$SCRIPTS_EXTERNAL = [];

$STYLES = [];

$STYLES_EXTERNAL = [];

require 'helpers.php';
require 'data_loaders.php';
require 'words.php';
