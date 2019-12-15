<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

?><?php

use Bitrix\Main\Loader;
Loader::includeModule("iblock");

$slishal = preg_grep("/[^\s]*SLISHAL[^\s]*/", array_keys($_POST));
$hoteli_bi_vi = preg_grep("/[^\s]*HOTELI_BI_VI[^\s]*/", array_keys($_POST));

foreach ($hoteli_bi_vi as $item){
$id = preg_replace("/[^0-9]/", '', $item);

    $actualValue = CIBlockElement::GetProperty(2, $id, false, false, ['ID' => '27'])->fetch();
    $newValue = $actualValue['VALUE'] +1;
    CIBlockElement::SetPropertyValues($id, 2, $newValue, 'HOTELI_BI_VI');
}

foreach ($slishal as $item2){
    $id2 = preg_replace("/[^0-9]/", '', $item2);
    $actualValue2 = CIBlockElement::GetProperty(2, $id2, false, false, ['ID' => '26'])->fetch();
    $newValue2 = $actualValue2['VALUE'] +1;
    CIBlockElement::SetPropertyValues($id2, 2, $newValue2, 'SLISHAL');
}
?>
<h4>Ваш голос учтен</h4>
<br>
<br>
<br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
