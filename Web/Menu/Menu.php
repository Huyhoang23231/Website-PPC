<?php

require_once(__DIR__.'/../../Database/connect.php');

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
      href="assets/css/img/Logo.png"
      type="image/x-icon"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="assets/css/style.css" />
    <title>Menu</title>
  </head>
  <body>
    <div id="main">
      <!-- Header -->
      <div id="header">
        <div class="header__navbar">
          <div class="header__navbar--wrapper">
            <div class="header__navbar--logo">
              <a
                href="http://localhost:3000/Web/Menu/Menu.php"
                onclick="tai_lai_menu"
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
          <h1>Chào mừng bạn đã tới trang Quản lý Bất động sản PPC</h1>
        </div>
      </div>
    </div>
  </body>

  <script>
    function tai_lai_menu() {
      location.assign("http://localhost:3000/Web/Menu/Menu.php");
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
