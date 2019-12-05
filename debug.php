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
	    ini_set("highlight.comment", "#969896; font-style: italic");
	    ini_set("highlight.default", "#FFFFFF");
	    ini_set("highlight.html", "#D16568");
	    ini_set("highlight.keyword", "#7FA3BC; font-weight: bold");
	    ini_set("highlight.string", "#F2C47E");
	    $output = highlight_string("<?php\n\n" . var_export($data, true), true);
	    echo "<div style=\"background-color: #1C1E21; color:#7FA3BC; font-weight: bold padding: 1rem\">{$output}<br><hr>";
	    $output = highlight_string("<?php\n\n" . var_export(debug_backtrace(), true), true);
	    echo "<div style=\"background-color: #1C1E21; color:#7FA3BC; font-weight: bold padding: 1rem\">{$output}<br>";
	    echo "</div>";
	    die();
    }
}
