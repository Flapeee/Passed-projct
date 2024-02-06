<?php
include_once 'connectMysql.php';
include_once 'data.php';

$sql = "select * from products";
$res = $conn->query($sql);
$frontFlag = -1;
$categoryNum = 0;
$svgEnd = '</svg></div>';
while ($row = mysqli_fetch_array($res)) {
    $product_id = $row['product_id'];
    $product_svg = $imageMapSvg[$product_id];
    $categoryNum = (int)($product_id / 1000);
    if ($categoryNum - $frontFlag == 1) {
        echo $svgEnd;
    }
    $foodCategory = $imageMapSvgCategory[$categoryNum];
    $svgFront = '<div id="' . $foodCategory . '" style="display: none;"><img src="imagemap/' . $foodCategory . '.png" alt="image_map" style="width: 100%;">
                <svg class="imageMapSvg" viewBox="0 0 637 570">';
    if ($frontFlag != $categoryNum) {
        echo $svgFront;
        $frontFlag = $categoryNum;
    }
    echo $product_svg;
}
echo $svgEnd;
?>