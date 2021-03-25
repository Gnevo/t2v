<?php

class localise {

    var $base_path = 'lang/';
    var $contents = array();

    function __construct($files, $lang) {

        //loading common.xml if not calling
        if (!in_array('common.xml', $files)) {
            
            $file_path = $this->base_path . $lang . '/common.xml';
            
            //creating xml dom
            $xml = new DOMDocument();
            
            //Loading language xml file
            $xml->load($file_path);

            $labels = $xml->getElementsByTagName('label');

            //making xml data array fro php
            foreach ($labels as $label) {

                $keys = $label->getElementsByTagName("key");
                $key = $keys->item(0)->nodeValue;

                $values = $label->getElementsByTagName("value");
                $value = $values->item(0)->nodeValue;

                $this->contents[$key] = $value;
            }
        }
        
        //getting passed value
        if (!empty($files)) {

            foreach ($files as $file) {

                //get full path of language file name
                $file_path = $this->base_path . $lang . '/' . $file;

                //creating xml dom
                $xml = new DOMDocument();
                //Loading language xml file
                $xml->load($file_path);

                $labels = $xml->getElementsByTagName('label');

                //making xml data array fro php
                foreach ($labels as $label) {

                    $keys = $label->getElementsByTagName("key");
                    $key = $keys->item(0)->nodeValue;

                    $values = $label->getElementsByTagName("value");
                    $value = $values->item(0)->nodeValue;

                    $this->contents[$key] = $value;
                }
            }
        }
    }
}

?>
