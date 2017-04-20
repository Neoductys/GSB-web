<div id="contenu">
	<div id="FF">
      <h2>Renseigner ma fiche de frais du mois <?php echo $numMois."-".$numAnnee ?></h2>
         
        <form class="form-inline" method="POST"  action="index.php?uc=gererFrais&action=validerMajFraisForfait">
	
			  <fieldset>
				
				<legend>Eléments forfaitisés
				</legend>
				<?php
					foreach ($lesFraisForfait as $unFrais)
					{
						$idFrais = $unFrais['idfrais'];
						$libelle = $unFrais['libelle'];
						$quantite = $unFrais['quantite'];
				?>
						<p>
							<label for="idFrais"><?php echo $libelle ?></label>
							<input class="btn btn-default" type="text" id="idFrais" name="lesFrais[<?php echo $idFrais?>]" size="10" maxlength="5" value="<?php echo $quantite?>" >
						</p>
						
				<?php
					}
				?>
										<!-- <p> <label> Puissance en chevaux </label></p>
										<input class="btn btn-default type="text" id="idFrais" name="Puissance" size="10" maxlength="5" value="3" > -->
			  </fieldset>
		  
		  <div class="piedForm">
		  <p>
			<input class="btn btn-default" id="ok" type="submit" value="Valider" size="20" />
			<input class="btn btn-default" id="annuler" type="reset" value="Effacer" size="20" />
		  </p> 
		  </div>
        
		</form>
		
        
  