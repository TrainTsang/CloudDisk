<?php
/**
 * Created by PhpStorm.
 * User: Train
 * Date: 2017/9/28
 * Time: 12:20
 */


$dir = empty($_REQUEST["dir"]) ? __DIR__ : $_REQUEST["dir"];

function getfiles($path)
{
    $file = [];
    $tmp = [];
    foreach (scandir($path) as $afile) {
        if ($afile == '.' || $afile == '..' || $afile == '.idea' || strpos($afile, '.php') || strpos($afile, '.html')) continue;//这里可以吧要过滤的文件写上
        if (is_dir($path . '/' . $afile)) {
            $tmp['type'] = 'dir';
        } else if (is_file($path . '/' . $afile)) {
            $tmp['type'] = 'file';
        }
        $tmp['dirtext'] = $path . '/' . $afile;
        $tmp['filename'] = $afile;
        $tmp['dirtext2'] = str_replace(__DIR__ . '/', '', $path . '/' . $afile);
        $file[] = $tmp;
    }
    $data = [
        'Code' => 200,
        'CountNum' => count($file),
        'List' => $file
    ];
    returnAjax($data);
}

getfiles($dir);

function returnAjax($data)
{
    header('Content-type:text/json');
    echo json_encode($data);
    exit;
}