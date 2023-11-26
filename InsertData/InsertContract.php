<?php

// Kết nối đến cơ sở dữ liệu
require_once(__DIR__.'/../Database/connect.php');



// Kiểm tra xem kết nối thành công hay không
if ($conn) {
    echo "Kết nối đến cơ sở dữ liệu thành công.<br>";
} else {
    die(print_r(sqlsrv_errors(), true));
}


function generateContractCode($conn) {
    // Lấy số thứ tự mới từ bảng 'Full_Contract_Code'
    $query = "SELECT MAX(CAST(SUBSTRING(Full_Contract_Code, 13, 4) AS INT)) AS SoThuTuMoi FROM Full_Contract";
    $result = sqlsrv_query($conn, $query);
    
    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    $soThuTuMoi = $row['SoThuTuMoi'];

    // Tạo mã mới dựa trên cấu trúc và số thứ tự mới
    $newContractCode = "FCC-" . date("ymd") . "-" . str_pad($soThuTuMoi, 4, '0', STR_PAD_LEFT);

    return $newContractCode;
}


// Lấy dữ liệu từ biến POST
$customerName = isset($_POST['Customer_Name']) ? $_POST['Customer_Name'] : null;
$yearOfBirth = isset($_POST['Year_Of_Birth']) ? $_POST['Year_Of_Birth'] : null;
$ssn = isset($_POST['SSN']) ? $_POST['SSN'] : null;
$customerAddress = isset($_POST['Customer_Address']) ? $_POST['Customer_Address'] : null;
$mobile = isset($_POST['Mobile']) ? $_POST['Mobile'] : null;
$propertyID = isset($_POST['Property_ID']) ? $_POST['Property_ID'] : null;
$dateOfContract = isset($_POST['Date_Of_Contract']) ? $_POST['Date_Of_Contract'] : null;
$price = isset($_POST['Price']) ? $_POST['Price'] : null;
$deposit = isset($_POST['Deposit']) ? $_POST['Deposit'] : null;
$remain = isset($_POST['Remain']) ? $_POST['Remain'] : null;
$status = isset($_POST['Status']) ? $_POST['Status'] : null;

// Kiểm tra nếu trường SSN không được để trống
if ($ssn === '') {
    die("Giá trị SSN không được để trống.");
}

// Tạo mã hợp đồng mới
$fullContractCode = generateContractCode($conn);

// Chuyển giá trị Status thành kiểu bit
$status = isset($_POST['Status']) ? ($_POST['Status'] === 'True' ? 1 : 0) : 0;

// Câu truy vấn SQL để chèn dữ liệu vào cơ sở dữ liệu
$tsql = "INSERT INTO [dbo].[Full_Contract] 
         ([Customer_Name], [Year_Of_Birth], [SSN], [Customer_Address], 
          [Mobile], [Property_ID], [Date_Of_Contract], [Price], [Deposit], [Remain], [Status]) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Tạo một đối tượng Prepared Statement
$stmt = sqlsrv_prepare($conn, $tsql, array(&$customerName, &$yearOfBirth, &$ssn, 
                                           &$customerAddress, &$mobile, &$propertyID, &$dateOfContract, 
                                           &$price, &$deposit, &$remain, &$status));

// Thực thi truy vấn
if (sqlsrv_execute($stmt) === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "Dữ liệu đã được chèn vào cơ sở dữ liệu thành công.<br>";
}

// Đóng kết nối
sqlsrv_close($conn);

?>
