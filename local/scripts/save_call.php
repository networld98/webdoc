<?
$file = file_get_contents('./count_call.txt', true);
$count = $file+1;
$f = fopen('count_call.txt', 'w');
fwrite($f, $count);
fclose($f);
?>