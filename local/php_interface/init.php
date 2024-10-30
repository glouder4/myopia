<?php
//Регистрируем обработчик именем функции будет IBFeedForm
AddEventHandler('iblock', 'OnBeforeIBlockElementAdd', 'IBFeedForm');
//Описываем функцию
function IBFeedForm(&$arFields)
{
    //Создаем переменные, внутри которых прописываем:
    $SITE_ID = 's1'; //Индетификатор сайта
    $IBLOCK_ID = 18; //Индетификатор инфоблока с новостями
    $EVEN_TYPE = 'SIDEBAR_FORM_SUBMITTED'; // Тип почтового события (создавали выше)

    if ($arFields['IBLOCK_ID'] == $IBLOCK_ID) {

        //Собираем в массив все данные, которые хотим передать в письмо
        //Перечисляем все поля как в почтовом событии
        $arFeedForm = array(

            //Стандартные поля инфоблока
            "NAME" => $arFields['PROPERTY_VALUES']['AUTHOR'],
            "EMAIL" => $arFields['PROPERTY_VALUES']['EMAIL'],
            "PHONE" => $arFields['PROPERTY_VALUES']['TEL'],
            "TEXT" => $arFields['PROPERTY_VALUES']['MESSAGE']['VALUE']['TEXT']
        );


        CEvent::Send($EVEN_TYPE, $SITE_ID, $arFeedForm );
    }
}