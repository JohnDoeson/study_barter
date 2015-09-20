<!DOCTYPE html>
<html lang="ru">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>@yield('title') - Study Barter</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('libs/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('libs/css/flat-ui.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('libs/css/style.css') }}">
	<!--[if lt IE 9]>
    <script src="libs/js/html5shiv.js"></script>
    <script src="libs/js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="{{ URL::asset('libs/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('libs/js/flat-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('libs/js/custom.js') }}"></script>
    @yield('headExtra')
</head>
<body>
<div class="wrapper">
	
	<nav class="navbar navbar-inverse navbar-embossed" role="navigation">

    	<div class="navbar-header">
    	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-6">
    	    <span class="sr-only">Toggle navigation</span>
    	  </button>
    	  <a class="navbar-brand" href="#">Flat UI</a>
    	</div>

    	<!-- Collect the nav links, forms, and other content for toggling -->
    	<div class="collapse navbar-collapse" id="navbar-collapse-6">
    	  <ul class="nav navbar-nav">
    	    <li><a href="#">Messages<span class="navbar-unread">1</span></a></li>
    	    <li class="active"><a href="#">About Us</a></li>
    	    <li><a href="#">Clients</a></li>
    	   </ul>
    	  <form class="navbar-form navbar-left" action="#" role="search">
    	    <div class="form-group">
    	      <div class="input-group">
    	        <input class="form-control" id="navbarInput-01" type="search" placeholder="Search">
    	        <span class="input-group-btn">
    	          <button type="submit" class="btn"><span class="fui-search"></span></button>
    	        </span>
    	      </div>
    	    </div>
    	  </form>
    	  <ul class="nav navbar-nav navbar-right">
          @if (Auth::check())
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Member::currentUsername() }} <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{ ProfileController::currentUserProfile() }}">Профиль</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo action('UsersController@getLogout'); ?>">Выйти</a></li>
              </ul>
            </li>
          @else
            <li><a href="https://oauth.vk.com/authorize?client_id=5073634&display=page&redirect_uri=http://localhost/study_barter/public/users/vklogin&scope=photos&response_type=code">VK</a></li>
            <li><a href="login">Вход</a></li>
            <li><a href="register">Регистрация</a></li>
          @endif
    	    
    	    <li><a href="#"><span class="visible-sm visible-xs">Settings<span class="fui-gear"></span></span><span class="visible-md visible-lg"><span class="fui-gear"></span></span></a></li>
    	  </ul>
    	</div><!-- /.navbar-collapse -->
    </nav>
    @yield('content')
    <div id="footer">
    	<div class="container">
    		<div class="col-md-4">
    			&copy; 2015 Study barter
    		</div>
    	</div>
    </div>
</div>
</body>
</html>