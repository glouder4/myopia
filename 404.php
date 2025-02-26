<?php
http_response_code(404);
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("404 Not Found");
?>


    <div id="block404">
        <div class="text1">Ошибка 404</div>
        <div class="text2">Страница не найдена</div>
        <div class="col-xs-12 text3"><a href="/">Вернуться на главную</a></div>
    </div>
    <style type="text/css">
        #block404 .text1{
            text-align: center;
            font-size: 56px;
            color: #107fc9;
            line-height: 60px;
            font-weight: bold;
        }
        #block404 .text2 {
            text-align: center;
            font-size: 20px;
            line-height: 50px;
            font-weight: bold;
            color: #dcddde;
            margin-bottom: 30px;
        }
        #block404 .text3{
            text-align: center;
        }
        #block404 .text3 a {
            color: #363839;
            font-size: 16px;
            text-decoration: underline;
        }
    </style>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>