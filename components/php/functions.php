<?php

function strip_zeros_from_date( $marked_string="" ) {
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
   exit;
  }
}

function output_message($message="") {
  if (!empty($message)) { 
    return "<p class=\"message\">{$message}</p>";
  } else {
    return "";
  }
}

function __autoload($class_name) {
	$class_name = strtolower($class_name);
  $path = LIB_PATH.DS."{$class_name}.php";
  if(file_exists($path)) {
    require_once($path);
  } else {
		die("The file {$class_name}.php could not be found.");
	}
}
//----------

function url_arguments_without($attr="")
{
	$attributes="?g=g";
	
	if (isset($_GET['pmodal']) && $attr != "pmodal")
		$attributes .= "&pmodal=".$_GET['pmodal'];
	if (isset($_GET['smodal']) && $attr != "smodal")
		$attributes .= "&smodal=".$_GET['smodal'];	
	if (isset($_GET['omodal']) && $attr != "omodal")
		$attributes .= "&omodal=".$_GET['omodal'];	
	if (isset($_GET['action']) && $attr != "action")
		$attributes .= "&action=".$_GET['action'];
		
	return $attributes;	
}
function url_arguments()
{		
	return url_arguments_without("null");
}
?>