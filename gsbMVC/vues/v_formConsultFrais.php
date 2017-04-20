<html>
<head>
	<title>Suivi des frais de visite</title>
	<style type="text/css">
		<!-- body {background-color: white; color:5599EE; } 
			.titre { width : 180 ;  clear:left; float:left; } 
			.zone { float : left; color:7091BB } -->
	</style>
</head>


</div>


	
	<div id="suiviefrais">
		<h1> Période </h1>
		<form name="formConsultFrais" method="post" action="index.php?uc=fichesFrais&action=suivieFrais">
			<label class="titre">Mois :</label> 
				<select	name="moisValid" class="zone">
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
				<select	name="anneeValid" class="zone">
						 <option value="2010">2010</option>
						 <option value="2011">2011</option>
						 <option value="2012">2012</option>
						 <option value="2013">2013</option>
						 <option value="2014">2014</option>
						 <option value="2015">2015</option>
						 <option value="2016">2016</option>
				</select>
				
				<input class="btn btn-default" type="submit" value="Cherchez les frais de ce mois" name="valider">
		</form>		
	<form name="formConsultFrais" method="post" action="chercheFrais.php">
		<p class="titre" />
		<div><h2>Frais au forfait </h2></div>
		 <table style="color:white;" class="table table-bordered .table-responsive">
			<tr><th>Repas midi</th><th>Nuitée </th><th>Etape</th><th>Km </th><th>Situation</th><th>Date opération</th><th>Remboursement</th></tr>
			<tr align="center"><td width="80"><label  size="3" name="repas"/></td>
				<td width="80"><label size="3" name="nuitee"/></td> 
				<td width="80"> <label size="3" name="etape"/></td>
				<td width="80"> <label size="3" name="km" /></td>
				<td width="80"> <label size="3" name="situation" /></td>	
				<td width="80"> <label size="3" name="dateOper" /></td>	
				<td width="80"> <label size="3" name="dateOper" /></td>						
			</tr>
		</table>
		
		<p class="titre" /><div style="clear:left;"><h2>Hors Forfait</h2></div>
		 <table style="color:white;" class="table table-bordered .table-responsive">
			<tr><th>Date</th><th>Libellé </th><th>Montant</th><th>Situation</th><th>Date opération</th></tr>
			<tr align="center"><td width="100" ><label size="12" name="hfDate1"/></td>
				<td width="220"><label size="30" name="hfLib1"/></td> 
				<td width="90" ><label size="10" name="hfMont1"/></td>
				<td width="80"> <label size="3" name="hfSitu1" /></td>
				<td width="80"> <label size="3" name="hfDateOper1" /></td>		
				</tr>
		</table>	
		<p class="titre"></p>
		<div class="titre">Nb Justificatifs</div><input type="text" class="zone" size="4" name="hcMontant"/>
	</form>

	</div>
</div>

</html>