<html>
<title>Choix du mois</title>
<body>	
	<?php
	include("connect.php");
	if (isset($_COOKIE['id'])) {
		$id = $_COOKIE['id'];
	}else{
		$id = $_COOKIE['comptable'];
	}
	
	$req = "SELECT status FROM users WHERE id='$id'";
	$res = mysqli_query($connect, $req);
	$status = $res->fetch_assoc();


	$pagePrec = $_SERVER["HTTP_REFERER"];
	

	if(($pagePrec == "http://localhost/gsb-master/formSaisieFrais.php")||($pagePrec == "http://localhost/gsb-master/enregSaisieFrais.php")) {
		include("hautConnecteVisiteur.php");
		include('mois.php');
		include('footer.php');
	}elseif(($pagePrec == "http://localhost/gsb-master/listeFrais.php")||($pagePrec == "http://localhost/gsb-master/formValidFrais.php")){
		include("hautConnecteComptable.php");
		include("moisComptable.php");
		include("footer.php");
	}else{
		header('location:index.php');
	}
	?>
</body>
</html>