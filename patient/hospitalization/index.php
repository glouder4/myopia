<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Запись на госпитализацию");
?>
    <div id="blog-medium-left">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 side-bar-blog tabbable tabs-left">
                <?$APPLICATION->IncludeComponent("bitrix:menu", "left_menu",
                    Array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "ROOT_MENU_TYPE" => "left",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_CACHE_GET_VARS" => array(
                        0 => "",
                    ),
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N",
                ),
                    false
                );?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "service_menu",
                    Array(
                        "COMPONENT_TEMPLATE" => "service_detail",
                        "IBLOCK_TYPE" => "med_bit_ecommerce_s1",
                        "IBLOCK_ID" => "16",
                        "NEWS_COUNT" => "60",
                        "SORT_BY1" => "SORT",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "",
                        "FIELD_CODE" => array(0=>"DETAIL_PICTURE",1=>"DATE_ACTIVE_FROM",2=>"ACTIVE_FROM",3=>"DATE_ACTIVE_TO",4=>"ACTIVE_TO",5=>"",),
                        "PROPERTY_CODE" => array(0=>"CODE_ICO",1=>"",),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "j M Y",
                        "SET_TITLE" => "N",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "N",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "PAGER_TEMPLATE" => ".default",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "PAGER_TITLE" => "Новости",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => "",
                        "TEMPLATE_THEME" => "blue",
                        "MEDIA_PROPERTY" => "",
                        "SLIDER_PROPERTY" => "",
                        "SEARCH_PAGE" => "/search/",
                        "USE_RATING" => "N",
                        "USE_SHARE" => "N"
                    )
                );?>
                <?$APPLICATION->IncludeComponent(
                    "bit-ecommerce:iblock.element.add.form",
                    "",
                    Array(
                        "AJAX_MODE" => "Y",
                        "AJAX_OPTION_JUMP" => "N",
                        "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
                        "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
                        "CUSTOM_TITLE_DETAIL_PICTURE" => "",
                        "CUSTOM_TITLE_DETAIL_TEXT" => "",
                        "CUSTOM_TITLE_IBLOCK_SECTION" => "",
                        "CUSTOM_TITLE_NAME" => "",
                        "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
                        "CUSTOM_TITLE_PREVIEW_TEXT" => "",
                        "CUSTOM_TITLE_TAGS" => "",
                        "DEFAULT_INPUT_SIZE" => "30",
                        "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
                        "ELEMENT_ASSOC" => "CREATED_BY",
                        "ELEMENT_ASSOC_PROPERTY" => "",
                        "EVENT_MESSAGE_ID" => array(),
                        "GROUPS" => array("2"),
                        "IBLOCK_TYPE" => "med_bit_ecommerce_s1",
                        "IBLOCK_ID" => "18",
                        "LEVEL_LAST" => "N",
                        "LIST_URL" => "",
                        "MAX_FILE_SIZE" => "0",
                        "MAX_LEVELS" => "100000",
                        "MAX_USER_ENTRIES" => "100000",
                        "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
                        "PROPERTY_CODES" => array("AUTHOR", "EMAIL","MESSAGE","TEL"),
                        "PROPERTY_CODES_REQUIRED" => array("AUTHOR", "EMAIL","MESSAGE"),
                        "RESIZE_IMAGES" => "Y",
                        "SEF_MODE" => "N",
                        "STATUS" => "INACTIVE",
                        "STATUS_NEW" => "NEW",
                        "TITLE_ELEMENT" => "Обратная связь из левой колонки",
                        "USER_MESSAGE_ADD" => "Ваша завка успешно отправлена",
                        "USER_MESSAGE_EDIT" => "Saved",
                        "USE_CAPTCHA" => "N"
                    )
                );?>
            </div>
            <div id="contact-version-two">
                <? $APPLICATION->IncludeComponent(
                    "bit-ecommerce:iblock.element.add.form",
                    "hospitalization",
                    Array(
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
                        "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
                        "CUSTOM_TITLE_DETAIL_PICTURE" => "",
                        "CUSTOM_TITLE_DETAIL_TEXT" => "",
                        "CUSTOM_TITLE_IBLOCK_SECTION" => "",
                        "CUSTOM_TITLE_NAME" => "",
                        "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
                        "CUSTOM_TITLE_PREVIEW_TEXT" => "",
                        "CUSTOM_TITLE_TAGS" => "",
                        "DEFAULT_INPUT_SIZE" => "30",
                        "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
                        "ELEMENT_ASSOC" => "CREATED_BY",
                        "ELEMENT_ASSOC_PROPERTY" => "",
                        "EVENT_MESSAGE_ID" => array(),
                        "GROUPS" => array("2"),
                        "IBLOCK_TYPE" => "med_bit_ecommerce_s1",
                        "IBLOCK_ID" => "18",
                        "EVENT_NAME" => "BIT_HOSPITALIZATION",
                        "LEVEL_LAST" => "N",
                        "LIST_URL" => "",
                        "MAX_FILE_SIZE" => "0",
                        "MAX_LEVELS" => "100000",
                        "MAX_USER_ENTRIES" => "100000",
                        "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
                        "PROPERTY_CODES" => array("AUTHOR", "EMAIL", "TEL", "MESSAGE", "MESSAGE_2", "MESSAGE_3",),
                        "PROPERTY_CODES_REQUIRED" => array("AUTHOR", "TEL", "MESSAGE", "MESSAGE_2", "MESSAGE_3"),
                        "RESIZE_IMAGES" => "Y",
                        "SEF_MODE" => "N",
                        "STATUS" => "INACTIVE",
                        "STATUS_NEW" => "NEW",
                        "TITLE_ELEMENT" => "Госпитализация",
                        "USER_MESSAGE_ADD" => "Ваша завка успешно отправлена",
                        "USER_MESSAGE_EDIT" => "Saved",
                        "USE_CAPTCHA" => "N"
                    )
                ); ?>
            </div>
        </div>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>