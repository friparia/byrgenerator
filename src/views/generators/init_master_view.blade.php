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
	<link id="bs-css" href="@{{ asset('css/bootstrap-cerulean.css') }}" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href=" @{{ asset("css/bootstrap-responsive.css") }}" rel="stylesheet">
	<link href=" @{{ asset("css/charisma-app.css") }}" rel="stylesheet">
	<link href=" @{{ asset("css/jquery-ui-1.8.21.custom.css") }}" rel="stylesheet">
	<link href=" @{{ asset("css/fullcalendar.css") }}" rel='stylesheet'>
	<link href=" @{{ asset("css/fullcalendar.print.css") }}" rel='stylesheet'  media='print'>
	<link href=" @{{ asset("css/chosen.css") }}" rel='stylesheet'>
	<link href=" @{{ asset("css/uniform.default.css") }}" rel='stylesheet'>
	<link href=" @{{ asset("css/colorbox.css") }}" rel='stylesheet'>
	<link href=" @{{ asset("css/jquery.cleditor.css") }}" rel='stylesheet'>
	<link href=" @{{ asset("css/jquery.noty.css") }}" rel='stylesheet'>
	<link href=" @{{ asset("css/noty_theme_default.css") }}" rel='stylesheet'>
	<link href=" @{{ asset("css/elfinder.min.css") }}" rel='stylesheet'>
	<link href=" @{{ asset("css/elfinder.theme.css") }}" rel='stylesheet'>
	<link href=" @{{ asset("css/jquery.iphone.toggle.css") }}" rel='stylesheet'>
	<link href=" @{{ asset("css/opa-icons.css") }}" rel='stylesheet'>
	<link href=" @{{ asset("css/uploadify.css") }}" rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
		
</head>
<body>
    {{ '@'.'yield("content")' }}

	<script src="@{{ asset("js/jquery-1.7.2.min.js") }}"></script>
	<script src="@{{ asset("js/jquery-ui-1.8.21.custom.min.js") }}"></script>
	<script src="@{{ asset("js/bootstrap-transition.js") }}"></script>
	<script src="@{{ asset("js/bootstrap-alert.js") }}"></script>
	<script src="@{{ asset("js/bootstrap-modal.js") }}"></script>
	<script src="@{{ asset("js/bootstrap-dropdown.js") }}"></script>
	<script src="@{{ asset("js/bootstrap-scrollspy.js") }}"></script>
	<script src="@{{ asset("js/bootstrap-tab.js") }}"></script>
	<script src="@{{ asset("js/bootstrap-tooltip.js") }}"></script>
	<script src="@{{ asset("js/bootstrap-popover.js") }}"></script>
	<script src="@{{ asset("js/bootstrap-button.js") }}"></script>
	<script src="@{{ asset("js/bootstrap-collapse.js") }}"></script>
	<script src="@{{ asset("js/bootstrap-carousel.js") }}"></script>
	<script src="@{{ asset("js/bootstrap-typeahead.js") }}"></script>
	<script src="@{{ asset("js/bootstrap-tour.js") }}"></script>
	<script src="@{{ asset("js/jquery.cookie.js") }}"></script>
	<script src="@{{ asset("js/fullcalendar.min.js") }}"></script>
	<script src="@{{ asset("js/jquery.dataTables.min.js") }}"></script>
	<script src="@{{ asset("js/excanvas.js") }}"></script>
	<script src="@{{ asset("js/jquery.flot.min.js") }}"></script>
	<script src="@{{ asset("js/jquery.flot.pie.min.js") }}"></script>
	<script src="@{{ asset("js/jquery.flot.stack.js") }}"></script>
	<script src="@{{ asset("js/jquery.flot.resize.min.js") }}"></script>
	<script src="@{{ asset("js/jquery.chosen.min.js") }}"></script>
	<script src="@{{ asset("js/jquery.uniform.min.js") }}"></script>
	<script src="@{{ asset("js/jquery.colorbox.min.js") }}"></script>
	<script src="@{{ asset("js/jquery.cleditor.min.js") }}"></script>
	<script src="@{{ asset("js/jquery.noty.js") }}"></script>
	<script src="@{{ asset("js/jquery.elfinder.min.js") }}"></script>
	<script src="@{{ asset("js/jquery.raty.min.js") }}"></script>
	<script src="@{{ asset("js/jquery.iphone.toggle.js") }}"></script>
	<script src="@{{ asset("js/jquery.autogrow-textarea.js") }}"></script>
	<script src="@{{ asset("js/jquery.uploadify-3.1.min.js") }}"></script>
	<script src="@{{ asset("js/jquery.history.js") }}"></script>
</body>
</html>
