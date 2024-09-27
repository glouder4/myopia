<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
CUtil::InitJSCore(array('fx'));
CJSCore::Init(Array("viewer"));

?>
<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 pull-left doctors-3col-tabs no-pad" id="<?=$this->GetEditAreaId($arResult['ID']);?>">
           
           		
            <div class="content-tabs tabs col-xs-12 col-sm-12">
			
			          <ul class="nav nav-tabs tab-acc" id="myTab">
					    <li <?if(!$_REQUEST['SECTION_ID']){?>class="active"<?}?>><a href="<?=SITE_DIR?>personal/" ><?=GetMessage("VSE")?></a></li>
					  <?foreach($arResult["SECTION"] as $i=>$arItem):?>
                        <li <?if($_REQUEST['SECTION_ID']==$arItem['ID']){?>class="active"<?}?>><a href="<?=SITE_DIR?>personal/<?=$arItem['ID']?>/" ><?=$arItem['NAME']?></a></li>
					  <?endforeach;?>
                      </ul>	
			
			</div>
			
			
			
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 doctor-box" >
                        
                        	<div>                          
                        	<?if($arResult['DETAIL_PICTURE']['SRC']){?><img alt="" class="img-responsive" src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" /><?}?>
                          </div>
                      	<div class="doc-name">
                          <?/*   fix issue 57.16
						   <div class="doc-name-class"><?=$arResult['IBLOCK_SECTION_NAME']?></div>
						   */?>
						   <span class="doc-title"><?=$arResult['NAME']?></span>
                          	<hr />
                          	<p><?=$arResult['DISPLAY_PROPERTIES']['STR_SPECIAL']['DISPLAY_VALUE'] ? $arResult['DISPLAY_PROPERTIES']['STR_SPECIAL']['DISPLAY_VALUE'] : $arResult['~PREVIEW_TEXT']?></p>
                          	<div class='clinic_block'>
                          		<?=$arResult['DISPLAY_PROPERTIES']['IB_CLINIC']['DISPLAY_VALUE']?>
                          	</div>
                          	<?
                          		$APPLICATION->IncludeComponent('bit-ecommerce:shedule','',array('INNER'=>true,'DOCTOR_ID'=>$arResult['ID']),$component);
                          	?>
                          </div>
            </div>	
      
			<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 column-element">

                <h3><?=$arResult['NAME']?></h3>
                <p><?=$arResult['DETAIL_TEXT']?></p>
                  
            </div>
			<?
			if($arResult['PROPERTIES']['SERTIFIKATE']['VALUE'] == true){
			?>

			<div class="row">
			<div class="medical-theme-block col-md-12 col-sm-12 col-lg-12 col-xs-12 column-element" id="db-items">
            <h3 class="col-xs-12"><?=$arResult['PROPERTIES']['SERTIFIKATE']['NAME']?></h3>
			
			<?foreach($arResult['PROPERTIES']['SERTIFIKATE']['VALUE'] as $Sertificate):?>
			<div class="zoom-wrap">
			<img
			onload="this.parentNode.className='feed-com-img-wrap';"   
            data-bx-viewer="image" 
            data-bx-src="<?=CFile::GetPath ($Sertificate)?>?>" 
            data-bx-width="448" 
            data-bx-height="300" 
			class="img-responsive" src="<?=CFile::GetPath ($Sertificate)?>?>"  >
			</div>
			<?endforeach?>
			<div class="clear"></div>
      </div></div>

      
			<?}?>
			
		</div></div>

<script>
BX.ready(function(){
   var obImageView = BX.viewElementBind(
      'db-items',
      {showTitle: true, lockScroll: false},
      function(node){
         return BX.type.isElementNode(node) && (node.getAttribute('data-bx-viewer') || node.getAttribute('data-bx-image'));
      }
   );
});
</script>