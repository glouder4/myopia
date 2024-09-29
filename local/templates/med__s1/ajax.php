<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

CModule::IncludeModule("form");
if( isset($_POST['csrf_token']) ){
    $web_form_id = $_POST['web_form_id'];

    if( check_bitrix_sessid('csrf_token') ){
        $doctorName = $_POST['doctorName'];
        $fio = $_POST['fio'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];

        $fields = [
            'form_text_1' => $doctorName,
            'form_text_2' => $fio,
            'form_text_3' => $phone,
            'form_text_4' => $email,
            'form_textarea_5' => $comment
        ];

        $formErrors = CForm::Check($web_form_id, $fields, false, "N", 'Y');

        // Если не все обязательные поля заполнены
        if (count($formErrors)) {
            echo json_encode(['success' => false, 'errors' => $formErrors, 'data' => []]);
        } elseif ($RESULT_ID = CFormResult::Add($web_form_id, $fields)) {

            // Отправляем все события как в компоненте веб форм
            CFormCRM::onResultAdded($web_form_id, $RESULT_ID);
            CFormResult::SetEvent($RESULT_ID);
            CFormResult::Mail($RESULT_ID);

            // говорим что успешно заявку получили
            echo json_encode(['success' => true, 'errors' => [], 'data' => ['result_id' => $RESULT_ID]]);
        } else {
            // Какие-то еще ошибки произошли
            echo json_encode(['success' => false, 'errors' => $GLOBALS["strError"], 'data' => []]);
        }
    } else {
        // Предотвратили CSRF атаку
        echo json_encode(['success' => false, 'errors' => ['sessid' => 'Не верная сессия. Попробуйте обновить страницу'], 'data' => []]);
    }

}

// Файл ниже подключать обязательно, там закрытие соединения с базой данных
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';