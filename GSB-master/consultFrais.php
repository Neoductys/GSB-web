<?php
	if($_COOKIE["comptable"]=="")
		header("location:choixUtil.html");
	
	include('connect.php');

	//récupération des données envoyer depuis le formulaires.
	if ($_COOKIE["comptable"]) {
		$id=$_COOKIE["comptable"];
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
	}
?>

<html>
<title>Consultation des frais</title>
	<body id="basicBody">
		<?php
			include("hautConnecteComptable.php");
		
			include('moisComptable.php');

			$mois = "select id from mois where value='$lemois'";
			$resmois = mysqli_query($connect, $mois);
			$mois = $resmois->fetch_assoc();

			$req="select * from fichefrais where mois='$mois[id]' ";
			$rows=mysqli_query($connect,$req) or die ("requette");
			$rows = $result->fetch_array(MYSQLI_ASSOC);

			$reqid="select * from users where id='$row[idVisiteur]' ";
			$resultID = mysqli_query($connect,$reqid) or die ("id non trouvé");
			$user = $resultID->fetch_assoc();

			
		?>


		<?php
		if ($id){
			if($rows){
				foreach ($rows as $row){
					$req = "SELECT nom FROM users WHERE id='$row[idVisiteur]'";
					$res = mysqli_query($connect, $req);
					$user = $res->fetch_assoc();
		?>
				<div class="col-md-9" style="border-width=3px">
					<div class="col-md-12" id='titre'>Frais au forfait </div>
					<div class="col-md-12" id="paragraph">
						<div class="col-md-12">Demande du mois de <?php echo $lemois;?></div>
						
						<div class="col-md-12">Derni&egrave;re modification le :   <?php echo $row['dateCrea'];?></div>
						<div class="col-md-12">Demande de <?php echo $user['nom']; ?></div>
						<div class="col-md-12">dont l'identifiant est : <?php echo $row['idVisiteur']; ?></div>
						<div class="col-md-12">Situation : 
									<?php if($row['idEtat'] == 'CR'){
											echo "Fiche Créée, saisie en cours";
										}elseif ($row['idEtat'] == 'CL') {
											echo "Saisie clôturée";
										}elseif ($row['idEtat'] == 'RB') {
											echo "Montant remboursée";
										}elseif ($row['idEtat'] == 'VA') {
											echo "Validée et mise en paiement";
										}else{
											echo "Pas de demande de ce type";
										}
									?>
						</div>
						
					</div>
					<div class="col-md-9" id="tableConsult">
						<table style="color:black;" border="1">
							<tr><th>Repas midi</th><th>Nuit&eacute;e </th><th>Etape</th><th>Km </th></tr>
							<tr align="center">
								<td width="100"> <input  type="text" size="3" name="repas" value="<?php echo $row['repas']; ?>"/> </td>
								<td width="100"> <input  type="text" size="3" name="nuitee" value="<?php echo $row['nuitees']; ?>"/> </td>
								<td width="100"> <input  type="text" size="3" name="etape" value="<?php echo $row['etapes']; ?>"/> </td>
								<td width="100"> <input  type="text" size="3" name="km" value="<?php echo $row['km']; ?>"/> </td>
							</tr>
						</table>
					</div>
					<div class="col-md-12" id="titre">Hors Forfait</div>
					<div class="col-md-9" id="tableConsult">
						<table style="color:black;" border="1">
							<tr><th>Date</th><th>Libell&eacute;</th><th>Montant Saisie</th></tr>
							<tr align="center"><td width="100" ><input  type="text" size="12" name="hfDate1" value="<?php echo $row['dateCrea'];?>"/></td>
								<td width="220"><input  type="text" size="40" name="hfLib1" value="<?php echo $row['libelle'];?>"/></td> 
								<td width="90"> <input  type="text" size="10" name="hfMont1" value="<?php echo $row['montantSaisie'];?>"/></td>
							</tr>
						</table>
						<div class="col-md-7">
							<hr>
						</div>
					</div>
				</div>
			<?php
				}
			}else{
				 ?>
				 <div class='col-md-12' id='tabDemande'>
				 	Pas de demande de remboursement encore effectu&eacute;e pour ce mois-ci.
				 </div>
				 <?php
			}
		}else{
			header('location:index.php');
		}

		
			include('footer.php');
		?>
	</body>
</html>