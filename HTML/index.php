<?php
$rand = rand();

if('render' == @$_GET['action']) {
  chdir('..');
  require './index.php';
  die();
}
require '../config.php';
?><!DOCTYPE html>
<html>
<head>
  <title>KNR - Page Builder</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" />
  <style type="text/css">
    html, body { height: 100%; }
    body {
      font: 14px monospace, sans-serif;

      display: flex;
      flex-direction: column;
    }
    header, footer {
      color: #fff;
      background: #000;
    }
    header {
      padding: 2.5em 0;
    }
    header div {
      max-width: 500px;
      margin: auto;
    }
    footer {
      padding: 2em 0;
      text-align: center;
    }

    main {
      flex: 1 0 auto;
      padding: 2em 5em;
    }
    footer {
      flex-shrink: 0;
    }

    h1 {
      font-size: 2em;
      margin-bottom: .7em;
      text-align: center;
    }
    h2 {
      font-size: 1.4em;
    }

    pre div {
      max-height: 400px;
      overflow: auto;
    }

    a { color: #000; text-decoration: underline; }
    a:visited { color: #999; }
  </style>
</head>
<body>

  <header><div>
    <h1>KnR - Page Builder</h1>
    <h2>
      Client : <u><?= KrConfig::$CLIENT ?></u><br>
      Project : <u><?= ID() ?></u><br>
      Type : <u><?= KrConfig::$PAGE_TYPE ?></u><br>
      Build : <u><?= RELEASE() ?></u><br>
    </h2>
  </div></header>

  <main><pre>[+] Versions :<?php foreach (KrConfig::$VERSIONS as $version) {
    echo "\n  - $version\n\n";
    ?>
    · Languages :<?php
  foreach ($languages as $language) {
    $get = "language=$language&version=$version";
    echo "\n\t[+] $language: \t<a href='/?action=render&{$get}' target='_blank'>PREVIEW</a>";
    echo " | <a href='/?action=render&production=true&{$get}' download='".ID()."-".RELEASE()."-$language.html'>DOWNLOAD HTML</a>";
  } echo "\n";
}
  ?>
<br><br><br>
DOWNLOAD ZIP → <a href="/generate_zip.php" download="<?= ID().'-'.RELEASE() ?>.zip">HERE</a>
<?php if(file_exists('../images.zip')): ?>
DOWNLOAD ZIP (only images.zip) → <a href="/images.zip" download="<?= ID().'_images-'.RELEASE() ?>.zip">HERE</a>
<?php endif; ?>
<?php if(file_exists('../fonts.zip')): ?>
DOWNLOAD ZIP (only fonts.zip) → <a href="/fonts.zip" download="<?= ID().'_fonts-'.RELEASE() ?>.zip">HERE</a>
<?php endif; ?>
  </pre></main>

  <footer>
    Powered by <a href="https://knr.paris/" target="_blank">KNR Agency</a>
  </footer>

</body>
</html>
