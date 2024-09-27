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

				<ul class="nav nav-tabs col-md-4 col-sm-4 col-xs-5">
				<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
				 <li <?if(($element==$arItem['ID']) || ($element==$arItem['CODE'])){?>class="active"<?}elseif($element==false && $key==0 ){?>class="active"<?}?>><a href="<?=SITE_DIR?>departament/<?=$arItem['CODE']?>/"><i class="<?=strip_tags($arItem['DISPLAY_PROPERTIES']['CODE_ICO']['DISPLAY_VALUE'])?> dept-tabs-icon"></i><span class="tabs-heads"><?=$arItem['NAME_IMPLODE']?></span><i class="right-arr"></i></a></li>
				<?endforeach;?>
				</ul>
				
				
				
		

                <div class="tab-content col-md-8 col-sm-8 col-xs-7 pull-right">
				<?foreach($arResult["ITEMS"] as $key=>$arItem):
				?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>				

                 <div class="fade tab-pane <?if(($element==$arItem['ID']) || ($element==$arItem['CODE'])){?>active<?}elseif($element==false && $key==0 ){?>active<?}?> in" id="<?=$arItem['ID']?>">
                    <div class="dept-title-tabs"><?=$arItem['NAME']?></div>
                    <img alt="<?=$arItem['DETAIL_PICTURE']['ALT']?>" class="img-responsive" src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" />
                    <p id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?=$arItem['DETAIL_TEXT']?></p>  
					
					            <div class="table-elements">

                <table class="table table-bordered table-striped table-responsive">
                  <thead>
				  <?if($arItem['PROPERTIES']['ADRES']['VALUE'] || $arItem['PROPERTIES']['PHONE']['VALUE'] || $arItem['PROPERTIES']['EMAIL']['VALUE'] || $arItem['PROPERTIES']['SOC']['VALUE'] ){?>
				  <th colspan="2">
				  <?echo GetMessage("DEP_1")?>:
				  </th>
				  <?}?>
                  </thead>
                  <tbody>
				  <?if($arItem['PROPERTIES']['ADRES']['VALUE']){?>
                    <tr>
                      <td><?echo GetMessage("DEP_2")?>:</td>
                      <td><?=$arItem['PROPERTIES']['ADRES']['VALUE']?></td>
                    </tr>
					<?}?>
					<?if($arItem['PROPERTIES']['PHONE']['VALUE']){?>
                    <tr>
                      <td><?echo GetMessage("DEP_3")?></td>
                      <td><?=$arItem['PROPERTIES']['PHONE']['VALUE']?></td>
                    </tr>
					<?}?>
					<?if($arItem['PROPERTIES']['EMAIL']['VALUE']){?>
                    <tr>
                      <td><?echo GetMessage("DEP_4")?></td>
                      <td><?=$arItem['PROPERTIES']['EMAIL']['VALUE']?></td>
                    </tr>
					<?}?>
					<?if($arItem['PROPERTIES']['SOC']['VALUE']){?>
                    <tr>
                      <td><?echo GetMessage("DEP_5")?></td>
                      <td><?=$arItem['PROPERTIES']['SOC']['VALUE']?></td>
                    </tr>
					<?}?>
                  </tbody>
                </table>
            </div>
					
                 </div>





				<?endforeach;?>
				</div>
