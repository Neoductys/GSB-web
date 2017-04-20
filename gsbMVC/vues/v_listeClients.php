
     
        
			  
			<fieldset id = "tableau">
				 <h2 id="titre" style = "text-align : center;" >Listes des client</h2>
				 <table class="table table-striped table-hover table-bordered table-responsive">
						  
						   <tr>
							   <th>Visiteur</th>
							   <th>Adresse</th>
							   <th>Ville</th>
							   <th>dateEmbauche</th>
							   <th>Les fiches de frais</th>
						   </tr>
					<?php
						foreach ($lesClients as $unClients)
						{
							$Visiteur = $unClients['prenom'] . " " . $unClients['nom'];
							$adresse = $unClients['adresse'];
							$ville = $unClients['ville'];
							$dateEmbauche = $unClients['dateEmbauche'];
							$idVisiteur = $unClients['id'];
					?>
					
						<tr>
							   <td><?php echo $Visiteur?></td>
							   <td><?php echo $adresse?></td>
							   <td><?php echo $ville?></td>
							   <td><?php echo $dateEmbauche?></td>
							   <td><a href="index.php?uc=fichesFrais&action=detailClients&visiteur=<?php echo $idVisiteur?>">fiches de frais</a></td>
						</tr>
						
							 <?php
							 }
					?>
				</table>
			
		    </fieldset>
	
		        

  