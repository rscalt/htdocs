<?php
function getdata($servers, $extensions)
{
    $line = '';
    $extbyhost = array();
    foreach ($extensions as $extension => $extension_data) {
        if (!array_key_exists('host', $extension_data)) {
            continue;
        }
        if (!array_key_exists($extension_data['host'], $extbyhost)) {
            $extbyhost[$extension_data['host']] = array();
        }
        $extbyhost[$extension_data['host']][$extension] = False;
    }
    unset($extensions);
    foreach ($extbyhost as $host => $extensions) {
        if ($line) {
            $line .= ',';
        }
        if (array_key_exists($host, $servers)) {
            $line .= get_data_from_server($host, $servers[$host]['port'], @array_keys($extbyhost[$host]));
        } else {
            $line .= get_data_from_server($servers[0]['host'], $servers[0]['port'], @array_keys($extbyhost[$host]));
        }
    }
    if (!$extbyhost) {
        return return_error(3, 'no extension states');
    }
    if (!$line) {
        return return_error(101, 'NO DATA');
    }
    return $line;