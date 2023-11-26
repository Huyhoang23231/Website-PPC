<?php
$serverName = "MSI\SQLEXPRESS";
$connectionOptions = array(
    "Database" => "QUANLYBDS_TEAM030104",
    "Uid" => "sa",
    "PWD" => "123456",
    "CharacterSet" => "UTF-8"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
} else {
    $connectionMessage = "Kết nối thành công!";
}
?>