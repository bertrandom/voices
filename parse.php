<?php

    function pushHash($hash) {
        
        global $hashes;
        
        $char1 = substr($hash, 0, 1);
        $char2 = substr($hash, 1, 1);
        $char3 = substr($hash, 2, 1);
        $char4 = substr($hash, 3, 1);
        $char5 = substr($hash, 4, 1);
        
        if (!isset($hashes[$char1])) {
            $hashes[$char1] = array();
        }

        if (!isset($hashes[$char1][$char2])) {
            $hashes[$char1][$char2] = array();
        }

        if (!isset($hashes[$char1][$char2][$char3])) {
            $hashes[$char1][$char2][$char3] = array();
        }

        if (!isset($hashes[$char1][$char2][$char3][$char4])) {
            $hashes[$char1][$char2][$char3][$char4] = array();
        }

        if (!isset($hashes[$char1][$char2][$char3][$char4][$char5])) {
            $hashes[$char1][$char2][$char3][$char4][$char5] = array();
        }

        $hashes[$char1][$char2][$char3][$char4][$char5][$hash] = 1;        
        
    }

    ini_set('memory_limit','512M');

    $fp = fopen('emails.txt', 'r');

    $hashes = array();

    while (($buffer = fgets($fp, 4096)) !== false) {

        $parts = explode(':', $buffer);

        if (trim($parts[1]) !== '') {
            $hash = md5(trim($parts[1]));
            pushHash($hash);
        }
        
        if (trim($parts[2]) !== '') {
            $hash = md5(trim($parts[2]));
            pushHash($hash);
        }
        
    }
    
    fclose($fp);

    foreach ($hashes as $char1 => $hashes1) {
        foreach ($hashes1 as $char2 => $hashes2) {
            file_put_contents('hashes_' . $char1 . $char2 . '.json', json_encode($hashes2));
        }
    }
    
?>