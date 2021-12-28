<?php
$fp = fsockopen("localhost", 81, $errno, $errstr, 21);
if (!$fp) {
  echo "$errstr ($errno)<br>";
} else {
  $out = "GET / HTTP/1.1\r\n";
  $out .= "Host: www.w3schools.com\r\n";
  $out .= "Connection: Close\r\n\r\n";
  fwrite($fp, $out);
  while (!feof($fp)) {
    echo fgets($fp, 128);
  }
  fclose($fp);
}
?>