<?php
if(!defined('__TYPECHO_ADMIN__')) exit;

function Monitor($url){
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);
    $redis->select(1);
    $hour =$redis->get("hourViews")?$redis->get("hourViews"):0;
    $day =$redis->get("dayViews")?$redis->get("dayViews"):0;
    $week =$redis->get("weekViews")?$redis->get("weekViews"):0;
    $month =$redis->get("monthViews")?$redis->get("monthViews"):0;
    $year =$redis->get("yearViews")?$redis->get("yearViews"):0;
    $all =$redis->get("Views")?$redis->get("Views"):0;

    $mobile =$redis->get("mobileDevice")?$redis->get("mobileDevice"):0;
    $pc =$redis->get("pcDevice")?$redis->get("pcDevice"):0;

    $data= json_encode(array("view"=>array($hour,$day,$week,$month,$year,$all),"device"=>array($mobile,$pc)));
    echo "<script src='$url'></script><script> var monitorViews = $data;</script>";
}
Monitor($options->adminUrl.'js/echarts.min.js');