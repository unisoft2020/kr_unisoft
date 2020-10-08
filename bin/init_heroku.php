#!/usr/bin/env php
<?php

function create_app_name_for_heroku($string) {
  $string = strtolower($string);
  $string = str_replace('_', '-', $string);

  if(strlen($string) < 30)
    return $string;

  $chunks = explode('-', $string, 3);
  if(count($chunks) < 3)
    $chunks[2] = 'my-app';

  $string = 'k-' . substr($chunks[1], 0, 3) . '-' . substr($chunks[2], 0, 21) . rand(10, 99);

  return $string;
}

require 'config.php';

if(empty($ID) || 'kr_' == $ID || 'kr-' == $ID)
  die("[-] Please edit '$file_to_read' to change \$ID. Then run me again");

try { @mkdir('HTML/fonts/'); } catch(Exception $e) {}
try { @mkdir('HTML/images/'); } catch(Exception $e) {}
try { @mkdir('HTML/images/' . $ID); } catch(Exception $e) {}

shell_exec('mv hooks/* .git/hooks');
shell_exec('rmdir hooks');

passthru('npm install');
passthru('composer install');
passthru('git add .');
passthru('git commit --allow-empty -am init');

if($app_name = shell_exec('heroku config:get HEROKU_APP_NAME')) {
  echo "[+] Found an existing Heroku app: '$app_name'";
  passthru('git branch -u heroku/master master');
} else {
  $app_name = create_app_name_for_heroku($ID);
  passthru('heroku apps:create --region eu --remote heroku ' . $app_name, $return_var);

  if(0 != $return_var)
    die("\n[-] Could not create the Heroku APP. See error message above. Maybe check your credentials or change your ID ?\n");
}

passthru('heroku labs:enable runtime-dyno-metadata --remote heroku');
passthru('heroku access:add gabriel@kaam.fr --remote heroku');
passthru('heroku access:add team@knr.paris --remote heroku');
passthru('git push -u heroku master:master');

echo "\n\n[+] Done.\n\n";
echo "Now run the server with: gulp watch\n";
