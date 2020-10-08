<?php

define('PROJECT_DIRECTORY', dirname(__FILE__));
define('BASE_DIRECTORY', PROJECT_DIRECTORY );

require 'common/php/head.php';

// CHANGE ME !
$ID = 'kr_unisoft';

KrConfig::init([
  'client' => KrConfig::CLIENT_MAJE, # only change the XXX value and ONLY uppercase
  'page_type' => KrConfig::PAGE_TYPE_LANDING, # same thing

  // 'versions' => ['V1', 'V2'],
]);

define('URL_FOR_SPREADSHEET_TXT', 'https://docs.google.com/spreadsheets/d/e/2PACX-1vSw04z2SDch1u1J9C9Wmyr8uTlBmJvYUsHhQpZCi8_obpLJNG5g7nWRpKb6zx-OB9aIv56IZZkX6Sy0/pub?gid=0&single=true&output=csv'); // URL TO 'TXT' CSV GOES HERE
define('URL_FOR_SPREADSHEET_URL', 'https://docs.google.com/spreadsheets/d/e/2PACX-1vSw04z2SDch1u1J9C9Wmyr8uTlBmJvYUsHhQpZCi8_obpLJNG5g7nWRpKb6zx-OB9aIv56IZZkX6Sy0/pub?gid=1349220144&single=true&output=csv'); // URL TO 'URL' CSV GOES HERE

// SET THIS VARIABLE TO 'TRUE' TO BUST THE CACHE OF SCSS FILES
// $BUST_CACHE_FOR_SCSS = true;

// ADD HERE YOUR CUSTOM JS FILES TO INCLUDE
// $SCRIPTS_ASYNC['name'] = 'lib/...';
// $SCRIPTS_EXTERNAL[] = 'https://';
// $SCRIPTS[] = 'src/scripts/script.js';

// ADD HERE YOUR CUSTOM CSS FILES TO INCLUDE
// $STYLES_EXTERNAL[] = 'https://';
$STYLES[] = 'src/styles/fonts.css.php';
$STYLES[] = 'src/styles/style.scss';

 $languages = [
   'FR',
   'UK',
   'DE',
   'ES',
   'IT',
   'EU',
   'US',
   'IE',
   'NL',
   'BE-FR',
   'BE-EN',
   'BE-FL',
   'CH-FR',
   'CH-DE',
   'CH-EN',
   'CH-IT',
 ];

load_words('TXT', URL_FOR_SPREADSHEET_TXT, BASE_DIRECTORY . '/data/_words.php');
load_words('URL', URL_FOR_SPREADSHEET_URL, BASE_DIRECTORY . '/data/_urls.php');
