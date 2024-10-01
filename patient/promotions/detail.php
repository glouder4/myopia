<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Врачи детальная страница ");
?>
<div id="blog-medium-left">


<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 side-bar-blog tabbable tabs-left">
<?$APPLICATION->IncludeComponent("bitrix:menu", "left_menu", Array(
	"COMPONENT_TEMPLATE" => ".default",
		"ROOT_MENU_TYPE" => "left",	// “ип меню дл¤ первого уровн¤
		"MENU_CACHE_TYPE" => "N",	// “ип кешировани¤
		"MENU_CACHE_TIME" => "3600",	// ¬рем¤ кешировани¤ (сек.)
		"MENU_CACHE_USE_GROUPS" => "Y",	// ”читывать права доступа
		"MENU_CACHE_GET_VARS" => array(	// «начимые переменные запроса
			0 => "",
		),
		"MAX_LEVEL" => "1",	// ”ровень вложенности меню
		"CHILD_MENU_TYPE" => "left",	// “ип меню дл¤ остальных уровней
		"USE_EXT" => "N",	// ѕодключать файлы с именами вида .тип_меню.menu_ext.php
		"DELAY" => "N",	// ќткладывать выполнение шаблона меню
		"ALLOW_MULTI_SELECT" => "N",	// –азрешить несколько активных пунктов одновременно
	),
	false
);?>
<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/left_block_services_feedback.php"), false);?>
</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail", 
	"news_detail", 
	array(
		"COMPONENT_TEMPLATE" => "news_detail",
		"IBLOCK_TYPE" => "med_bit_ecommerce",
		"IBLOCK_ID" => "#AKC_IBLOCK_ID#",
		"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
		"ELEMENT_CODE" => "",
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "SERTIFIKATE",
			2 => "",
		),
		"IBLOCK_URL" => "",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_CANONICAL_URL" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"USE_PERMISSIONS" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"USE_SHARE" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Страница",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"TEMPLATE_THEME" => "blue",
		"MEDIA_PROPERTY" => "",
		"SLIDER_PROPERTY" => ""
	),
	false
);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>