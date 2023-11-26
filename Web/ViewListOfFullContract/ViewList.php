<?php
require_once(__DIR__.'/../../Database/connect.php');

$tsql = "SELECT Full_Contract_Code, Customer_Name, Year_Of_Birth, Mobile FROM FULL_CONTRACT";

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
      rel="shortcut icon"
      href="./assets/css/img/Logo.png"
      type="image/x-icon"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="assets/css/style.css" />
    <title>View list of FullContract</title>
  </head>
  <body>
    <div id="main">
      <!-- Hiển thị pop up window kết nối thành công -->
      <?php
      if (isset($connectionMessage)) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var newWindow = window.open('', '_blank', 'width=400,height=200,location=no,menubar=no,scrollbars=no,status=no,toolbar=no');
                    newWindow.document.write('<html><head><title>Thông báo kết nối</title></head><body><h3>Thông báo kết nối</h3><p>{$connectionMessage}</p><button onclick=\"window.close();\">Đóng</button></body></html>');
                });
              </script>";
      }
      ?>
      <!-- Header -->
      <div id="header">
        <div class="header__navbar">
          <div class="header__navbar--wrapper">
            <div class="header__navbar--logo">
              <a
                href="http://localhost:3000/Web/ViewListOfFullContract/ViewList.php"
                onclick="tai_lai_viewlist"
              >
                <img
                  src="./assets/css/img/PPCLogo-128-White 1.png"
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
                      src="./assets/css/icon/QuanLyBDS-Icon.png"
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
                      src="./assets/css/icon/QuanLyHopDong-Icon.png"
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
              <img src="./assets/css/img/Logo.png" alt="Logo Itech" />
            </p>
          </div>
        </div>
      </div>
      <!-- Body -->
      <div id="body">
        <div class="body__title">
          <h1>Trang quản lý Bất động sản PPC</h1>
        </div>

        <div class="body__subtitle">
          <h2>Xem danh sách hợp đồng Bất động sản</h2>
        </div>

        <!-- Dùng JQUERY để truy vấn dữ liệu từ Database -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script>
        $(document).ready(function() {
          $('#user-property').on('input', function() {
            var searchText = $(this).val().toLowerCase();

            // Lọc các hàng trong bảng
            $('tbody tr').each(function() {
              var rowData = $(this).text().toLowerCase();
              if (rowData.indexOf(searchText) === -1) {
                  $(this).hide();
              } else {
                $(this).show();
              }
            });
          });
        });
        </script>


        <script>
        $(document).ready(function() {
          $('.body__search--input--icon').on('click', function() {
            var searchText = $('#user-property').val().toLowerCase();

            // Lọc các hàng trong bảng
            $('tbody tr').each(function() {
              var rowData = $(this).text().toLowerCase();
              if (rowData.indexOf(searchText) === -1) {
                  $(this).hide();
              } else {
                  $(this).show();
              }
            });
          });
        });
        </script>

        <div class="body__search">
          <div class="body__search--label">
            <p>Tìm kiếm</p>
          </div>
          <div class="body__search--input">
            <input type="text" id="user-property" />
            <i class="body__search--input--icon bi bi-search"></i>
          </div>
        </div>

        <div class="body__add" onclick=dieu_huong_quanlyHD()>
          <p>Thêm</p>
        </div>

        <!-- Tạo bảng hiển thị dữ liệu -->
        <div class="table__container">
          <table class="table__hover">
            <thead>
              <tr>
                <td><input class="checkbox" type="checkbox" /></td>
                <td class="text__opacity">Mã hợp đồng</td>
                <td class="text__opacity">Họ tên người mua</td>
                <td class="text__opacity">Sinh năm</td>
                <td class="text__opacity">Số điện thoại</td>
                <td class="text__opacity">Chỉnh sửa</td>
                <td class="text__opacity">In hợp đồng</td>
              </tr>
            </thead>

            <!-- Dữ liệu được truy vấn từ cơ sở dữ liệu -->
            <?php
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
              // Kiểm tra nếu không có dữ liệu được truy vấn
              if ($row === false) {
                die(print_r(sqlsrv_errors(), true));
              }
            ?>
              <tr>
                <td><input class="checkbox" type="checkbox" /></td>
                <td><?php echo $row['Full_Contract_Code']; ?></td>
                <td><?php echo $row['Customer_Name']; ?></td>
                <td><?php echo $row['Year_Of_Birth']; ?></td>
                <td><?php echo $row['Mobile']; ?></td>
                <td><i class="table__adjust--icon bi bi-pencil"></i></td>
                <td><i class="table__print--icon bi bi-printer-fill"></i></td>
              </tr>
            <?php
            }
            ?>
            
          </table>
        </div>
      </div>
      <!-- Footer -->
      <div id="footer"></div>
    </div>
  </body>

  <script>
    function tai_lai_viewlist() {
      location.assign(
        "http://localhost:3000/Web/ViewListOfFullContract/ViewList.php"
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
</html>
