<?php
require 'config.php';
require 'common/php/header.php';
require 'src/php/templates.php';
?>

<div class="kr_content_wrapper" id="<?= ID() ?>" data-version="<?= VERSION() ?>">
  <div class="container">
    <h1><?= word('TXT_TITLE') ?></h1>
    <h2><?= word('TXT_TEXT_1') ?></h2>
  </div>
</div>

<?php require 'common/php/footer.php';
