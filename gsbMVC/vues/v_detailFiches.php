<div id="contenu">
      
        
			  
			  
					  
				<?php
					foreach ($uneFiche as $laFiche)
					{
						$Visiteur = $laFiche['prenom'] . " " . $laFiche['nom'];
						$mois = $laFiche['mois'];
						$justificatifs = $laFiche['nbJustificatifs'];
						$dateModif = $laFiche['dateModif'];
						$idVisiteur = $laFiche['idVisiteur'];
						$montantValide = $laFiche['montantValide'];
						$etat = $laFiche['libelle'];
					}
					?>
					
				
						
					
					
						<h3> titulaire de la fiche : </h3> <?php echo $Visiteur ?>
						<h3> Date de derniere modification : </h3> <?php echo $dateModif ?> 
						<h3> Justificatifs : </h3> <?php echo $justificatifs ?>
						<h3> Montant Valide : </h3> <?php echo $montantValide ?>
						<h3> Etat de la fiche : </h3> <?php echo $etat ?>
						</br>
						</br>

					<h2>Details des frais forfaits</h2>
					
						<?php
					foreach ($unFraisForfait as $leFraisForfait)
					{
						$libelleFrais = $leFraisForfait['libelle'];
						$quantite = $leFraisForfait['quantite'];
						?>
						<h3>Depense en <?php echo $libelleFrais ?> : </h3> <?php echo $quantite ?>
						<?php
					}
						
				?>
					<h2>Details des frais hors-forfaits</h2>
					
						<?php
					foreach ($unFraisHorsForfait as $leFraisHorsForfait)
					{
						$libelleFrais = $leFraisHorsForfait['libelle'];
						$montant = $leFraisHorsForfait['montant'];
						$date = $leFraisHorsForfait['date'];
						?>
						<h3>Depense en <?php echo $libelleFrais ?> effectué le <?php echo $date ?>: </h3> <?php echo $montant ?>
						<?php
					}
						
				?>
						
		  </div>
		        

  