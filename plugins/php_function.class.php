<?php

if (!function_exists('mime_content_type')) {

    function mime_content_type($filename) {

        $mime_types = array(
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',
            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',
            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',
            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',
            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = strtolower(array_pop(explode('.', $filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        } elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        } else {
            return 'application/octet-stream';
        }
    }

}

if (!function_exists('bcmod')) {

    function bcmod($x, $y) {
        // how many numbers to take at once? carefull not to exceed (int) 
        $take = 5;
        $mod = '';

        do {
            $a = (int) $mod . substr($x, 0, $take);
            $x = substr($x, $take);
            $mod = $a % $y;
        } while (strlen($x));

        return (int) $mod;
    }

}

if (!function_exists("bcdiv")) {

    function truncate1($num, $digits = 0) {
        $shift = pow(10, $digits);
        return ((floor($num * $shift)) / $shift);
    }

    function bcdiv($_ro, $_lo, $_scale = 0) {
        return truncate1($_ro / $_lo, $_scale);
    }

    function bcadd($_ro, $_lo, $_scale = 0) {
        return truncate1($_ro + $_lo, $_scale);
    }

    function bcmul($_ro, $_lo, $_scale = 0) {
        return truncate1($_ro * $_lo, $_scale);
    }

    /**
     * my_bcmod - get modulus (substitute for bcmod)
     * string my_bcmod ( string left_operand, int modulus )
     * left_operand can be really big, but be carefull with modulus :(
     * by Andrius Baranauskas and Laurynas Butkus :) Vilnius, Lithuania
     * */
    function bcmod($x, $y) {
        $oldx = $x;
        // how many numbers to take at once? carefull not to exceed (int)
        $take = 5;
        $mod = '';
        do {
            $a = (int) $mod . substr($x, 0, $take);
            $x = substr($x, $take);
            $mod = $a % $y;
        } while (strlen($x));
        return (int) $mod;
    }

    function bccomp($Num1, $Num2, $Scale = null) {
        // check if they're valid positive numbers, extract the whole numbers and decimals
        if (!preg_match("/^\+?(\d+)(\.\d+)?$/", $Num1, $Tmp1) ||
                !preg_match("/^\+?(\d+)(\.\d+)?$/", $Num2, $Tmp2))
            return('0');
        // remove leading zeroes from whole numbers
        $Num1 = ltrim($Tmp1[1], '0');
        $Num2 = ltrim($Tmp2[1], '0');
        // first, we can just check the lengths of the numbers, this can help save processing time
        // if $Num1 is longer than $Num2, return 1.. vice versa with the next step.
        if (strlen($Num1) > strlen($Num2))
            return(1);
        else {
            if (strlen($Num1) < strlen($Num2))
                return(-1);
            // if the two numbers are of equal length, we check digit-by-digit
            else {
                // remove ending zeroes from decimals and remove point
                $Dec1 = isset($Tmp1[2]) ? rtrim(substr($Tmp1[2], 1), '0') : '';
                $Dec2 = isset($Tmp2[2]) ? rtrim(substr($Tmp2[2], 1), '0') : '';
                // if the user defined $Scale, then make sure we use that only
                if ($Scale != null) {
                    $Dec1 = substr($Dec1, 0, $Scale);
                    $Dec2 = substr($Dec2, 0, $Scale);
                }
                // calculate the longest length of decimals
                $DLen = max(strlen($Dec1), strlen($Dec2));
                // append the padded decimals onto the end of the whole numbers
                $Num1.=str_pad($Dec1, $DLen, '0');
                $Num2.=str_pad($Dec2, $DLen, '0');
                // check digit-by-digit, if they have a difference, return 1 or -1 (greater/lower than)
                for ($i = 0; $i < strlen($Num1); $i++) {
                    if ((int) $Num1{$i} > (int) $Num2{$i})
                        return(1);
                    else
                    if ((int) $Num1{$i} < (int) $Num2{$i})
                        return(-1);
                }
                // if the two numbers have no difference (they're the same).. return 0
                return(0);
            }
        }
    }

}
?>