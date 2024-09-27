<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($_REQUEST['ajax']=='y'&&isset($_REQUEST['id'])) {

	$GLOBALS['APPLICATION']->RestartBuffer();
	$el = new CIBlockElement;
	if(!$el->Update($_REQUEST['id'], Array("ACTIVE" => "N","XML_ID"=>'canceled')))
	{
		echo 'Error!';
		die();
	}
	else {
		echo 'yes';
		die();
	}

}
?>