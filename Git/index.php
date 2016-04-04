<?php
	
	ini_set('display_errors',1);
    error_reporting(E_ALL);
	
	// Setup connections and gain access to all of functions
	require_once('admin/includes/init.php');
	// Define globals and call in info from db
	if(isset($_GET['filter'])) {
		$tbl1 = "tbl_movies";
		$tbl2 = "tbl_cat";
		$tbl3 = "tbl_L_mc";
		$col1 = "movies_id";
		$col2 = "cat_id";
		$col3 = "cat_name";
		$filter = $_GET['filter'];
		$getMovies = filterType($tbl1, $tbl2, $tbl3, $col1, $col2, $col3, $filter);
	}else{
		$tbl = "tbl_movies";
		$getMovies = getAll($tbl);
	}
	
	$tblL = "tbl_movies";
	//echo $tbl1;
	$getNews =  getLatest($tblL);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Welcome to the Finest Selection of Blu-rays on the internets!</title>
<link rel="stylesheet" href="css/normalize.css" />
<link rel="stylesheet" href="css/foundation.css" />
<link rel="stylesheet" href="css/app.css" />
</head>
<body>
<?php

	include('includes/nav.html');
	
	if(!is_string($getNews)){				
				//These are the basic blocks, replace your URL, Image links, and titles with these where appropriate. Echo a single tile, loop repeats until page is populated.
			
				while($row = mysqli_fetch_array($getNews)){
					//echo "{$row['news_title']}<br>";
					//echo "{$row['news_link']}<br>";
					//echo "{$row['news_img']}<br>";				
			
        		echo"<div class=\"small-12 medium-6 large-4 columns newspic news\">            
					  <a href=\"{$row['news_link']}\"><img src=\"images/{$row['news_img']}\" alt=\"newImages\" class=\"newsImage\"></a>           
						<a href=\"{$row['news_link']}\">
						 <h3>{$row['news_title']}</h3>
						 <p class=\"date\">{$row['news_date']}</p>
						</a>
					</div>";         
					}				
			}
        
	
	if(!is_string($getMovies)){
		while($row = mysqli_fetch_array($getMovies)){
			echo"<a href=\"details.php?id={$row['movies_id']}\">
				  <div class=\"movietile small-12 large-3 columns\">
				 <h2>{$row['movies_title']}</h2>
				 <img src=\"images/{$row['movies_thumb']}\" alt=\"{$row['movies_title']}\">				 
				 <p>{$row['movies_year']}</p>
				 </div>	
				 </a>			 
				 ";
		}
	}else{
		echo "<p>{$getMovies}</p>";
	}
	
	include('includes/footer.html');
	
?>
<script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/utility.js"></script>
    <script>
      $(document).foundation();
    </script>
</body>
</html>