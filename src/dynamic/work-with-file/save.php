<?php

function download_file($fileName) {
    $array = explode('.', $fileName);
    header("Content-disposition: attachment; filename=" . $fileName);
    header("Content-type: application/".$array[2]);
    readfile($fileName);
}
