<?php 
	include('connect.php');
	
	$moisIndex = '';
	Switch($_POST["dateValid"])
	{
		case "Janvier":$moisIndex=1;break;
		case "F&eacute;vrier":$moisIndex=2;break;
		case "Mars":$moisIndex=3;break;
		case "Avril":$moisIndex=4;break;
		case "Mai":$moisIndex=5;break;
		case "Juin":$moisIndex=6;break;
		case "Juillet":$moisIndex=7;break;
		case "Aout":$moisIndex=8;break;
		case "Septembre":$moisIndex=9;break;
		case "Octobre":$moisIndex=10;break;
		case "Novembre":$moisIndex=11;break;
		case "D&eacute;cembre":$moisIndex=12;break;
	}
	$nom=$_POST["lstVisiteur"];

	$mois = $_POST["dateValid"];

	$reqid="select * from users where nom='$nom'";
	$resultID = mysqli_query($connect,$reqid) or die ("id non trouvé");
	$user = $resultID->fetch_assoc();

	$id = $user['id'];

	$req1 = "select * from fichefrais where idVisiteur='$id' and mois='$moisIndex'; ";
	$resultRepas = mysqli_query($connect,$req1) or die ("repas non trouvé");
	$row = $resultRepas->fetch_assoc(); 
?>

<html>
<head>
	<title>Gestion des frais de visite</title>
	<?php
		include("hautConnecteComptable.php");
		include("listCptEnregFrais.php");
	?>
		
	<div id="corps2">
	<blockquote>
	<form action="validFrais.php" method="POST">
		<h2>Frais au forfait </h2>

		<div class="col-md-12">
			<div class="col-md-5" style="margin-bottom:5px;">Identifiant du visiteur m&eacute;dical : <?php echo $id; ?> </div>
		</div>

		<table style="color:black;" border="1">
			<tr><th>Repas midi</th><th>Nuit&eacute;e </th><th>Etape</th><th>Km </th><th>Situation</th></tr>
			<tr align="center">
				<td width="80"> <input  type="text" size="3" name="repas" value="<?php echo $row['repas']; ?>"/> </td>
				<td width="80"> <input  type="text" size="3" name="nuitee" value="<?php echo $row['nuitees']; ?>"/> </td>
				<td width="80"> <input  type="text" size="3" name="etape" value="<?php echo $row['etapes']; ?>"/> </td>
				<td width="80"> <input  type="text" size="3" name="km" value="<?php echo $row['km']; ?>"/> </td>
				<td width="120" align="left">
					<li><input class="col-md-12" type="radio" name="situation" value="E" checked/>Enregistr&eacute;</li>
					<li><input class="col-md-12" type="radio" name="situation" value="V"/>Valid&eacute;</li>
					<li><input class="col-md-12" type="radio" name="situation" value="R"/>Rembours&eacute;</li>
				</td>
			</tr>
		</table>
		
		<hr>
		<p class="titre" /><h2>Hors Forfait</h2>
		<table style="color:black;" border="1">
			<tr><th>Date</th><th>Libell&eacute;</th><th>Montant Saisie</th><th>Situation</th></tr>
			<tr align="center"><td width="100" ><input  type="text" size="12" name="hfDate1" value="<?php echo $row['dateCrea'];?>"/></td>
				<td width="220"><input  type="text" size="40" name="hfLib1" value="<?php echo $row['libelle'];?>"/></td> 
				<td width="90"> <input  type="text" size="10" name="hfMont1" value="<?php echo $row['montantSaisie'];?>"/></td>
				<td width="120" align="left">
					<li><input type="radio" name="situationHF" value="E" checked/>Enregistr&eacute;</li>
					<li><input type="radio" name="situationHF" value="V"/>Valid&eacute;</li>
					<li><input type="radio" name="situationHF" value="R"/>Rembours&eacute;</li>
				</td>
			</tr>
		</table>		
		<p class="titre"></p>
		<div class="col-md-12">
			<div class="col-md-6 ">Nb Justificatifs : <input type="text" class="zone" size="4" name="hcMontant"/></div>
			<div class="col-md-6 ">Veuillez v&eacute;rifier l'identifiant du visiteur m&eacute;dical : <input type="text" class="zone" size="4" name="visiteur" value="<?php echo $id; ?>" /></div>
			<div class="col-md-6 ">Veuillez v&eacute;rifier le mois des frais : <input type="text" class="zone" size="10" name="moisSaisie" value="<?php echo $mois; ?>" /></div>
		</div>
		<p class="titre" /><label class="titre">&nbsp;</label><input class="zone"type="reset" /><input class="zone"type="submit"/>
		
	</form>
	</blockquote>
	</div>
</body>
</html>