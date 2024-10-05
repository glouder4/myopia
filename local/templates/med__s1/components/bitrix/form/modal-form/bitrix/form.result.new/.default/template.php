<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=> 9, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<form action="#" id="doctor-request-modal">
    <input type="hidden" name="WEB_FORM_ID" value="<?=$arResult['arForm']['ID'];?>">
    <?=bitrix_sessid_post('csrf_token');?>
    <div id="doctor-request-modal-questions-list">

        <div id="doctor-request-modal-fio-wrapper">
            <input type="text" name="fio"  class="form-input"value="" placeholder="Ф.И.О"/>
        </div>

        <div id="doctor-request-modal-phone-wrapper">
            <input type="tel" name="phone" class="form-input" value="" placeholder="Телефон" />
        </div>

        <div id="doctor-request-modal-email-wrapper">
            <input type="email" name="email" class="form-input" value="" placeholder="Email" />
        </div>

        <div id="doctor-request-modal-comment-wrapper">
            <textarea name="comment" style="resize: none;"  class="form-input" placeholder="Комментарии"></textarea>
        </div>
    </div>

    <div id="doctor-request-modal-endform-wrapper">
        <input type="submit" value="Отправить">

        <div id="doctor-request-modal-checkbox">
            <label>
                <input type="checkbox" name="request-checkbox" />
            </label>
            <p>При отправке формы я принимаю условия <a href="#">Оферты</a> по использованию сайта и согласен с
                <a href="#">Политикой конфиденциальности</a></p>
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


    jQuery(document).ready(function($){
        $('#doctor-request-modal').submit(function (e){
            e.preventDefault();

            let web_form_id = $(this).find('input[name="WEB_FORM_ID"]').val();
            let csrf_token = $(this).find('input[name="csrf_token"]').val();

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
                        fio: fio,
                        phone: phone,
                        email: email,
                        comment: comment
                    },
                    success: function(data){

                        $('#doctor-request-modal .success-alert-wrapper').fadeIn();

                        setTimeout(function (){
                            $('#doctor-request-modal .success-alert-wrapper').fadeOut();
                        },2000);

                        $("#doctor-request-modal")[0].reset();
                    }
                });
            }
        })

        $('#doctor-request-modal input[name="phone"]').mask('+7 (999) 999-99-99');
    })
</script>