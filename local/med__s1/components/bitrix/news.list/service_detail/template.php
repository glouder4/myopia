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
$element = $_REQUEST['ELEMENT_ID'];
?>

				<div class="side-blog-title"><?=GetMessage("TITLE2")?></div>
				<ul class="nav nav-tabs col-md-4 col-sm-4 col-xs-5">
				<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
				 <li <?if(($element==$arItem['ID']) || ($element==$arItem['CODE'])){?>class="active 1"<?}elseif($element==false && $key==0 ){?>class="active 2"<?}?>><a href="<?=SITE_DIR?>services/<?=$arItem['CODE']?>/" ><i class="<?=$arItem['PROPERTIES']['CODE_ICO']['VALUE']?> dept-tabs-icon"></i><span class="tabs-heads"><?=$arItem['NAME_IMPLODE']?></span><i class="right-arr"></i></a></li>			
				<?endforeach;?>
				</ul>
				
				
				
		

                <div class="tab-content col-md-8 col-sm-8 col-xs-7 pull-right">
				<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>	


                 <div style="min-height:366px;" class="fade tab-pane <?if(($element==$arItem['ID']) || ($element==$arItem['CODE'])){?>active<?}elseif($element==false && $key==0 ){?>active<?}?> in" id="<?=$arItem['ID']?>">
                    <div class="dept-title-tabs"><?=$arItem['NAME']?></div>
                    <img alt="<?=$arItem['DETAIL_PICTURE']['ALT']?>" class="img-responsive" src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" />
                    <p id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?=$arItem['DETAIL_TEXT']?></p>    
				

				<?if(($element==$arItem['ID']) || ($element==$arItem['CODE'])){?>		
		<div class="row">
			<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 accordion-element">
				<div class="collapse-widget-side">
				<div id="imedica-dep-accordion" class="ui-accordion ui-widget ui-helper-reset" role="tablist">
				<?
				$len = sizeof($arItem['PRICE']); 
				foreach($arItem['PRICE'] as $Price):	
					--$len;
					?>


						    <h3 class="<?if(!$len) {?>last-child-ac ilast-child-acc<?}?> ui-state-default" id="ui-accordion-imedica-dep-accordion-header-<?=$Price['ID']?>"  aria-controls="ui-accordion-imedica-dep-accordion-panel-<?=$Price['ID']?>" aria-selected="true"><i class="collapse-cheveron"></i><span class="blog-collapse-title"><span class="col-1"><?=$Price['NAME']?> </span><span class="col-2"><?=$Price['PROPERTY_PRICE_VALUE']?> p.</span></span></h3>
                            <div id="ui-accordion-imedica-dep-accordion-panel-<?=$Price['ID']?>" aria-labelledby="ui-accordion-imedica-dep-accordion-header-<?=$Price['ID']?>" role="tabpanel" aria-expanded="true" aria-hidden="false">                         
                               <div class="collapse-widget-content pull-left">                                                            
                                <p><?=$Price['PREVIEW_TEXT']?></p>                        

                                </div>
                            </div>


				<?endforeach;?>
					</div>
				</div>
				</div>
				</div>	
				<?}elseif($element==false && $key==0){?>

		<div class="row">
			<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 accordion-element">
				<div class="collapse-widget-side">
				<div id="imedica-dep-accordion" class="ui-accordion ui-widget ui-helper-reset" role="tablist">
				<?
				$len = sizeof($arItem['PRICE']); 
				foreach($arItem['PRICE'] as $Price):	
					--$len;
					?>


						    <h3 class="<?if(!$len) {?>last-child-ac ilast-child-acc<?}?> ui-state-default" id="ui-accordion-imedica-dep-accordion-header-<?=$Price['ID']?>"  aria-controls="ui-accordion-imedica-dep-accordion-panel-<?=$Price['ID']?>" aria-selected="true"><i class="collapse-cheveron"></i><span class="blog-collapse-title"><span class="col-1"><?=$Price['NAME']?> </span><span class="col-2"><?=$Price['PROPERTY_PRICE_VALUE']?> p.</span></span></h3>
                            <div id="ui-accordion-imedica-dep-accordion-panel-<?=$Price['ID']?>" aria-labelledby="ui-accordion-imedica-dep-accordion-header-<?=$Price['ID']?>" role="tabpanel" aria-expanded="true" aria-hidden="false">                         
                               <?if($Price['PREVIEW_TEXT']==true){?><div class="collapse-widget-content pull-left">                                                            
                                <p><?=$Price['PREVIEW_TEXT']?></p>                        

                                </div>
							   <?}?>
                            </div>


				<?endforeach;?>
					</div>
				</div>
 			</div>
		</div>					
				<?}?>
                 </div>




				<?endforeach;?>
				</div>
