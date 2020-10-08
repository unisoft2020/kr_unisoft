#!/usr/bin/env php
<?php

require 'config.php';

$sources = [
  KrConfig::CLIENT_YSL_BEAUTY => [
    KrConfig::PAGE_TYPE_LANDING => [
      'url' => 'https://www.yslbeauty.fr/libre/libre.html',

      'pre_marker' => '<div class=" content_asset libre ">',
      'append_to_pre' => '',

      'post_marker' => '<div class="footer_main">',
      'prepend_to_post' => '</div></div></div></div>',
    ],
  ],

  KrConfig::CLIENT_LANCOME => [
    KrConfig::PAGE_TYPE_LANDING => [
      'url' => 'https://www.lancome.fr/landing-page-write-her-future-program/',

      'pre_marker' => '<div class="main landing-page-template" data-folder-name="Write her future program">',
      'append_to_pre' => '',

      'post_marker' => '<div class="footer ">',
      'prepend_to_post' => '</div>',
    ],
  ],

  KrConfig::CLIENT_MAJE => [
    KrConfig::PAGE_TYPE_HOME => [
      'url' => 'https://fr.maje.com/',

      'pre_marker' => '<div class="homePage">',
      'append_to_pre' => '<div><div class="html-slot-container">',

      'post_marker' => '<!-- FIN zone 10 -->',
      'prepend_to_post' => '</div>',
    ],

    KrConfig::PAGE_TYPE_GRID_HEADER => [
      'url' => 'https://fr.maje.com/fr/pret-a-porter/collection/robes/',

      'pre_marker' => '<div class="content-slot slot-grid-header">',
      'append_to_pre' => '',

      'post_marker' => '<div class="search-result-content"',
      'prepend_to_post' => '</div>',
    ],

    KrConfig::PAGE_TYPE_PUSH_PRODUCT => [
      'url' => 'https://fr.maje.com/fr/pret-a-porter/collection/robes/119rimel/MFPRO00855.html',

      'pre_marker' => '<div class="one-tile-content-push">',
      'append_to_pre' => '<div class="content-asset">',

      'post_marker' => '<!-- End content-asset -->',
      'prepend_to_post' => '</div>',
    ],
  ],

  KrConfig::CLIENT_SANDRO => [
    KrConfig::PAGE_TYPE_HOME => [
      'url' => 'https://fr.sandro-paris.com/fr/femme/',

      'pre_marker' => '<div class="homePage">',
      'append_to_pre' => '<div class="html-slot-container">',

      'post_marker' => '<!-- Google Analytics Homepage -->',
      'prepend_to_post' => '</div>',
    ],

    KrConfig::PAGE_TYPE_LANDING => [
      'url' => 'https://fr.sandro-paris.com/fr/ss19-stories-1-hp-femme/SS19-stories-1-HP-femme.html',

      'pre_marker' => '<div class="content-asset">',
      'append_to_pre' => '',

      'post_marker' => '</div><!-- /main -->',
      'prepend_to_post' => '</div></section></div>',
    ],
  ],

  KrConfig::CLIENT_IKKS => [
    KrConfig::PAGE_TYPE_LANDING => [
      'url' => 'https://www.ikks.com/fr/ecatalogue-women-fw20.html',

      'pre_marker' => '<div id="primary" class="primary-content"> <div class="content-asset">',
      'append_to_pre' => '',

      'post_marker' => '</div><!-- /main -->',
      'prepend_to_post' => '</div>',
    ],

    KrConfig::PAGE_TYPE_GRID => [
      'url' => 'https://www.ikks.com/fr/femme/sacs/tous-les-sacs/',

      'pre_marker' => '</body>',
      'append_to_pre' => '',

      'post_marker' => '</html>',
      'prepend_to_post' => '',
    ],
  ],
];

$client = KrConfig::$CLIENT;
$page_type = KrConfig::$PAGE_TYPE;

if(!isset($sources[$client][$page_type]))
  die("[-] {$argv[0]}: Found no configuration for (client: $client, page_type: $page_type)");

$config = $sources[$client][$page_type];

$html = file_get_contents($config['url']);

$pre_marker = $config['pre_marker'];
list($pre, $html) = explode($pre_marker, $html, 2);
$pre .= $pre_marker . @$config['append_to_pre'];

$pre = str_replace('<title>', '<title>__ID__</title><title>', $pre);

$post_marker = $config['post_marker'];
list($html, $post) = explode($post_marker, $html, 2);
$post = @$config['prepend_to_post'] . $post_marker . $post;

file_put_contents('common/html/' . $client . '_' . $page_type . '_pre.html', $pre);
file_put_contents('common/html/' . $client . '_' . $page_type . '_post.html', $post);
