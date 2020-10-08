<?php
require '../config.php';

$zip = new ZipArchive;
$file_name = tempnam(sys_get_temp_dir(), 'ZIP_');

if (true !== $e = $zip->open($file_name, ZipArchive::CREATE|ZipArchive::OVERWRITE))
  die("Error - $file_name - $e");

chdir('..');

$zip->addFile('images.zip');
$zip->addFile('fonts.zip');

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"".ID()."-".RELEASE(). ".zip\"");
header("Content-Transfer-Encoding: binary");
ob_end_flush();

foreach (KrConfig::$VERSIONS as $version)
  foreach ($languages as $language) {
    $file = "{$version}/{$language}.html";

    putenv("VERSION=$version");
    putenv("KNR_LANGUAGE=$language");
    putenv("PROD=true");

    $zip->addFromString($file, shell_exec('php index.php'));
  }

$zip->close();

header("Content-Length: " . filesize($file_name));
@readfile($file_name);
