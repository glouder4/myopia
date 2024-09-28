<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Главная");
?><? $APPLICATION->IncludeComponent("bit-ecommerce:slide", "mainpage-slider", Array(
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_ID" => "17",	// Id инфоблока
		"IBLOCK_ITEMS_COUNT" => "10",	// Количество элементов
	),
	false
); ?>
    <div>
<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "block1",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
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
        "COMPONENT_TEMPLATE" => "block1",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(0 => "", 1 => "",),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "4",
        "IBLOCK_TYPE" => "med_bit_ecommerce_s1",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MEDIA_PROPERTY" => "",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "20",
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
        "PROPERTY_CODE" => array(
	        0 => "",
	        1 => "ICONIMG",
	        2 => "",
        ),
        "SEARCH_PAGE" => "/search/",
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SLIDER_PROPERTY" => "",
        "SORT_BY1" => "SORT",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "ASC",
        "TEMPLATE_THEME" => "blue",
        "USE_RATING" => "N",
        "USE_SHARE" => "N"
    )
); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 no-pad col-xs-12 col-sm-12 heading-content elemnts-wrap wow">
                <? $APPLICATION->IncludeFile(
                    $APPLICATION->GetTemplatePath(SITE_DIR . "include/block2.php"),
                    Array(),
                    Array("MODE" => "html")
                ); ?>
            </div>
        </div>
    </div>
    <div class="mid-widgets-serices col-xs-12 col-sm-12 col-md-12 col-lg-12 no-pad services-page">
        <?
        $Filter['PROPERTY_INDEX_VALUE'] = "Yes";
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "block3",
            array(
                "COMPONENT_TEMPLATE" => "block3",
                "IBLOCK_TYPE" => "med_bit_ecommerce_s1",
                "IBLOCK_ID" => "16",
                "NEWS_COUNT" => "20",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "Filter",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "CODE_ICO",
                    1 => "INDEX",
                    2 => "ICONIMG",
                ),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => SITE_DIR . "services/#ELEMENT_CODE#/",
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
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
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
                "DISPLAY_DATE" => "N",
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
            ),
            false
        ); ?>
    </div>
    <!-- <div id="home-page-version-five">
        <div class="container">
            <div class="row">
                <div class="elements-box">
                    <p class="blockquote">
                    </p>

                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
                        <div>
                            <div
                                class="purchase-strip-blue pull-right col-sm-12 col-md-12 col-xs-12 notViewed wow medical-theme-block">
                                <div class="purchase-strip-text medical-website-theme">
                                    <? $APPLICATION->IncludeFile(
                                        $APPLICATION->GetTemplatePath(SITE_DIR . "include/block4.php"),
                                        Array(),
                                        Array("MODE" => "html")
                                    ); ?>
                                </div>
                                <div class="color-4">
                                    <p class="ipurchase-paragraph">
                                        <a href="/contact/#form"
                                           class="fa fa-calendar-o btn btn-4 btn-4a notViewed wow purchase-btn">
                                            <span style='font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;'>
                                                Оставить заявку
                                            </span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="container" id="homepage-long-version-two">
        <div class="row">
            <div class="intro-content-wrap">
                <div class=" top-padding bottom-padding">
                    <div class="col-xs-12 col-sm-12 hidden-md hidden-lg bottom-padding">
                        <div class="doctor-content-title">
                            <? $APPLICATION->IncludeFile(
                                $APPLICATION->GetTemplatePath(SITE_DIR . "include/doktor.php"),
                                Array(),
                                Array("MODE" => "html")
                            ); ?> <a href="<?= SITE_DIR ?>personal/" class="inner-page-butt-blue">Подробнее</a>
                        </div>
                        <!--doctor-content-title-->
                    </div>
                    <div class="row">
                        <?
                        $Filter['PROPERTY_INDEX_VALUE'] = "Yes";
                        $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "personal_index",
                            Array(
                                "COMPONENT_TEMPLATE" => "flat",
                                "IBLOCK_TYPE" => "med_bit_ecommerce_s1",
                                "IBLOCK_ID" => "9",
                                "NEWS_COUNT" => "3",
                                "SORT_BY1" => "SORT",
                                "SORT_ORDER1" => "ASC",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER2" => "ASC",
                                "FILTER_NAME" => "Filter",
                                "FIELD_CODE" => array(0 => "", 1 => "",),
                                "PROPERTY_CODE" => array(0 => "CODE_ICO", 1 => "",),
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
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
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
                                "DISPLAY_DATE" => "N",
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
                        ); ?>

                        <div class="hidden-xs hidden-sm col-md-4 col-lg-4">
                            <div class="doctor-content-title">
                                <? $APPLICATION->IncludeFile(
                                    $APPLICATION->GetTemplatePath(SITE_DIR . "include/doktor.php"),
                                    Array(),
                                    Array("MODE" => "html")
                                ); ?> <a href="<?= SITE_DIR ?>personal/" class="inner-page-butt-blue">Подробнее</a>
                            </div>
                            <!--doctor-content-title-->
                        </div>
                        <!--col-md-4-end-->
                    </div>
                </div>
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

    <div id="endpage-slider">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "endpage-slider",
            array(
                "COMPONENT_TEMPLATE" => "endpage-slider",
                "IBLOCK_TYPE" => "med_bit_ecommerce_s1",
                "IBLOCK_ID" => "20",
                "NEWS_COUNT" => "20",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array(
                ),
                "PROPERTY_CODE" => array(
                        "slider_image"
                ),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => SITE_DIR . "services/#ELEMENT_CODE#/",
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
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
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
                "DISPLAY_DATE" => "N",
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
            ),
            false
        ); ?>
    </div>
</div>
<?require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');?>