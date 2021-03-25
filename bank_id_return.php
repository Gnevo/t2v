<?php

$filename = "check_id.txt";
    if (file_exists($filename) && is_writable($filename)) {
        if ($handle = fopen($filename, 'a')) {
            fwrite($handle, "I am Here");
            if (fwrite($handle, $tmpw) == FALSE)
                echo "Cannot write to file ($filename)";
            fclose($handle);
        }
    }
?>
