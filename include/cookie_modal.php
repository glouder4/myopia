<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)die();
if(!CModule::IncludeModule('firstbit.med')) {
    return;
}
$firstBit = new CFirstbitMedOptions();

?>
<a href="<?=$firstBit->queryOption('FIRSTBIT_MED_LEGAL');?>"><?=GetMessage("TMPL_LEGAL")?></a>
<script type='text/javascript'>	
		var cookiepopup = BX.PopupWindowManager.create("cookie-message", null, {
			content: '<h3>Cookie</h3><span><?=$firstBit->queryOption('FIRSTBIT_MED_LEGAL_CO_TEXT');?></span>'
			+'<i class="fa fa-times popup-window-close-icon" aria-hidden="true"></i>',
			darkMode: false,
			autoHide: false,
            className:'col-sm-6 col-xs-12 col-md-3 col-lg-3',
			offsetLeft: 0,
			  offsetTop: 0,
			  draggable: {restrict: false},
			  closeIcon: true,
			  buttons: [
               new BX.PopupWindowButton({
                  text: "Ок" ,
                  className: "inner-page-butt-blue" ,
                  events: {click: function(){
                     this.popupWindow.close();
                  }}
               }),
               new BX.PopupWindowButton({
                  text: "Подробнее" ,
                  className: "inner-page-butt-blue" ,
                  events: {click: function(){
                     location.href="<?=$firstBit->queryOption('FIRSTBIT_MED_LEGAL');?>";
                  }}
               })
            ]
		});
		BX.ready(function(){
		if(BX.getCookie('cookieagree')!='Y') {
			cookiepopup.show();
			BX.setCookie('cookieagree', 'Y', {expires: 'expires=Thu, 01 Jan 2048 00:00:00 UTC'});
		}
	});
</script>