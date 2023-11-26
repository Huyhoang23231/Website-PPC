<?php
require_once(__DIR__.'/../../../Database/connect.php');

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


$tsql = "SELECT * FROM FULL_CONTRACT";

// Thực thi truy vấn
$stmt = sqlsrv_query($conn, $tsql);


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Carlito:ital,wght@0,400;0,700;1,400&family=Kumbh+Sans:wght@100;200;300;400;500;600;700;800&family=Lato:ital,wght@0,100;0,300;0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,300;0,400;0,500;1,300&family=Poppins:wght@100;200;300;400;500;600;700;800&family=Red+Hat+Display:wght@300;400;500&family=Roboto:wght@100;300;400;500;700;900&family=Vujahday+Script&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link
      rel="shortcut icon"
      href="./assets/Logo/img/Logo.png"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="./assets/style.css" />
    <title>Add FullContract</title>
  </head>
  <body>
    <div id="main">
      <!-- Header -->
      <div id="header">
        <div class="header__navbar">
          <div class="header__navbar--wrapper">
            <div class="header__navbar--logo">
              <a
                href="http://localhost:3000/Web/AddFullContract/FullContract/FullContract.php"
                onclick="tai_lai_HD"
              >
                <img
                  src="./assets/Logo/img/PPCLogo-128-White 1.png"
                  alt=""
                  class="header__navbar--image"
                />
              </a>
            </div>

            <div class="header__navbar--list">
              <div class="header__navbar--item">
                <a
                  href="http://localhost:3000/Web/ViewListOfFullContract/ViewList.php"
                  onclick="dieu_huong_quanlyBDS"
                >
                  <div class="header__navbar--item--content">
                    <img
                      src="./assets/Logo/icon/QuanLyBDS-Icon.png"
                      alt=""
                      class="header__navbar--icon"
                    />
                    <p>Quản lý BDS</p>
                  </div>
                </a>
              </div>
              <div class="header__navbar--item">
                <a
                  href="http://localhost:3000/Web/AddFullContract/FullContract/FullContract.php"
                  onclick="dieu_huong_quanlyHD"
                >
                  <div class="header__navbar--item--content">
                    <img
                      src="./assets/Logo/icon/QuanLyHopDong-Icon.png"
                      alt=""
                      class="header__navbar--icon"
                    />
                    <p>Quản lý Hợp đồng</p>
                  </div>
                </a>
              </div>
            </div>
          </div>

          <div class="header__navbar--copyright">
            <p>
              @Copyright by ITECH
              <img src="./assets/Logo/img/Logo.png" alt="Logo Itech" />
            </p>
          </div>
        </div>
      </div>

      <!-- Body -->
      <div id="body">
        <h2 class="content-text">Trang quản lý Bất động sản PPC</h2>
        <span class="content-span">Thêm hợp đồng</span>
        <form id="yourForm" method="post" action="InsertData/InsertContract.php">
            <div class="content__wrapper">

                <!-- Tạo mã hợp đồng mới -->
                <?php
                $newContractCode = generateContractCode($conn);
                ?>

              <div class="label-content">
                <label class="label">Mã hợp đồng</label>
                <span class="label-span"><?php echo $newContractCode; ?></span>
              </div>
              <div class="label-content">
                <label class="label">Họ tên người mua</label>
                <div>
                  <input type="text" class="input" name="customerName" />
                </div>
              </div>
              <div class="label-content">
                <label class="label">Sinh năm</label>
                <div>
                  <input type="text" class="input" name="yearOfBirth" />
                </div>
              </div>
              <div class="label-content">
                <label class="label">SSN</label>
                <div>
                  <input type="text" class="input" name="ssn"/>
                </div>
              </div>
              <div class="label-content">
                <label class="label">Địa chỉ</label>
                <div>
                  <input type="text" class="input" name="customerAddress"/>
                </div>
              </div>
              <div class="label-content">
                <label class="label">Số điện thoại</label>
                <div>
                  <input type="tel" class="input" name="mobile"/>
                </div>
              </div>
              <div class="label-content">
                <label class="label">Mã bất động sản</label>
                <div>
                  <input type="text" class="input" name="propertyID" />
                </div>
              </div>
              <div class="label-content">
                <label class="label">Ngày lập hợp đồng</label>
                <div>
                  <input type="date" class="input-one" name="dateOfContract"/>
                </div>
              </div>
              <div class="label-content">
                <label class="label">Giá trị hợp đồng</label>
                <div>
                  <input type="number" class="input" name="price"/>
                </div>
                <span class="input-span">VND</span>
              </div>
              <div class="label-content">
                <label class="label">Số tiền đã cọc</label>
                <div>
                  <input type="number" class="input" name="deposit"/>
                </div>
                <span class="input-span">VND</span>
              </div>
              <div class="label-content">
                <label class="label">Số tiền còn lại</label>
                <div>
                  <input type="number" class="input" name="remain"/>
                </div>
                <span class="input-span">VND</span>
              </div>
              <div class="label-content">
                <label class="label">Trạng thái</label>
                <div>
                  <select class="input-one fix__width" name="status">
                    <option value="ctt" class="one">Chưa thanh toán</option>
                    <option value="dtt">Đã thanh toán</option>
                  </select>
                </div>
              </div>
            </div>
        </form>

        <div class="button-group">
          <button class="button" onclick="Huybo()">Huỷ</button>
          <button class="button one" onclick="luuHopDong()">Lưu</button>
        </div>
      </div>
    </div>
  </body>

  <script>
    function tai_lai_HD() {
      location.assign(
        "http://localhost:3000/Web/AddFullContract/FullContract/FullContract.php"
      );
    }
  </script>

  <script>
    function dieu_huong_quanlyBDS() {
      location.assign(
        "http://localhost:3000/Web/ViewListOfFullContract/ViewList.php"
      );
    }
  </script>

  <script>
    function dieu_huong_quanlyHD() {
      location.assign(
        "http://localhost:3000/Web/AddFullContract/FullContract/FullContract.php"
      );
    }
  </script>

  <!-- Xử lý chức năng khi nhập trường dữ liệu -->
  <script>
    function luuHopDong() {
    // Lấy giá trị từ các trường input và select
        var hoTenElement = document.querySelector('.input[name="customerName"]');
        var hoTen = hoTenElement ? hoTenElement.value : '';

        var sinhNamElement = document.querySelector('.input[name="yearOfBirth"]');
        var sinhNam = sinhNamElement ? sinhNamElement.value : '';

        var ssNElement = document.querySelector('.input[name="ssn"]');
        var ssN = ssNElement ? ssNElement.value : '';

        var diaChiElement = document.querySelector('.input[name="customerAddress"]');
        var diaChi = diaChiElement ? diaChiElement.value : '';

        var soDienThoaiElement = document.querySelector('.input[name="mobile"]');
        var soDienThoai = soDienThoaiElement ? soDienThoaiElement.value : '';

        var maBatDongSanElement = document.querySelector('.input[name="propertyID"]');
        var maBatDongSan = maBatDongSanElement ? maBatDongSanElement.value : '';

        var ngayLapHopDongElement = document.querySelector('.input[name="dateOfContract"]');
        var ngayLapHopDong = ngayLapHopDongElement ? ngayLapHopDongElement.value : '';

        var giaTriHopDongElement = document.querySelector('.input[name="price"]');
        var giaTriHopDong = giaTriHopDongElement ? giaTriHopDongElement.value : '';

        var soTienDaCocElement = document.querySelector('.input[name="deposit"]');
        var soTienDaCoc = soTienDaCocElement ? soTienDaCocElement.value : '';

        var soTienConLaiElement = document.querySelector('.input[name="remain"]');
        var soTienConLai = soTienConLaiElement ? soTienConLaiElement.value : '';

        var trangThaiElement = document.querySelector('.input[name="status"]');
        var trangThai = trangThaiElement ? trangThaiElement.value : '';

        // Tạo đối tượng FormData để chứa dữ liệu
        var formData = new FormData();
        formData.append('customerName',hoTen);
        formData.append('yearOfBirth',sinhNam);
        formData.append('ssn',ssN);
        formData.append('customerAddress',diaChi);
        formData.append('mobile',soDienThoai);
        formData.append('propertyID',maBatDongSan);
        formData.append('dateOfContract ',ngayLapHopDong);
        formData.append('price',giaTriHopDong);
        formData.append('deposit',soTienDaCoc);
        formData.append('remain',soTienConLai);
        formData.append('status',trangThai);

        // Thực hiện AJAX Request bằng XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/../InsertData/InsertContract.php", true);

        // Đặt sự kiện xử lý khi trạng thái của yêu cầu thay đổi
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    // Xử lý kết quả nếu cần
                    console.log(xhr.responseText);
                    // Chuyển hướng về trang ViewList.php sau khi lưu thành công
                    window.location.href = "http://localhost:3000/Web/ViewListOfFullContract/ViewList.php";
                } else {
                    // Xử lý lỗi nếu có
                    console.error('Error:', xhr.status, xhr.statusText);
                }
            }
        };

        // Gửi yêu cầu AJAX với dữ liệu formData
        xhr.send(formData);
    }

  </script>

  <script>
    // Hàm xử lý khi nút "Huỷ" được click
    function Huybo() {

    // Kiểm tra và thiết lập giá trị cho trường input nếu nó tồn tại
        var hoTenElement = document.querySelector('.input[name="customerName"]');
        if (hoTenElement) hoTenElement.value = "";

        var sinhNamElement = document.querySelector('.input[name="yearOfBirth"]');
        if (sinhNamElement) sinhNamElement.value = "";

        var ssnElement = document.querySelector('.input[name="ssn"]');
        if (ssnElement) ssnElement.value = "";

        var diaChiElement = document.querySelector('.input[name="customerAddress"]');
        if (diaChiElement) diaChiElement.value = "";

        var soDienThoaiElement = document.querySelector('.input[name="mobile"]');
        if (soDienThoaiElement) soDienThoaiElement.value = "";

        var maBatDongSanElement = document.querySelector('.input[name="propertyID"]');
        if (maBatDongSanElement) maBatDongSanElement.value = "";

        var ngayLapHopDongElement = document.querySelector('.input[name="dateOfContract"]');
        if (ngayLapHopDongElement) ngayLapHopDongElement.value = "";

        var giaTriHopDongElement = document.querySelector('.input[name="price"]');
        if (giaTriHopDongElement) giaTriHopDongElement.value = "";

        var soTienDaCocElement = document.querySelector('.input[name="deposit"]');
        if (soTienDaCocElement) soTienDaCocElement.value = "";

        var soTienConLaiElement = document.querySelector('.input[name="remain"]');
        if (soTienConLaiElement) soTienConLaiElement.value = "";

        var trangThaiElement = document.querySelector('.input[name="status"]');
        if (trangThaiElement) trangThaiElement.value = "";
    }
  </script>


</html>
