<html>
<head>
	<title>Validation des frais de visite</title>
	<style type="text/css">
		
	</style>
</head>
<body>
<div id ="bloc" class = "well">

<?php

$Mois = array("1" => "janvier", "2" => "février", "3" => "mars", "4" => "avril", "5" => "mai", "6" => "juin", "7" => "juillet", "8" => "août", "9" => "septembre", "10" => "octobre", "11" => "novembre", "12" =>"décembre") ; 

		$day = date("d");
			
	 if (date("d") > 15 )
	{
		 $m = date("m") + 1;
		 $dateShow = $Mois[$m];
		 
	}else
	{
		$m = date("m");
		$dateShow = $Mois[$m];
	}
?>

		
	<div id="form">
		<label class="titre">Choisir le visiteur :</label>
		
			<form method="POST" action="index.php?uc=fichesFrais&action=ValidationFrais">
				<select	name="lstVisiteur" class="form-control">
						<?php
						   foreach($lesVisiteur as $unVisiteur)
						   {
							$visiteur = $unVisiteur['prenom']. " " . $unVisiteur['nom'];
							$idvisiteur = $unVisiteur['id'];
							echo '<option value="' . $idvisiteur .'">'.$visiteur.'</option>';
						   }
						?>
				</select>
				
				<label class="titre">Mois :</label> 
				<select	name="moisValid" class="form-control">
						 <option value="01">Janvier</option>
						 <option value="02">Fevrier</option>
						 <option value="03">Mars</option>
						 <option value="04">Avril</option>
						 <option value="05">Mai</option>
						 <option value="06">Juin</option>
						 <option value="07">Juillet</option>
						 <option value="08">Aout</option>
						 <option value="09">Septembre</option>
						 <option value="10">Septembre</option>
						 <option value="11">Novembre</option>
						 <option value="12">Decembre</option>
				</select>
				
				<label class="titre">Année :</label> 
				<select	name="anneeValid" class="form-control">
						 <option value="2010">2010</option>
						 <option value="2011">2011</option>
						 <option value="2012">2012</option>
						 <option value="2013">2013</option>
						 <option value="2014">2014</option>
						 <option value="2015">2015</option>
						 <option value="2016">2016</option>
				</select>
							
			</br>
		
			<!-- <input class="zone" type="text" name="dateValid" size="12" value=" <?php echo $dateShow?>" onmouseout = "javascript:window.location.reload()" />
			-->
				<input type="submit" class="btn btn-default" value="Cherchez les frais de ce client" name="valider">
			</form>
			
	</div>  
		
		</br>
		
		<div style="clear:left;"><h2>Frais au forfait </h2></div>
		 <table class="table table-bordered .table-responsive">
			<tr><th>Repas midi</th><th>Nuitée </th><th>Etape</th><th>Km </th><th>Situation</th></tr>
			<tr align="center">
			
	<form method="POST" action="index.php?uc=fichesFrais&action=saveFrais&visiteur=<?=(!empty($Visiteur)) ? $Visiteur :''  ?>&mois=<?=(!empty($date)) ? $date:''  ?>">
	
				<td width="80" ><input class="form-control" type="text" size="3" name="repas" value = "<?=(!empty($lesFrais[3]['quantite'])) ? $lesFrais[3]['quantite'] :''  ?>" /></td>
				<td width="80"><input  class="form-control" type="text" size="3" name="nuitee" value = "<?=(!empty ($lesFrais[2]['quantite'])) ? $lesFrais[2]['quantite'] :''  ?>"/></td> 
				<td width="80"> <input class="form-control" type="text" size="3" name="etape" value = "<?=(!empty ($lesFrais[0]['quantite'])) ? $lesFrais[0]['quantite'] :''  ?>"/></td>
				<td width="80"> <input class="form-control" type="text" size="3" name="km" value = "<?=(!empty ($lesFrais[1]['quantite'])) ? $lesFrais[1]['quantite'] :''  ?>"/></td>
				<td width="80"> 
				
				
					<select size="3" name="situ" class="form-control">
						<option value="CR">Enregistré</option>
						<option value="VA">Validé</option>
						<option value="RB">Remboursé</option>
					</select>
				</td>
			</tr>
		</table>
		
		<p class="titre" /><div style="clear:left;"><h2>Hors Forfait</h2></div>
		<table class="table table-bordered table-responsive">
			<tr><th>Date</th><th>Libellé </th><th>Montant</th><th>Situation</th></tr>
			
			
			<?php
			
			
			
			if (isset($lesFraisHf))
			{
			foreach($lesFraisHf as $key => $unFraisHf)
						   {  ?>
				<tr align="center"> <input type ="hidden" name = "hfId<?=$key?>" value = "<?=(!empty($unFraisHf['id'])) ? $unFraisHf['id'] :''  ?>">
				<td width="100"><input class="form-control" type="text" size="12" name="hfDate<?=$key?>" value = "<?=(!empty($unFraisHf['date'])) ? $unFraisHf['date'] :''  ?>"/></td>			
				<td width="220"><input class="form-control" type="text" size="30" name="hfLib<?=$key?>"  value = "<?=(!empty($unFraisHf['libelle'])) ? $unFraisHf['libelle'] :''  ?>"/></td> 
				<td width="90"> <input class="form-control" type="text" size="10" name="hfMont<?=$key?>" value = "<?=(!empty($unFraisHf['montant'])) ? $unFraisHf['montant'] :''  ?>"/></td>
				<td width="80">
						   
				
					<select size="3" name="hfSitu<?=$key?>" class="form-control">
						<option value="CR">Enregistré</option>
						<option value="VA">Validé</option>
						<option value="RB">Remboursé</option>
					</select>
				</td>
				</tr>
						   <?php }
			}else{?>
				<tr align="center"> <input type ="hidden" name = "hfId" value = "<?=(!empty($unFraisHf['id'])) ? $unFraisHf['id'] :''  ?>">
				<td width="100"><input class="form-control" type="text" size="12" name="hfDate" value = "<?=(!empty($unFraisHf['date'])) ? $unFraisHf['date'] :''  ?>"/></td>			
				<td width="220"><input class="form-control" type="text" size="30" name="hfLib"  value = "<?=(!empty($unFraisHf['libelle'])) ? $unFraisHf['libelle'] :''  ?>"/></td> 
				<td width="90"> <input class="form-control" type="text" size="10" name="hfMont" value = "<?=(!empty($unFraisHf['montant'])) ? $unFraisHf['montant'] :''  ?>"/></td>
				<td width="80">
						   
				
					<select size="3" name="hfSitu" class="form-control">
						<option value="E">Enregistré</option>
						<option value="V">Validé</option>
						<option value="R">Remboursé</option>
					</select></td>
				</tr>
			<?php } ?>
				
				
		</table>

		<p class="titre" /><div style="clear:left;"><h2>Hors classification</h2></div>
		<table class="table table-bordered table-responsive">
			<tr><th>NbJustificatif</th><th>Montant</th><th>Situation</th></tr>
			
				<tr align="center">
				<td width="100"><input class="form-control" type="text" size="12" name="hfDate" value = "<?=(!empty($infosFrais['nbJustificatifs'])) ? $infosFrais['nbJustificatifs'] :''?>"/></td>			
				<td width="220"><input class="form-control" type="text" size="30" name="hfLib"  value = "<?=(!empty($montantTt)) ? $montantTt :''?>"/></td> 
				<td width="80">
						   
				
					<select size="3" name="hfSitu1" class="form-control">
						<option value="E">Enregistré</option>
						<option value="V">Validé</option>
						<option value="R">Remboursé</option>
					</select></td>
					
				</tr>
		</table>		
		
		
		<p class="titre" /><label class="titre">&nbsp;</label>
		<input class="btn btn-default" class="zone"type="reset" />
		<input class="btn btn-default" class="zone"type="submit" value="Valider" />
	</form>
	
</div>
</body>
</html>