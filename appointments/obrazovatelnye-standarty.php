<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Образовательные стандарты");
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

            <?$APPLICATION->IncludeComponent("bit-ecommerce:iblock.element.add.form", "artmax-default", Array(
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
                "EVENT_MESSAGE_ID" => "",	// Почтовые шаблоны(по умолчанию используются все)
                "GROUPS" => array(
                    0 => "2",
                ),
                "IBLOCK_ID" => "18",	// Инфоблок
                "IBLOCK_TYPE" => "med_bit_ecommerce_s1",	// Тип инфоблока
                "EVENT_NAME" => "FEEDBACK_FORM_MAIN",	// Тип почтовых событий
                "LEVEL_LAST" => "N",
                "LIST_URL" => "",
                "MAX_FILE_SIZE" => "0",
                "MAX_LEVELS" => "100000",
                "MAX_USER_ENTRIES" => "100000",
                "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
                "PROPERTY_CODES" => array(	// Свойства, выводимые на редактирование
                    0 => "AUTHOR",
                    1 => "EMAIL",
                    2 => "MESSAGE",
                    3 => "TEL",
                ),
                "PROPERTY_CODES_REQUIRED" => array(	// Свойства, обязательные для заполнения
                    0 => "AUTHOR",
                    1 => "EMAIL",
                    2 => "MESSAGE",
                ),
                "RESIZE_IMAGES" => "Y",
                "SEF_MODE" => "N",
                "STATUS" => "INACTIVE",
                "STATUS_NEW" => "NEW",	// Деактивировать элемент
                "TITLE_ELEMENT" => "Обратная связь из левой колонки",
                "USER_MESSAGE_ADD" => "Ваша завка успешно отправлена",	// Сообщение об успешном добавлении
                "USER_MESSAGE_EDIT" => "Saved",
                "USE_CAPTCHA" => "N",	// Использовать CAPTCHA
            ),
                false
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

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>