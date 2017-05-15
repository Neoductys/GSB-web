<?php
	include('connect.php');
	$connect=mysqli_connect("localhost","root","","gsb");
	$id=$_COOKIE["id"];
	$lemois=$_POST["moischoix"];
	Switch($_POST["moischoix"])

	{
		case "Janvier"		:$mois=1;break;
		case "Février"		:$mois=2;break;
		case "Mars"			:$mois=3;break;
		case "Avril"		:$mois=4;break;
		case "Mai"			:$mois=5;break;
		case "Juin"			:$mois=6;break;
		case "Juillet"		:$mois=7;break;
		case "Aout"			:$mois=8;break;
		case "Septembre"	:$mois=9;break;
		case "Octobre"		:$mois=10;break;
		case "Novembre"		:$mois=11;break;
		case "Décembre"		:$mois=12;break;
	}

?>
<title>Votre demande</title>
<html>
	
	<body>
	<?php 
		include("hautConnecteVisiteur.php");
		include('mois.php');


		$mois = "select mois from fichefrais where value='lemois'";

		//$mois = "select id from mois where value='$lemois'";
		//$resMois = mysqli_query($connect, $mois);
		//$mois = $resMois->fetch_assoc();

		$req="select * from fichefrais where idVisiteur='$id' ";
		$result=mysqli_query($connect,$req) or die ("requete");
		$row = $result->fetch_array(MYSQLI_ASSOC);
	?>


	<?php
	if ($id){
		if($row){
	?>
		<div class="col-md-9" id="tabDemande">
			<div class="col-md-12">Demande du mois de <?php echo $lemois;?></div>
			
			<div class="col-md-12">Derni&egrave;re modification le :   <?php echo $row['dateCrea'];?></div>
			<div class="col-md-12">Etat :   <?php echo $row['idEtat'];?></div>
			<div class="col-md-12">Montant :   <?php echo $row['montantSaisie'];?></div>
			<div class="col-md-12">Nombre de justificatifs fournie :   <?php echo $row['nbJustificatifs'];?></div>
		</div>
	<?php
		}else{
			echo "<div class='col-md-9' id='tabDemande'>Pas de demande de remboursement encore effectu&eacute;e pour ce mois.</div>";
		}

	}else{
		header('location:index.php');
	}

	include('footer.php');
	?>

	</body>
</html>