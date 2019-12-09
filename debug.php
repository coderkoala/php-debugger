<?php
/*
 *  @params n-params
 *  Dumps and dies
 *  Usage:
 *  include_once 'path_to_debug.php';
 *  dd() OR dd(params[])
 */

if (!function_exists('dd')) {
    function dd(...$data)
    {
	    ob_end_clean();
	    ob_start();
	    $resetStyling = "<style>
					    .wiper{
					      all: initial !important;
					      * {
					        all: unset !important; 
					      }
					    }
					    </style>
					  ";
	    echo $resetStyling;
	    ini_set("highlight.comment", "#969896; font-style: italic");
	    ini_set("highlight.default", "#FFFFFF !important");
	    ini_set("highlight.html", "#D16568 !important");
	    ini_set("highlight.keyword", "#7FA3BC !important; font-weight: bold");
	    ini_set("highlight.string", "#F2C47E !important");
	    $output = highlight_string("<?php\n\n" . var_export($data, true), true);
	    echo "<span>
    			<div 
    			style=\"background-color: #1C1E21 !important; color:#7FA3BC; font-weight: bold padding: 1rem\">
    			{$output}<br>
    			<hr>";
	    if(!empty($data) && ($data[-1] == false)){
		    echo "</div></span>";
		    exit();
	    }
	    $output = highlight_string("<?php\n\n" . var_export(debug_backtrace(), true), true);
	    echo "<div style=\"background-color: #1C1E21 !important; color:#7FA3BC; font-weight: bold padding: 1rem\">{$output}<br>";
	    echo "</div></span>";
	    exit();
    }
}
