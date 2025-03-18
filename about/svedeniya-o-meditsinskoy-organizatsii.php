<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сведения о медицинской организации");
$APPLICATION->AddChainItem($APPLICATION->GetTitle());
?>

    <div class="row" id="blog-medium-left">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 side-bar-blog tabbable tabs-left">
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "left_menu",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "COMPONENT_TEMPLATE" => ".default",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(0=>"",),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "left",
                    "USE_EXT" => "N"
                )
            );?>

            
        </div>
        <div class="col-xs-12 col-md-8">
            <div id="page-content">
                <?php
                $cur_url = $APPLICATION->GetCurPage(false);
                $path_name = explode('/',$cur_url)[1];
                $page_name = explode('/',$cur_url)[2];
                // Проверяем, заканчивается ли строка на ".php"
                if (!preg_match('/\.php$/', $page_name)) {
                    $page_name .= ".php";
                }
                $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_TEMPLATE_PATH ."/".$path_name."/include/".$page_name), false);
                ?>
            </div>
        </div>

    </div>


    <div class="container top-padding bottom-padding">
        <div class="row">
            <div class="intro-content-wrap col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "news",
                        Array(
                            "ACTIVE_DATE_FORMAT" => "j M Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "COMPONENT_TEMPLATE" => "news",
                            "DETAIL_URL" => SITE_DIR . "news/#ELEMENT_CODE#/",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "N",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array(0 => "DATE_ACTIVE_FROM", 1 => "ACTIVE_FROM", 2 => "DATE_ACTIVE_TO", 3 => "ACTIVE_TO", 4 => "",),
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "7",
                            "IBLOCK_TYPE" => "med_bit_ecommerce_s1",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "MEDIA_PROPERTY" => "",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "2",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Новости",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(0 => "", 1 => "CODE_ICO", 2 => "",),
                            "SEARCH_PAGE" => "/search/",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SLIDER_PROPERTY" => "",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "DESC",
                            "SORT_ORDER2" => "ASC",
                            "TEMPLATE_THEME" => "blue",
                            "USE_RATING" => "N",
                            "USE_SHARE" => "N"
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>