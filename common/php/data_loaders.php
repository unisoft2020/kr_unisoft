<?php

function load_words($prefix, $spreadsheet_url = '', $out_file = '_urls.php') {
  global $words;

  $spreadsheet_data = [];

  if( empty( $spreadsheet_url ) )
    return ;

  if(file_exists($out_file)) {
    $time = filemtime($out_file);
    $now = time();
    $diff = $now - $time;

    if($diff <= 60*2) // 2 mins
      goto load_words__end;
  }

  $columns = [];

  if (($handle = fopen($spreadsheet_url, "r", false)) === FALSE)
    die("Problem reading csv");

  while (($data = fgetcsv($handle, 10000, ",")) !== FALSE)
    if(empty($columns))
      $columns = array_flip( array_map('trim', $data) );
    else
      $spreadsheet_data[] = $data;
  fclose($handle);

  if(!isset($columns['ID']))
    die('[-] The `ID` columns in missing from your spreadsheet');

  $output = "<?php\n\n";
  foreach ($spreadsheet_data as $row) {
    $row = array_map('trim', $row);

    $output .= '$words["' . $prefix . '_' . $row[ $columns['ID'] ] . '"] = [' . "\n" ;
    foreach ($columns as $lang => $id_column) {
      if('ID' === $lang)  continue;
      if('URL' === $lang) $lang = 'ALL';

      try {
        $output .=  ' "' . $lang . '" => "' . clean_cell_data( $row[ $id_column ] ) . '"' . ",\n";
      } catch (Exception $e) {
        error_log( print_r([$lang, $row], true) );
        throw $e;

      }
    }
    $output .= "];\n";
  }

  file_put_contents($out_file, $output);

  load_words__end:
  include $out_file;
}

function clean_cell_data($data) {
  $data = str_replace('"', '\\"', $data);
  $data = str_replace('$', '\$', $data);
  return $data;
}
