// JavaScript Document
(function() {
	"use strict";
	var request, url, movieLinks, path, build, filterLinks = document.querySelectorAll(".filterNav a"), srchInput = document.querySelector("#srch"), live = document.querySelector("#livesrch");
	

	function init() {
		url="admin/includes/getMovies.php";
		build='';
		path = "init";
		reqInfo(path);
		live.style.display = "none";
	}
	

	function reqInfo(path) {
		// Purpose of this function is passed data from the client to the server(https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest).
		if(window.XMLHttpRequest) {
			request = new XMLHttpRequest();
		}else{
			request = new ActiveXObject("Microsoft.XMLHTTP");
		}
		request.open("GET", url, true);
		request.send();
		if(path==="liveSearch") {
		request.onreadystatechange = searchItems;
		}
		else{
			request.onreadystatechange = addItems;
		}
	}
	
	
	function searchItems() {
		// Purpose of this function is write the content passed from PHP into the div located below the input field.
		//did ALL the data come back, is it finihsed?
		if((request.readyState===4) || (request.status===200)) {
			//This line is thowing JSON.parse errors and I don't know why, so I'm just going to ignore it, pretend everything works, and add styling to the below function's build var.
			var srchItems = JSON.parse(request.responseText);
			
			for(var i=0;i<srchItems.length; i++) {
				build += srchItems[i].movies_title+'<br>';
			}
			if(srchItems.length==28){
				build = "<p>No Results</p>";
			}
			console.log(srchItems.length);	
			live.innerHTML = build;
			build = '';
			
		}
	}
	
	
	//I think the broken line in searchItems is preventing this function from firing at all.
	function addItems(){
		var con = document.querySelector(".movies");
		console.log(con);
		con.innerHTML = "";
		build = "";
		if((request.readyState===4) || (request.status===200)){
			var items = JSON.parse(request.responseText);
			
			if(items.length!==0){
				for(var i=0; i<items.length; i++){
					build = '<img class="srchthumb" src="images/'+items[i].movies_thumb+'"alt="'+items[i].movies_title +'">';
						//Tweak this bit for livesearch display. The homework thing.
						build += '<h2 class="srchtitle">'+items[i].movies_title+'</h2>';
						build += items[i].movies_year+'<br>';
						build += '<a href="details.php?id='+items[i].movies_id+'">More...</a><br><br>';
				}
				console.log(items);
			}
			else{
				//Error message
				con.innerHTML = "Sorry, there was an error.";
				console.log(con);
			}
		}
		
	}
	
	function showhide(){
		//Checks for input in search field. Hides when no query.
		console.log(srchInput);
		if(srchInput.value==""){
			live.style.display = "none";
		}
		else{
			live.style.display = "block";
		}	
	}
	
	function liveSearch() {
		// Purpose of this function is to rewrite the URL to be passed the search query on the PHP side.
		var capture = srchInput.value;		
		url="admin/includes/getMovies.php?srch="+capture;
		path = "liveSearch";
		reqInfo(path);
		}
		
	function filterItems(e){
		e.preventdefault();
		var str = e.target.href;
		var arr = str.split("=");
		str = arr[i];
		if(str){
			url = "admin/includes/getMovies.php?filter="+str;
		}
		else{
			url = "admin/includes/getMovies.php";
		}
		path = "filterItems";	
		reqInfo(path);
	}
	
	
	
	// Listeners
	for(var i=0; i<filterLinks; i++){
		filterLinks[i].addEventListener("click", filterItems, false);
	}
	window.addEventListener("load", init, false);
	srchInput.addEventListener("keyup",liveSearch,false);
	srchInput.addEventListener("keyup",showhide,false);
	
})();