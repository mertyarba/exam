<?php require_once("header.php"); ?>


<?php
	// table.php
	
	//getting our config
	require_once("../../config.php");
	
	
	//create connection
	$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_mertyarba");

	//IF THERE IS "?DELETE=ROW_ID" in the url
	if (isset ($_GET["delete"])){
		
		echo "Deleting insect with id:".$_GET["delete"];
		
		$stmt=$mysql->prepare("UPDATE exam SET deleted=NOW() WHERE id = ?");
		
		echo $mysql->error;
		
		//replace the "?"
		$stmt->bind_param("i", $_GET["delete"]);
		
		if($stmt->execute()){
			echo "Deleted successfully ";
		}else{
			echo $stmt->error;
		}
		
		
	}
	
	//SQL sentence
	$stmt = $mysql->prepare("SELECT id, insect, date_added, description, deleted FROM exam WHERE deleted IS NULL ORDER BY date_added DESC LIMIT 1");
	//WHERE DELETED IS NULL show only those that are not deleted
	
	//if error in sentence
	echo $mysql->error;
	
	//variables for data for each row we will get
		$stmt->bind_result($id, $insect, $date_added, $description, $deleted);
	
	//query
	$stmt->execute();
	
	$table_html = "";
	
	//add something to string
	$table_html .= "<table class=table table-striped'>";
	$table_html .= "<tr>";
		$table_html .= "<tr>";
		$table_html .= "<th>ID</th>";
		$table_html .= "<th>Insect</th>";
		$table_html .= "<th>Date Added</th>";
		$table_html .="<th>Description</th>";
		$table_html .="<th>Delete</th>";
	$table_html .= "</tr>";
	
	// GET RESULT 
	//we have multiple rows
	while($stmt->fetch()){
		
		//DO SOMETHING FOR EACH ROW
		//echo $id."".$message."<br>";
		$table_html .= "<tr>"; //start new row
			$table_html .= "<td>".$id."</td>"; //add columns
			$table_html .= "<td>".$insect."</td>";
			$table_html .= "<td>".$date_added."</td>";
			$table_html .= "<td>".$description."</td>";
			$table_html .= "<td><a class='btn btn-danger' href='?delete=".$id."'>x</a></td>";
		$table_html .= "<tr>"; //end row

	}
	$table_html .= "</table>";
	
	
	
	


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
			
			<li>
				<a href="app.php">
					Add Insect
				</a>
			</li>
			
			
			<li>
				<a href="table.php">
					Browse Insects
				</a>
			</li>
			
			<li class="active" >
				<a href="latest.php">
					Latest Insect
				</a>
			</li>
			
		  </ul> 
		  
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">

		<h1> Latest Insect </h1>

	<?php echo $table_html; ?>
  
	</div>







  </body>
 </html>