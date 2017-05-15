<form name="recherche" action="listeFrais.php" method="POST">
<?php
				include('connect.php');
				//$connect=mysqli_connect("localhost","root","root","gsb");
				$req = "SELECT nom, prenom FROM users WHERE status=1";
				$names = mysqli_query($connect, $req) or die ("requête non executé");
				//$names = $resultat->fetch_assoc();
				//if (!$resultat) { echo "Pas de résultat dans la base de données!!"; exit;} 
	?>
	<div class="col-md-offset-3" id='liste'>
		<label class="titre">Choisir le visiteur :</label>
		<select id="lstVisiteur" name="lstVisiteur" class="zone">
			<?php
				foreach($names as $name){
			?>
					<option><?php echo $name['nom']; ?></option>
			<?php
				}
			?>
		</select>

		<label class="titre">Mois :</label>
		<select id="dateValid" name="dateValid" class="zone">
			<option>Janvier</option>
			<option>F&eacute;vrier</option>
			<option>Mars</option>
			<option>Avril</option>
			<option>Mai</option>
			<option>Juin</option>
			<option>Juillet</option>
			<option>Aout</option>
			<option>Septembre</option>
			<option>Octobre</option>
			<option>Novembre</option>
			<option>D&eacute;cembre</option>
		</select>
	</div>
	<div class="col-md-offset-2">
		<input type="submit" value="Afficher" name="bouton"/>
	</div>
</form>
	