<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=> 9, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

if (CModule::IncludeModule("firstbit.med")):
    $legal_link = CFirstbitMedOptions::queryOption('FIRSTBIT_MED_LEGAL');
    $offer_link = CFirstbitMedOptions::queryOption('FIRSTBIT_MED_OFFER');
endif;
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<form action="#" id="doctor-request">
    <input type="hidden" name="WEB_FORM_ID" value="<?=$arResult['arForm']['ID'];?>">
    <?=bitrix_sessid_post('csrf_token');?>
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
            <label>
                <input type="checkbox" name="request-checkbox" />
            </label>
            <p>При отправке формы я принимаю условия <a href="<?=$legal_link?>">Оферты</a> по использованию сайта и согласен с
                <a href="<?=$offer_link?>">Политикой конфиденциальности</a></p>
        </div>
    </div>

    <div class="success-alert-wrapper" style="display: none;">
        <div class="success-checkmark">
            <div class="check-icon">
                <span class="icon-line line-tip"></span>
                <span class="icon-line line-long"></span>
                <div class="icon-circle"></div>
                <div class="icon-fix"></div>
            </div>
        </div>

        <div class="success-data">
            <p>Форма успешно отправлена</p>
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


    jQuery(document).ready(function($){
        $('#doctor-request').submit(function (e){
            e.preventDefault();

            let web_form_id = $(this).find('input[name="WEB_FORM_ID"]').val();
            let csrf_token = $(this).find('input[name="csrf_token"]').val();

            let doctorName = $(this).find('input[name="select-doctor"]').val();
            let fio = $(this).find('input[name="fio"]').val();
            let phone = $(this).find('input[name="phone"]').val();
            let email = $(this).find('input[name="email"]').val();
            let comment = $(this).find('textarea[name="comment"]').val();

            let checkbox = $(this).find('input[type="checkbox"]');


            if( checkbox[0].checked ){
                $.ajax({
                    url: '<?=SITE_TEMPLATE_PATH?>/ajax.php',
                    method: 'post',
                    dataType: 'json',
                    data: {
                        csrf_token: csrf_token,
                        web_form_id: web_form_id,
                        doctorName: doctorName,
                        fio: fio,
                        phone: phone,
                        email: email,
                        comment: comment
                    },
                    success: function(data){

                        $('#doctor-request .success-alert-wrapper').fadeIn();

                        setTimeout(function (){
                            $('#doctor-request .success-alert-wrapper').fadeOut();
                        },2000);

                        $("#doctor-request")[0].reset();
                    }
                });
            }
        })

        $('#doctor-request input[name="phone"]').mask('+7 (999) 999-99-99');
    })
</script>