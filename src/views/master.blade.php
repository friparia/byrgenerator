<!DOCTYPE html>
<html lang="en">
<head>
	<!--
		Charisma v1.0.0

		Copyright 2012 Muhammad Usman
		Licensed under the Apache License v2.0
		http://www.apache.org/licenses/LICENSE-2.0

		http://usman.it
		http://twitter.com/halalit_usman
	-->
	<meta charset="utf-8">
	<title>BYR GENERATOR</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="byrteam">
	<meta name="author" content="friparia">

	<!-- The styles -->
	<link id="bs-css" href="{{ asset('packages/friparia/byrgenerator/css/bootstrap-cerulean.css') }}" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="{{ asset('packages/friparia/byrgenerator/css/bootstrap-responsive.css') }}" rel="stylesheet">
	<link href="{{ asset('packages/friparia/byrgenerator/css/charisma-app.css') }}" rel="stylesheet">
	<link href="{{ asset('packages/friparia/byrgenerator/css/jquery-ui-1.8.21.custom.css') }}" rel="stylesheet">
	<link href="{{ asset('packages/friparia/byrgenerator/css/fullcalendar.css') }}" rel='stylesheet'>
	<link href="{{ asset('packages/friparia/byrgenerator/css/fullcalendar.print.css') }}" rel='stylesheet'  media='print'>
	<link href="{{ asset('packages/friparia/byrgenerator/css/chosen.css') }}" rel='stylesheet'>
	<link href="{{ asset('packages/friparia/byrgenerator/css/uniform.default.css') }}" rel='stylesheet'>
	<link href="{{ asset('packages/friparia/byrgenerator/css/colorbox.css') }}" rel='stylesheet'>
	<link href="{{ asset('packages/friparia/byrgenerator/css/jquery.cleditor.css') }}" rel='stylesheet'>
	<link href="{{ asset('packages/friparia/byrgenerator/css/jquery.noty.css') }}" rel='stylesheet'>
	<link href="{{ asset('packages/friparia/byrgenerator/css/noty_theme_default.css') }}" rel='stylesheet'>
	<link href="{{ asset('packages/friparia/byrgenerator/css/elfinder.min.css') }}" rel='stylesheet'>
	<link href="{{ asset('packages/friparia/byrgenerator/css/elfinder.theme.css') }}" rel='stylesheet'>
	<link href="{{ asset('packages/friparia/byrgenerator/css/jquery.iphone.toggle.css') }}" rel='stylesheet'>
	<link href="{{ asset('packages/friparia/byrgenerator/css/opa-icons.css') }}" rel='stylesheet'>
	<link href="{{ asset('packages/friparia/byrgenerator/css/uploadify.css') }}" rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
		
</head>
<body>
    @yield('content')
	<!-- jQuery -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery-1.7.2.min.js') }}"></script>
	<!-- jQuery UI -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery-ui-1.8.21.custom.min.js') }}"></script>
	<!-- transition / effect library -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/bootstrap-transition.js') }}"></script>
	<!-- alert enhancer library -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/bootstrap-alert.js') }}"></script>
	<!-- modal / dialog library -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/bootstrap-modal.js') }}"></script>
	<!-- custom dropdown library -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/bootstrap-dropdown.js') }}"></script>
	<!-- scrolspy library -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/bootstrap-scrollspy.js') }}"></script>
	<!-- library for creating tabs -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/bootstrap-tab.js') }}"></script>
	<!-- library for advanced tooltip -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/bootstrap-tooltip.js') }}"></script>
	<!-- popover effect library -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/bootstrap-popover.js') }}"></script>
	<!-- button enhancer library -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/bootstrap-button.js') }}"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/bootstrap-collapse.js') }}"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/bootstrap-carousel.js') }}"></script>
	<!-- autocomplete library -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/bootstrap-typeahead.js') }}"></script>
	<!-- tour library -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/bootstrap-tour.js') }}"></script>
	<!-- library for cookie management -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.cookie.js') }}"></script>
	<!-- calander plugin -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/fullcalendar.min.js') }}"></script>
	<!-- data table plugin -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.dataTables.min.js') }}"></script>

	<!-- chart libraries start -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/excanvas.js') }}"></script>
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.flot.min.js') }}"></script>
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.flot.pie.min.js') }}"></script>
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.flot.stack.js') }}"></script>
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.flot.resize.min.js') }}"></script>
	<!-- chart libraries end -->

	<!-- select or dropdown enhancer -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.chosen.min.js') }}"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.uniform.min.js') }}"></script>
	<!-- plugin for gallery image view -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.colorbox.min.js') }}"></script>
	<!-- rich text editor library -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.cleditor.min.js') }}"></script>
	<!-- notification plugin -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.noty.js') }}"></script>
	<!-- file manager library -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.elfinder.min.js') }}"></script>
	<!-- star rating plugin -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.raty.min.js') }}"></script>
	<!-- for iOS style toggle switch -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.iphone.toggle.js') }}"></script>
	<!-- autogrowing textarea plugin -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.autogrow-textarea.js') }}"></script>
	<!-- multiple file upload plugin -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.uploadify-3.1.min.js') }}"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="{{ asset('packages/friparia/byrgenerator/js/jquery.history.js') }}"></script>
</body>
</html>
