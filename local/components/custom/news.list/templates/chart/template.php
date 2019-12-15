<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
?>

    <?
    $arrayChart="";
    foreach ($arResult["ITEMS"] as $arItem) {
        $arrayChart .= "['" . $arItem['NAME'] . "', " . $arItem['PROPERTIES']['HOTELI_BI_VI']['VALUE'] . ", " . $arItem['PROPERTIES']['SLISHAL']['VALUE'] . ", '" . $arItem['PROPERTIES']['VID']['VALUE'] . "', " . rand(31090763, 79716203) . "], \n";
    }
    ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawSeriesChart);

        function drawSeriesChart() {

            var data = google.visualization.arrayToDataTable([
                    ['Название', 'Хочу работать', 'Знаю', 'Вид', 'Запрлата'],
                    <?=$arrayChart?>
                ]
            );

            var options = {
                title: 'На графике отражены только компании с открытыми вакансиями. Размер круга отражает  среднюю зарплату, рассчитанную исходя из открытых вакансий',
                hAxis: {title: 'Популярность'},
                vAxis: {title: 'Узнаваемость'},
                bubble: {textStyle: {fontSize: 11}}
            };

            var chart = new google.visualization.BubbleChart(document.getElementById('series_chart_div'));
            chart.draw(data, options);
        }
    </script>

