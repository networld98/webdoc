<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("WN_CATALOG_SMART_FILTER_TITLE"),
	"DESCRIPTION" => GetMessage("WN_CATALOG_SMART_FILTER_DESCR"),
	"ICON" => "/images/user_authform.gif",
	"PATH" => array(
			"ID" => "content",
			"CHILD" => array(
				"ID" => "content",
				"NAME" => GetMessage("WN_GROUP_NAME")
			)
		),	
);
?>