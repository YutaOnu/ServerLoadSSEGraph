<?php
header("Cache-Control: no-store");
header("Content-Type: text/event-stream");

date_default_timezone_set('Asia/Tokyo');
for($i = 0; $i < 20; $i++){
  $timestamp = date('Y-m-d H:i:s');
  $load = sys_getloadavg();
  echo "data: {\"time\": \"{$timestamp}\", \"load\": {$load[0]}}\n\n";
  flush();
  sleep(2);
}
