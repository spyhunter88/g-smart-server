<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" ng-app="myApp" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" ng-app="myApp" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" ng-app="myApp" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" ng-app="myApp" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Elastic Server</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Material Design fonts 
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">
  -->
  <!-- Bootstrap  -->
  <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome 4.6.3 -->
  <link rel="stylesheet" type="text/css" href="libs/font-awesome-4.6.3/css/font-awesome.min.css">

  <!-- Ladda -->
  <link rel="stylesheet" type="text/css" href="bower_components/ladda/dist/ladda.min.css"> 

  <!-- Creative Theme -->
  <link rel="stylesheet" type="text/css" href="libs/creative-bootstrap/vendor/magnific-popup/magnific-popup.css">
  <link rel="stylesheet" type="text/css" href="libs/creative-bootstrap/css/creative.min.css">

  <!-- Bootstrap UI Slider -->
  <link rel="stylesheet" type="text/css" href="bower_components/seiyria-bootstrap-slider/dist/css/bootstrap-slider.css">

  <!-- Bootstrap Switch -->
  <link rel="stylesheet" type="text/css" href="bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">

  <!-- App style -->
  <link rel="stylesheet" type="text/css" href="app.css">

  <script src="bower_components/html5-boilerplate/dist/js/vendor/modernizr-2.8.3.min.js"></script>
  <script type="text/javascript">
    var baseUrl = window.location.href;
  </script>
</head>
<body>
  <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle Navigation</span> Menu<i class="fa fa-bars"></i>
      </button>
      <a class="navbar-brand page-scroll" href="#page-top">Gdata</a>
    </div>

    <!-- Collect the nav link, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ng-show="currentUser != null">
          <a class="page-scroll" ui-sref="serverRequest">Elastic Server</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right" ng-cloak>
        <li><a ui-sref="auth" ng-show="currentUser == null">Đăng nhập</a></li>
        <li><a ui-sref="register" ng-show="currentUser == null">Đăng ký</a></li>
        <li><a href="" ng-show="currentUser != null">Xin chào @{{currentUser.name}} !</a></li>
        <li><a ng-click="logout()" style="cursor: pointer;" ng-show="currentUser != null">Đăng xuất</a></li>
      </ul>
    </div>
  </nav>

  <header style="min-height: 400px;">
    <div class="header-content">
      <div class="header-content-inner">
        <h1>Đăng ký sử dụng Smart Server</h1>
      </div>
    </div>
  </header>

  <section id="elastic-server">
    <div class="container">
          <div ui-view="serverRequest">
            Loading, please wait ...
          </div>
    </div>
  </section>

  <!-- FOOTER -->
    <footer class="background-dark text-grey" id="footer">
      <div class="footer-content p-b-0 p-t-20">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <div class="widget clearfix widget-categories">
                <h4 class="widget-title">Về Gdata</h4>
                <ul class="list list-arrow-icons">
                  <li><a href="http://dev.gdata.com.vn/ve-chung-toi.html" title="Giới thiệu">Giới thiệu</a></li>
                  <li><a href="http://dev.gdata.com.vn/tin-tuc.html" title="Tin tức">Tin tức</a></li>
                  <li><a href="http://dev.gdata.com.vn/tu-van-kien-thuc.html" title="Tư vấn - kiến thức">Tư vấn - kiến thức</a></li>
                  <li><a href="http://dev.gdata.com.vn/tuyen-dung.html" title="Tuyển dụng">Tuyển dụng</a></li>
                </ul>
              </div>
            </div>

            <div class="col-md-3">
              <div class="widget clearfix widget-categories">
                <h4 class="widget-title">Hướng dẫn</h4>
                <ul class="list list-arrow-icons">
                  <li><a href="http://dev.gdata.com.vn/cam-ket-chat-luong.html" title="Cam kết chất lượng">Cam kết chất lượng</a></li>
                  <li><a href="http://dev.gdata.com.vn/chinh-sach-bao-mat.html" title="Chính sách Bảo mật">Chính sách Bảo mật</a></li>
                  <li><a href="http://dev.gdata.com.vn/dieu-khoan-su-dung.html" title="Điều khoản sử dụng">Điều khoản sử dụng</a></li>
                  <li><a href="http://dev.gdata.com.vn/thanh-toan.html" title="Hướng dẫn thanh toán">Hướng dẫn thanh toán</a></li>
                </ul>
              </div>
            </div>

            <div class="col-md-5" style="float: right;">
              <div class="widget clearfix widget-contact-us" style="background-image: url('http://dev.gdata.com.vn/skins/01/images/world-map.png'); background-position: 50% 55px; background-repeat: no-repeat">
                <h4 class="widget-title">Công ty Cổ Phần Dữ Liệu Toàn Cầu</h4>
                <ul class="list-large list-icons" style="font-size: 15px;">
                  <li><i class="fa fa-building"></i>Địa chỉ: Số 17/ 9 Vương Thừa Vũ, Thanh Xuân, Hà Nội</li>
                  <li><i class="fa fa-map-marker"></i>VP Hà Nội: Tầng 5, Số 84 Phố Duy Tân, Q.Cầu Giấy, Hà Nội</li>
                  <li><i class="fa fa-map-marker"></i>VP TP.HCM: Số 130/ 14 Trần Thái Tông, P.15, Q.Tân Bình, HCM</li>
                  <li><i class="fa fa-envelope"></i><a href="mailto:support@gdata.com.vn">support@gdata.com.vn</a> &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-phone"></i>04 36800 666</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </footer>
    <!-- END: FOOTER -->

  <!-- In production use:
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/x.x.x/angular.min.js"></script>
  -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="bower_components/seiyria-bootstrap-slider/dist/bootstrap-slider.js"></script>
  <script src="bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
  <!-- Plugin JavaScript -->
  <script src="bower_components/jquery.easing/js/jquery.easing.min.js"></script>
  <script src="libs/creative-bootstrap/vendor/scrollreveal/scrollreveal.min.js"></script>
  <script src="libs/creative-bootstrap/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <!-- Ladda -->
  <script src="bower_components/ladda/dist/spin.min.js"></script>
  <script src="bower_components/ladda/dist/ladda.min.js"></script>

  <!-- Theme JavaScript -->
  <script src="libs/creative-bootstrap/js/creative.min.js"></script>

  <!-- Angular + ng-lib -->
  <script src="bower_components/angular/angular.min.js"></script>
  <script src="bower_components/angular-messages/angular-messages.min.js"></script>
  <script src="components/version/version.js"></script>
  <script src="components/version/version-directive.js"></script>
  <script src="components/version/interpolate-filter.js"></script>
  <script src="bower_components/satellizer/dist/satellizer.js"></script>
  <script src="bower_components/angular-ui-router/release/angular-ui-router.js"></script>
  <script src="bower_components/angular-permission/dist/angular-permission.js"></script>
  <script src="bower_components/angular-permission/dist/angular-permission-ui.js"></script>
  <script src="bower_components/angular-bootstrap-slider/slider.js"></script>
  <script src="bower_components/angular-bootstrap-switch/dist/angular-bootstrap-switch.min.js"></script>
  <script src="bower_components/ladda-angular/dist/ladda-angular.min.js"></script>

  <!-- Angular app js -->
  <script src="app.js"></script>
  <script src="services/app.core.service.js"></script>
  <script src="services/auth.intercept.js"></script>
  <script src="view_auth/auth.js"></script>
  <script src="view_auth/app.register.service.js"></script>
  <script src="utils/app.compareto.directives.js"></script>
  <script src="view_serverRequest/serverRequest.js"></script>
  <script src="view_serverRequest/serverRequest.service.js"></script>
</body>
</html>
