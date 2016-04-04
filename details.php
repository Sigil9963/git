<?php
	require_once('admin/includes/init.php');
	
	if(isset($_GET['id'])) {
		$tbl = "tbl_movies";
		$col = "movies_id";
		$id = $_GET['id'];
		$getSingle = getSingle($tbl, $col, $id);
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Details</title>
<link rel="stylesheet" href="css/normalize.css" />
<link rel="stylesheet" href="css/foundation.css" />
<link rel="stylesheet" href="css/app.css" />
</head>
<body>
<?php
	include('includes/nav.html');
	
	if(!is_string($getSingle)){
		$row = mysqli_fetch_array($getSingle);
			echo "<div id=\"detailstile\">
				 <img class=\"small-12 large-4 columns large-offset-2\" src=\"images/{$row['movies_fimg']}\" alt=\"{$row['movies_title']}\">
				 <div id=\"detdesc\" class=\"large-offset-6 large-4\">
				 <h2>{$row['movies_title']}</h2>
				 <p>{$row['movies_year']}</p>
				 <p>{$row['movies_storyline']}</p>
				 <a href=\"index.php\">Back...</a>
				 </div>
				 </div> 
				 ";
		
	}else{
		echo "<p>{$getSingle}</p>";	
	}
?>
	<script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
</body>
</html>