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
	    // Recycles buff
	    ob_end_clean();
	    ob_start();
	    
	    echo "<style>
			.wiper{
			all: initial !important;
			* {
			all: unset !important; 
			}}
	    </style>
	    ";
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
	    if(!empty($data) && (end($data) == false)){
		    echo "</div></span>";
		    exit();
	    }
	    $output = highlight_string("<?php\n\n" . var_export(debug_backtrace(), true), true);
	    echo "<div style=\"background-color: #1C1E21 !important; color:#7FA3BC; font-weight: bold padding: 1rem\">{$output}<br>";
	    echo "</div></span>";
	    exit();
    }
}

if (!function_exists('d')) {

	function d( $data ) {
		if ( is_null( $data ) ) {
			$str = "<i>NULL</i>";
		} elseif ( $data == "" ) {
			$str = "<i>Empty</i>";
		} elseif ( is_array( $data ) ) {
			if ( count( $data ) == 0 ) {
				$str = "<i>Empty array.</i>";
			} else {
				$str = "<table style=\"border-bottom:0px solid #000;\" cellpadding=\"0\" cellspacing=\"0\">";
				foreach ( $data as $key => $value ) {
					$str .= "<tr><td style=\"background-color:#008B8B; color:#FFF;border:1px solid #000;\">" . $key . "</td><td style=\"border:1px solid #000;\">" . d( $value ) . "</td></tr>";
				}
				$str .= "</table>";
			}
		} elseif ( is_resource( $data ) ) {
			while ( $arr = mysql_fetch_array( $data ) ) {
				$data_array[] = $arr;
			}
			$str = d( $data_array );
		} elseif ( is_object( $data ) ) {
			$str = d( get_object_vars( $data ) );
		} elseif ( is_bool( $data ) ) {
			$str = "<i>" . ( $data ? "True" : "False" ) . "</i>";
		} else {
			$str = $data;
			$str = preg_replace( "/\n/", "<br>\n", $str );
		}

		return $str;
	}

	function dnl( $data ) {
		echo d( $data ) . "<br>\n";
	}

	function ddt( $message = "" ) {
		echo "[" . date( "Y/m/d H:i:s" ) . "]" . $message . "<br>\n";
	}
}
