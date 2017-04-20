
      
      
			  
			  
	<fieldset id = "tableauFichesDuClients" >
		 <h2 id="titre" style = "text-align : center;" >Listes des fiches de frais du client</h2>
		 <table class="table table-striped table-hover table-bordered table-responsive">
					
					   <tr>
						   <th>Visiteur</th>
						   <th>Mois</th>
						   <th>Nombre de justificatifs</th>
						   <th>Date de modification</th>
						   <th>Etat</th>
							<th>Montant Valider</th>
						   <th>Validation</th>
						   <th>Details</th>
						</tr>	  
					  
					  
					  
				<?php
					
					foreach ($lesFiches as $fiche)
					{
						 $Visiteur = $fiche['prenom'] . " " . $fiche['nom'];
						 $justificatifs = $fiche['nbJustificatifs'];
						 $dateModif = $fiche['dateModif'];
						 $idVisiteur = $fiche['idVisiteur'];
						 $montantValide = $fiche['montantValide'];
						 $etat = $fiche['libelle'];
						 $mois = $fiche['mois'];
						
					?>
					<tr>
						   <td><?php echo $Visiteur?></td>
						   <td><?php echo $mois?></td>
						   <td><?php echo $justificatifs?></td>
						   <td><?php echo $dateModif?></td>
						   <td><?php echo $etat?></td>
						   <td><?php echo $montantValide?></td>
						  <?php if ($etat != "Remboursée") { ?> <td><a href="index.php?uc=gererFrais&action=validerFiche&visiteur=<?php echo $idVisiteur?>&mois=<?php echo $mois?>&justificatifs=<?php echo $justificatifs?>&dateModif=<?php echo $dateModif?>" target="_blank"> <input type="button" value="Valider la demande"> </a> </td>
						  <?php } ?>
							<td><a href="index.php?uc=fichesFrais&action=details&visiteur=<?php echo $idVisiteur?>&mois=<?php echo $mois?>">Details</a></td>
					</tr>
						
					<?php
					}
					
				?>
		</table>
	</fieldset>
		
	 </div>	
				
				
				
		
		        

  