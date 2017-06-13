<?php

// 定义Transmit中转服务器支持的客户端类型...
define('kClientPHP',          1);
define('kClientGather',       2);
define('kClientLive',         3);  // RTMPAction
define('kClientPlay',         4);  // RTMPAction

// 定义Transmit中转服务器反馈错误号...
define('ERR_OK',                      0);
define('ERR_NO_SOCK',             10001);
define('ERR_NO_GATHER',           10002);
define('ERR_SOCK_SEND',           10003);
define('ERR_NO_JSON',             10004);

// 定义Transmit服务器可以执行的命令列表...
define('kCmd_Gather_Login',           1);
define('kCmd_PHP_Get_Camera_Status',  2);
define('kCmd_PHP_Set_Camera_Name',    3);
define('kCmd_PHP_Set_Course_Add',     4);
define('kCmd_PHP_Set_Course_Mod',     5);
define('kCmd_PHP_Set_Course_Del',     6);
define('kCmd_PHP_Get_Gather_Status',  7);
define('kCmd_PHP_Get_Course_Record',  8);
define('kCmd_Live_Vary',              9);
define('kCmd_Play_Login',            10);

//phpinfo();

/*$tracker = fastdfs_tracker_get_connection();
var_dump($tracker);
var_dump(fastdfs_tracker_list_groups());

$server = fastdfs_connect_server($tracker['ip_addr'], $tracker['port']); 
var_dump($server);
var_dump(fastdfs_disconnect_server($server));
var_dump($server);

var_dump(fastdfs_tracker_query_storage_store_list());*/

/*$version = fastdfs_client_version();
var_dump($version);

$tracker = fastdfs_tracker_get_connection();
var_dump($tracker);

var_dump(fastdfs_active_test($tracker));

// A: $array_transmit = transmit_connect_server($ip_addr, $ip_port);
$server = fastdfs_connect_server($tracker['ip_addr'], $tracker['port']); 
var_dump($server);

// B: $array_transmit = transmit_get_command($cmd, $gather_mac, $array_data);
var_dump(fastdfs_disconnect_server($server));
var_dump($server);

var_dump(fastdfs_disconnect_server($tracker));
var_dump($tracker);*/

// A: array  transmit_connect_server(string ip_addr, int port)
$transmit = transmit_connect_server("192.168.1.180", 21001);
var_dump($transmit);

// C: string transmit_get_command(int cmd, string gather_mac, array server_info)
/*
$dbCamera[0] = 4;
$dbCamera['mac_addr'] = "00-18-F3-91-F5-07";
$saveJson = json_encode($dbCamera);
$json_data = transmit_command(kClientPHP, kCmd_PHP_Get_Camera_Status, $transmit, $saveJson);
var_dump($json_data);
if( $json_data ) {
  $arr_data = json_decode($json_data, true);
  var_dump($arr_data);
}
// D: string transmit_set_command(int cmd, string gather_mac, array server_info, string saveJson)
$dbCamera['camera_id'] = 4;
$dbCamera['camera_name'] = "初中 三年级 三班";
$dbCamera['mac_addr'] = "00-18-F3-91-F5-07";
$saveJson = json_encode($dbCamera);
$json_data = transmit_command(kClientPHP, kCmd_PHP_Set_Camera_Name, $transmit, $saveJson);
var_dump($json_data);
if( $json_data ) {
  $arr_data = json_decode($json_data, true);
  var_dump($arr_data);
}*/

// add course...
/*$dbCourse['course_id'] = 3;
$dbCourse['camera_id'] = 4;
$dbCourse['subject_id'] = 1;
$dbCourse['teacher_id'] = 2;
$dbCourse['repeat_id'] = 0;
$dbCourse['elapse_sec'] = 3600;
$dbCourse['start_time'] = strtotime('2017-04-25 22:30:30');
$dbCourse['end_time'] = strtotime('2017-04-25 23:30:30');
$dbCourse['mac_addr'] = "00-18-F3-91-F5-07";
$saveJson = json_encode($dbCourse);
$json_data = transmit_command(kClientPHP, kCmd_PHP_Set_Course_Add, $transmit, $saveJson);
var_dump($json_data);
if( $json_data ) {
  $arr_data = json_decode($json_data, true);
  var_dump($arr_data);
}

// modify course...
$dbCourse['course_id'] = 3;
$dbCourse['camera_id'] = 4;
$dbCourse['subject_id'] = 2;
$dbCourse['teacher_id'] = 3;
$dbCourse['repeat_id'] = 1;
$dbCourse['elapse_sec'] = 1800;
$dbCourse['start_time'] = strtotime('2017-04-25 22:30:30');
$dbCourse['end_time'] = strtotime('2017-04-25 23:00:30');
$dbCourse['mac_addr'] = "00-18-F3-91-F5-07";
$saveJson = json_encode($dbCourse);
$json_data = transmit_command(kClientPHP, kCmd_PHP_Set_Course_Mod, $transmit, $saveJson);
var_dump($json_data);
if( $json_data ) {
  $arr_data = json_decode($json_data, true);
  var_dump($arr_data);
}

// delete course => must set 'course_id' and 'camera_id'...
$dbXCourse['course_id'] = 3;
$dbXCourse['camera_id'] = 4;
$dbXCourse['mac_addr'] = "00-18-F3-91-F5-07";
$saveJson = json_encode($dbXCourse);
$json_data = transmit_command(kClientPHP, kCmd_PHP_Set_Course_Del, $transmit, $saveJson);
var_dump($json_data);
if( $json_data ) {
  $arr_data = json_decode($json_data, true);
  var_dump($arr_data);
}*/

$dbLive['rtmp_addr'] = sprintf("%s:%d", "192.168.1.180", 1935);
$dbLive['rtmp_user'] = 0;
$saveJson = json_encode($dbLive);
$json_data = transmit_command(kClientLive, kCmd_Live_Vary, $transmit, $saveJson);
var_dump($json_data);
if( $json_data ) {
  $arr_data = json_decode($json_data, true);
  var_dump($arr_data);
}

// B: bool   transmit_disconnect_server(array serverInfo)
var_dump(transmit_disconnect_server($transmit));
var_dump($transmit);

?>
