<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->IncludeComponent(
	"bitrix:main.register",
	"",
	array(
		"AJAX_MODE" => "Y",
		"USER_PROPERTY_NAME" => "",
		"SEF_MODE" => "Y",
		"SHOW_FIELDS" => array("LAST_NAME", "NAME", "SECOND_NAME", "PERSONAL_PHONE"),
		"REQUIRED_FIELDS" => array(),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(''),
		"PROPS_GROUP_USE" => "Y",
		"USE_AJAX_LOCATIONS" => "Y",
		"USER_CONSENT" => array(),
		'AUTH_RESULT' => $APPLICATION->arAuthResult,
	)
);?>