<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=> 9, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

// WEB_FORM_ID: 1
// form_text_1:
// form_text_2:
// form_text_3:
// form_text_4:
// form_textarea_5:
// web_form_submit: Сохранить
// web_form_apply: Y
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<form action="#" id="doctor-request">
    <div id="doctor-request-questions-list">
        <div id="select-doctor-question-wrapper">
            <div class="select">
                <input class="select__input" type="hidden" name="select-doctor">
                <div class="select__head">Выберите врача</div>
                <ul class="select__list" style="display: none;">
                    <?php
                        while($ob = $res->GetNextElement())
                        {
                            $arFields = $ob->GetFields();
                            ?>
                            <li class="select__item"><?=$arFields['NAME'];?></li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>

        <div id="doctor-request-fio-wrapper">
            <input type="text" name="fio"  class="form-input"value="" placeholder="Ф.И.О"/>
        </div>

        <div id="doctor-request-phone-wrapper">
            <input type="tel" name="phone" class="form-input" value="" placeholder="Телефон" />
        </div>

        <div id="doctor-request-email-wrapper">
            <input type="email" name="email" class="form-input" value="" placeholder="Email" />
        </div>

        <div id="doctor-request-comment-wrapper">
            <textarea name="comment" style="resize: none;"  class="form-input" placeholder="Комментарии"></textarea>
        </div>
    </div>

    <div id="doctor-request-endform-wrapper">
        <input type="submit" value="Отправить">

        <div id="doctor-request-checkbox">
            <input type="checkbox" /> <p>При отправке формы я принимаю условия <a href="#">Оферты</a> по использованию сайта и согласен с
                <a href="#">Политикой конфиденциальности</a></p>
        </div>
    </div>
</form>

<script>
    jQuery(($) => {
        $('.select').on('click', '.select__head', function () {
            if ($(this).hasClass('open')) {
                $(this).removeClass('open');
                $(this).next().fadeOut();
            } else {
                $('.select__head').removeClass('open');
                $('.select__list').fadeOut();
                $(this).addClass('open');
                $(this).next().fadeIn();
            }
        });

        $('.select').on('click', '.select__item', function () {
            $('.select__head').removeClass('open');
            $(this).parent().fadeOut();
            $(this).parent().prev().text($(this).text());
            $(this).parent().prev().prev().val($(this).text());
        });

        $(document).click(function (e) {
            if (!$(e.target).closest('.select').length) {
                $('.select__head').removeClass('open');
                $('.select__list').fadeOut();
            }
        });
    });
</script>