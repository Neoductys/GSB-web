	
	 <fieldset id = "tableau">
	  <table class="table table-striped table-hover table-bordered .table-responsive">
			 <h2 id="titre" style = "text-align : center;" >Listes des fiches en attentes</h2>
			   <tr>
				   <th>Visiteur</th>
				   <th>Mois</th>
				   <th>Nombre de justificatifs</th>
				   <th>Date de modification</th>
				   <th>Validation</th>
				   <th>Details</th>
			   </tr>
		<?php
			foreach ($lesFiches as $uneFiche)
			{
				$Visiteur = $uneFiche['prenom'] . " " . $uneFiche['nom'];
				$mois = $uneFiche['mois'];
				$justificatifs = $uneFiche['nbJustificatifs'];
				$dateModif = $uneFiche['dateModif'];
				$idVisiteur = $uneFiche['idVisiteur'];
			
		?>
	
			<tr>
				   <td><?php echo $Visiteur?></td>
				   <td><?php echo $mois?></td>
				   <td><?php echo $justificatifs?></td>
				   <td><?php echo $dateModif?></td>
					<td><a href="index.php?uc=fichesFrais&action=validerFiche&visiteur=<?php echo $idVisiteur?>&mois=<?php echo $mois?>&justificatifs=<?php echo $justificatifs?>&dateModif=<?php echo $dateModif?>" target="_blank"> <input type="button" value="Valider la demande"> </a> </td>
					<td><a href="index.php?uc=fichesFrais&action=details&visiteur=<?php echo $idVisiteur?>&mois=<?php echo $mois?>">Details</a></td>
			</tr>
			
				 <?php
			}
		?>
		  </table>
	 </fieldset>
	 

		  
		        

  