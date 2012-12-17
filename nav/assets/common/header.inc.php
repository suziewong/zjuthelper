<!DOCTYPE html
    public "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org//TR//xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title><?php echo $page_title; ?></title>
	    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <?php 
			foreach ($css_files as $css):

		?>
		<link rel="stylesheet" type="text/css" media="screen,projection" href="assets/css/<?php echo $css; ?>"/>
	<?php endforeach; ?>
    <script>
        function change()
        {
            
                var yearvalue = $("#year").get(0).value;
                var monthvalue = $("#month").get(0).value;
                


        }
    </script>
	</head>
 	<body>
