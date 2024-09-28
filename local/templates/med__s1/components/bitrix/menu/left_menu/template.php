<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<?if (!empty($arResult)):?>
    <div class="catagory-list wow"  >
        <?if($arParams["TITLE_MENU"]):?>
            <div class="side-blog-title"><?=$arParams["TITLE_MENU"]?></div>
        <?endif?>
        <?if($arParams["TITLE_MENU"] === false):?>
            <div class="side-blog-title"><?=GetMessage("TITLE_MENU")?></div>
        <?endif?>
        <ul >

            <?
            foreach($arResult as $arItem):
                if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                    continue;
                ?>
                <?if($arItem["SELECTED"]):?>
                <li class="selected"><a href="<?=$arItem["LINK"]?>" class="selected"> <i class="fa fa-angle-right about-list-arrows"></i> <?=$arItem["TEXT"]?></a></li>
            <?else:?>
                <li><a href="<?=$arItem["LINK"]?>"><i class="fa fa-angle-right about-list-arrows"></i><?=$arItem["TEXT"]?></a></li>
            <?endif?>

            <?endforeach?>

        </ul>
    </div>
    <div style="padding: 0px 0px 25px 0;">
    </div>
<?endif?>


