<?php

/* * **********************************************************\
 * 	  Read me : http://lotsofcode.com/php/smarty-pagination.htm
 * 	  PHP Array Pagination Copyright 2007 - Derek Harvey
 * 	  www.lotsofcode.com
 *
 * 	  This file is part of PHP Array Pagination .
 *
 * 	  PHP Array Pagination is free software; you can redistribute it and/or modify
 * 	  it under the terms of the GNU General Public License as published by
 * 	  the Free Software Foundation; either version 2 of the License, or
 * 	  (at your option) any later version.
 *
 * 	  PHP Array Pagination is distributed in the hope that it will be useful,
 * 	  but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 	  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
 * 	  GNU General Public License for more details.
 *
 * 	  You should have received a copy of the GNU General Public License
 * 	  along with PHP Array Pagination ; if not, write to the Free Software
 * 	  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA	02111-1307	USA
 *
  \*********************************************************** */
require_once('configs/config.inc.php');
class pagination {

    var $page = 1; // Current Page
    var $perPage = 10; // Items on each page, defaulted to 10
    var $showFirstAndLast = true; // if you would like the first and last page options.
    var $implodeBy = '';

    function generate($array, $perPage = 10) {
        // Assign the items per page variable
        if (!empty($perPage))
            $this->perPage = $perPage;
            
        // Assign the page variable
        if (!empty($_SERVER['QUERY_STRING'])){
            $query_string = explode('&', $_SERVER['QUERY_STRING']);
//            print_r($query_string);
             $last_index = count($query_string) - 1;
            $page_no = $query_string[$last_index];
            
            if(!is_numeric($page_no)){
                $page_no = 1;
                
            }
            
            
           $this->page = $page_no; // using the get method
        } else {
            $this->page = 1; // if we don't have a page number then assume we are on the first page
        }

        // Take the length of the array
        $this->length = count($array);

        // Get the number of pages
        $this->pages = ceil($this->length / $this->perPage);

        // Calculate the starting point 
        $this->start = ceil(($this->page - 1) * $this->perPage);

        // Return the part of the array we have requested
        return array_slice($array, $this->start, $this->perPage);
    }

    function links($base_url) {
        // Initiate the links array
        $plinks = array();
        $links = array();
        $slinks = array();
        global $preference;

        //echo $preference['url'];
        // Concatenate the get variables to add to the page numbering string
        
        $queryURL = $base_url;
            

        // If we have more then one pages
        if (($this->pages) > 1) {
            // Assign the 'previous page' link into the array if we are not on the first page
            if ($this->page != 1) {
                if ($this->showFirstAndLast) {
                    $plinks[] = '<li><a href="' . $base_url . '1/">&lt&lt</a></li> ';
                }
                $plinks[] = ' <li><a class="prev" href="' . $base_url . ($this->page - 1) . '/">&lt</a></li> ';
            }

            // Assign all the page numbers & links to the array
           /* for ($j = 1; $j < ($this->pages + 1); $j++) {
                if ($this->page == $j) {
                    $links[] = '<li><a class="selected">' . $j . '</a></li>'; // If we are on the same page as the current item
                } else {
                    $links[] = '<li><a href="?page=' . $j . $queryURL . '">' . $j . '</a></li>'; // add the link to the array
                */
            if(($this->page)==1)
            {
                for ($j = 1; $j <= 2; $j++) {
                if ($this->page == $j) {
                    $links[] = '<li class="active"><a>' . $j . '</a></li>'; // If we are on the same page as the current item
                } else {
                    $links[] = '<li><a href="' . $base_url . $j . '/">' . $j . '</a></li>'; // add the link to the array
                }
            }
            }
            else{
             for ($j = ($this->page)-1; $j <= ($this->page)+1; $j++) {
                if ($this->page == $j) {
                    $links[] = '<li class="active"><a>' . $j . '</a></li>'; // If we are on the same page as the current item
                } else {
                    if($j>$this->pages){
                        break;
                    }
                    $links[] = '<li><a href="' . $base_url . $j . '/">' . $j . '</a></li>'; // add the link to the array
                }
            }
            }
            // Assign the 'next page' if we are not on the last page
            if ($this->page < $this->pages) {
                $slinks[] = ' <li><a class="nxt" href="' . $base_url . ($this->page + 1) . '/">&gt</a></li> ';
                if ($this->showFirstAndLast) {
                    $slinks[] = '<li><a href="' . $base_url . ($this->pages) . '/">&gt&gt</a></li> ';
                }
            }

            // Push the array into a string using any some glue
            return implode(' ', $plinks) . implode($this->implodeBy, $links) . implode(' ', $slinks);
        }
        return;
    }

}

?>
