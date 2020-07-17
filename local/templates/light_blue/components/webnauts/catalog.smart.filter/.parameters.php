<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!CModule::IncludeModule("iblock"))
    return;

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "AJAX_MODE" => array(),
        "CACHE_TIME" => array("DEFAULT" => 3600),
        "IBLOCK_ID" => array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("WN_IBLOCK_IBLOCK"),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),
        "FILTER_NAME" => array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("WN_IBLOCK_FILTER_NAME_OUT"),
            "TYPE" => "STRING",
            "DEFAULT" => "arrFilter",
        ),
    ),

);
?>
