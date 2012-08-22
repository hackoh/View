<?php
require 'View.php';
echo View::render('views/more.html', array(
	'hoge' => 'foo',
	'title' => 'this is title',
	'bar' => 'barrrr'
));
/*
 * It is displayed as follows:
 * 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>this is title</title>
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	</head>
	<body>
		<p>this is index page. text:barrrr</p>
		<div>
			<p>this is more page. text:foo</p>
		</div>
	</body>
</html>
*/