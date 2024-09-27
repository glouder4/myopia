<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$curPage = $APPLICATION->GetCurPage(true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <?
    CUtil::InitJSCore(array('fx'));
    CJSCore::Init(Array("viewer"));
    CJSCore::Init(array('jquery'));
    $APPLICATION->addHeadString('<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,300" >');
    $APPLICATION->addHeadString('<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic" >');
    $APPLICATION->addHeadString('<link rel="stylesheet" type="text/css" href="' . SITE_TEMPLATE_PATH . '/css/jquery-ui-1.10.3.custom.css" >');
    $APPLICATION->addHeadString('<link rel="stylesheet" type="text/css" href="' . SITE_TEMPLATE_PATH . '/css/animate.css" >');
    $APPLICATION->addHeadString('<link rel="stylesheet" type="text/css" href="' . SITE_TEMPLATE_PATH . '/css/font-awesome.min.css" >');
    ?>
    <? $APPLICATION->addHeadString('<!--[if IE 9]>  <link rel="stylesheet" type="text/css" href="' . SITE_TEMPLATE_PATH . '/css/ie9.css" ><![endif]--> '); ?>
    <? IncludeTemplateLangFile(__FILE__); ?>
    <? $APPLICATION->ShowHead(); ?>
	<?
	$APPLICATION->addHeadString('<link rel="stylesheet" type="text/css" href="' . SITE_TEMPLATE_PATH . '/rs-plugin/css/settings.min.css" >');
	$APPLICATION->addHeadString('<link rel="stylesheet" type="text/css" href="' . SITE_TEMPLATE_PATH . '/css/slides.css" >');
	$APPLICATION->addHeadString('<link rel="stylesheet" type="text/css" href="' . SITE_TEMPLATE_PATH . '/css/inline.min.css" >');
	?>
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <link rel="shortcut icon" type="image/png" href="<?= SITE_TEMPLATE_PATH ?>/images/faivcon.png"/>
</head>
<body>

<div id="panel">
    <? $APPLICATION->ShowPanel(); ?>
</div>
<header>

    <div class="header-bg">
        <div id="search-overlay">
            <div class="container">
                <div id="close">X</div>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:search.form",
                    "search",
                    Array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "PAGE" => "/search/index.php",
                        "USE_SUGGEST" => "N"
                    )
                ); ?>
            </div>
        </div>


        <!--Topbar-->
        <div class="topbar-info no-pad">
            <div class="container">
                <div class="social-wrap-head col-md-3 no-pad">
                    <?
                    $facebookLink = $APPLICATION->GetFileContent($_SERVER["DOCUMENT_ROOT"]."/include/socnet_facebook.php");
                    $twitterLink = $APPLICATION->GetFileContent($_SERVER["DOCUMENT_ROOT"]."/include/socnet_twitter.php");
                    $googlePlusLink = $APPLICATION->GetFileContent($_SERVER["DOCUMENT_ROOT"]."/include/socnet_google.php");
                    $linkedinLink = $APPLICATION->GetFileContent($_SERVER["DOCUMENT_ROOT"] ."/include/socnet_linkedin.php");
                    $rssLink = $APPLICATION->GetFileContent($_SERVER["DOCUMENT_ROOT"] ."/include/socnet_rss.php");
                    ?>
                    <ul>
                        <? if ($facebookLink): ?>
                            <li><? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/include/socnet_facebook.php"), false); ?></li>
                        <? endif ?>
                        <? if ($twitterLink): ?>
                            <li><? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/include/socnet_twitter.php"), false); ?></li>
                        <? endif ?>
                        <? if ($googlePlusLink): ?>
                            <li><? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/include/socnet_google.php"), false); ?></li>
                        <? endif ?>
                        <? if ($twitterLink): ?>
                            <li><? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/include/socnet_linkedin.php"), false); ?></li>
                        <? endif ?>
                        <? if ($rssLink): ?>
                            <li><? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/include/socnet_rss.php"), false); ?></li>
                        <? endif ?>
                    </ul>
                </div>
                <div class="top-info-contact pull-right col-md-9">
                    <?= GetMessage("TMPL_CONTACT") ?>
                    <? $APPLICATION->IncludeFile(
                        $APPLICATION->GetTemplatePath("/include/kontakt_tel_header.php"),
                        Array(),
                        Array("MODE" => "html")
                    ); ?>
                    |
                    <? $APPLICATION->IncludeFile(
                        $APPLICATION->GetTemplatePath("/include/kontakt_mail_header.php"),
                        Array(),
                        Array("MODE" => "html")
                    ); ?>
                    <? $APPLICATION->IncludeComponent("bit-ecommerce:visually.impaired","",Array()); ?>
                    <div id="search" class="fa fa-search search-head"></div>
	                <div class="auth_panel">
		                <?
		                global $USER;
		                $userFname = $USER->GetFirstName();
		                $userLname = $USER->GetLastName();
		                ?>
		                <?if (!$USER->IsAuthorized()) { ?>
			                <a href="/login/" id="login-link" class="fancybox.ajax Link Menu__Link">
				                <i class="fa fa-user" aria-hidden="true" style="margin-right: 5px;"></i>
				                <span><?= GetMessage("TMPL_LOGIN") ?></span>
			                </a> |
			                <a href="/login/?register=yes&backurl=%2F" id="register-link" class="fancybox.ajax Link Menu__Link">
				                <span><?= GetMessage("TMPL_REGISTER") ?></a></span>
		                <? } else { ?>
			                <a class="Link Menu__Link Link_icon" href="/account/" style="margin-left: 30px;">
				                <i class="fa fa-user" aria-hidden="true" style="margin-right: 5px;"></i>
				                <?if(strlen($userFname)<=0 || strlen($userLname)<=0):?>
					                <span><?=$USER->GetEmail();?></span>
				                <?else:?>
					                <span><?=$userLname.' '.substr($userFname, 0, 1).'.'; ?></span>
				                <?endif;?>
			                </a>
			                <ul class="auth_panel_submenu">
				                <li><a href="/?logout=yes&sessid=<?=bitrix_sessid()?>"><?= GetMessage("TMPL_LOGOUT") ?></a></li>
			                </ul>
		                <? } ?>
	                </div>
                </div>

            </div>
        </div>
        <!--Topbar-info-close-->


        <? $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "top_menu",
            array(
                "COMPONENT_TEMPLATE" => "top_menu",
                "ROOT_MENU_TYPE" => "top",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => array(),
                "MAX_LEVEL" => "2",
                "CHILD_MENU_TYPE" => "left",
                "USE_EXT" => "N",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N",
                "MENU_THEME" => "site"
            ),
            false
        ); ?>
        <div class="hide-mid navbar-collapse option-drop collapse in" id="bs-example-navbar-collapse-2"
             style="height: auto;">


            <ul class="nav navbar-nav navbar-right other-op">
	            <li>
		            <div class="auth_panel">
			            <?
			            global $USER;
			            $userFname = $USER->GetFirstName();
			            $userLname = $USER->GetLastName();
			            ?>
			            <?if (!$USER->IsAuthorized()) { ?>
				            <a href="/login/" id="login-link" class="fancybox.ajax Link Menu__Link">
					            <i class="fa fa-user" aria-hidden="true" style="margin-right: 5px;"></i>
					            <span><?= GetMessage("TMPL_LOGIN") ?></span>
				            </a> |
				            <a href="/login/?register=yes&backurl=%2F" id="register-link" class="fancybox.ajax Link Menu__Link">
					            <span><?= GetMessage("TMPL_REGISTER") ?></a></span>
			            <? } else { ?>
				            <a class="Link Menu__Link Link_icon" href="/account/" style="margin-left: 30px;">
					            <i class="fa fa-user" aria-hidden="true" style="margin-right: 5px;"></i>
					            <?if(strlen($userFname)<=0 || strlen($userLname)<=0):?>
						            <span><?=$USER->GetEmail();?></span>
					            <?else:?>
						            <span><?=$userLname.' '.substr($userFname, 0, 1).'.'; ?></span>
					            <?endif;?>
				            </a>
				            <ul class="auth_panel_submenu">
					            <li><a href="/?logout=yes&sessid=<?=bitrix_sessid()?>"><?= GetMessage("TMPL_LOGOUT") ?></a></li>
				            </ul>
			            <? } ?>
		            </div>
	            </li>
                <li>
                    <i class="fa fa-phone icon-phone2"></i>
                    <? $APPLICATION->IncludeFile($APPLICATION->GetTemplatePath("/include/kontakt_tel_header.php"), Array(), Array("MODE" => "html")); ?>
                </li>
                <li>
                    <i class="fa fa-envelope icon-mail"></i>
                    <? $APPLICATION->IncludeFile($APPLICATION->GetTemplatePath("/include/kontakt_mail_header.php"), Array(), Array("MODE" => "html")); ?>
                </li>

                <li><i class="fa fa-globe icon-globe"> </i>
                    <? if ($facebookLink): ?>
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/include/socnet_facebook.php"), false); ?>
                    <? endif ?>
                    <? if ($twitterLink): ?>
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/include/socnet_twitter.php"), false); ?>
                    <? endif ?>
                    <? if ($googlePlusLink): ?>
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/include/socnet_google.php"), false); ?>
                    <? endif ?>
                    <? if ($twitterLink): ?>
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/include/socnet_linkedin.php"), false); ?>
                    <? endif ?>
                </li>
                <li><i class="fa fa-search icon-search"></i>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:search.form",
                        "search_2",
                        Array(
                            "COMPONENT_TEMPLATE" => ".default",
                            "PAGE" => "/search/index.php",
                            "USE_SUGGEST" => "N"
                        )
                    ); ?>
                </li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
</header>
<div class="complete-content <? if ($curPage != SITE_DIR . "index.php") { ?> content-footer-space <? } ?>">
    <? if ($curPage != SITE_DIR . "index.php"){ ?>
    <div class="about-intro-wrap pull-left">
        <div class="bread-crumb-wrap ibc-wrap-<?= rand('1', '6') ?>">
            <div class="container">
                <!--Title / Beadcrumb-->
                <div class="inner-page-title-wrap col-xs-12 col-md-12 col-sm-12">
                    <div class="bread-heading"><h1><?= $APPLICATION->ShowTitle(false); ?></h1></div>

                    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "med", Array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "START_FROM" => "0",
                        "PATH" => "",
                        "SITE_ID" => "#SITE_ID#",
                    ),
                        false
                    ); ?>

                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 dept-tabs-wrap wow animated">
                    <div class="tabbable tabs-left">
                        <? } ?>