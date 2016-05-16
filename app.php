<?php
	//require another php file
	//../../ means go to folders back
	require_once("../../config.php");
	require_once("header.php");
	
	
	//******************************
	//******** SAVE TO DB **********
	//******************************
		
		
		//connection with username and password
		//access username from config
		//echo $db_username;
		
		//1 server name
		//2 username
		//3 password
		//4 database
		
		$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_mertyarba");
		
		$stmt = $mysql->prepare("INSERT INTO exam(insect, description)VALUES (?, ?)");
		
		//We are replacing question marks with values
		//s - string, date or smth that is based on characters and numbers
		//i - integer, number
		//d - decimal, float
		
		//for each question mark its type with one letter
		$stmt->bind_param("ss", $_GET["insect"], $_GET["description"]);
		
		//echo error
		echo $mysql->error;
		
		//save
		if ($stmt->execute()){
			echo "saved successfully";
		}else{
			echo $stmt->error;
		}
	
	//*****************
	//TO validation
	//*****************
	if (isset($_GET["insect"])){//if there is "?insect=" in the message
		if (empty($_GET["insect"])){//if it is empty
		echo "Define insect! <br>";//yes it is empty
		}else{
			echo "Insect: ".$_GET["insect"]."<br>";//no it is not empty
		}
	}
	
	//check if there is variable in the URL
	if (isset ($_GET["description"])){
		
		//only if there is message in the URL
		//echo "there is message";
		
		// if it is empty
		if (empty ($_GET["description"])){
			//it is empty
			echo "Please describe the insect! <br>";
		}else{
			//It is not empty
			echo "Description: ".$_GET["description"]."<br>";
		}
	}else{
		
	}
	?>
	
	
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">Insect Collections</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		
		  <ul class="nav navbar-nav">
			
			<li class="active">
				<a href="app.php">
					Add Insect
				</a>
			</li>
			
			
			<li>
				<a href="table.php">
					Browse Insects
				</a>
			</li>
			
			<li>
				<a href="latest.php">
					Latest Insect
				</a>
			</li>
			
		  </ul> 
		  
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">

		<h1> Insect Collections </h1>
		
	<form>
		<div class="row">
			<div class="col-md-3 col-sm-6">
				<div class="form-group">
					<label for="insect">Insect: </label>
					<input name="insect" id="insect" type="text" class="form-control">
				</div>
			</div>
		</div>
		
		<div class="row">
		<div class="col-md-3 col-sm-6">
				<div class="form-group">
					<label for="description">Description: </label>
					<input name="description" id="description" type="text" class="form-control">
				</div>
			</div>
		
		</div>
		
		<div class="row">
			<div class="col-md-3 col-sm-6">
			<input class="btn btn-success hidden-xs btn-md-3" type="submit" value="Add">
			<input class="btn btn-success visible-xs-inline btn-block" type="submit" value="Add">
		</div>
		
		

  
	</div>
  
  </body>
</html>