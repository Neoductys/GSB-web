

        
			  
			  <fieldset id = "tableau">
			  <table class="table table-striped table-hover table-bordered table-responsive">
					    <h2 id="titre" style = "text-align : center;" >archives de 2016</h2>
					   <tr>
						   <th>Visiteur</th>
						   <th>Mois</th>
						   <th>Nombre de justificatifs</th>
						   <th>Date de modification</th>
						   <th>Etat</th>
						   <th>Details</th>
					   </tr>
				<?php
					foreach ($lesArchives as $uneFiche)
					{
						$Visiteur = $uneFiche['prenom'] . " " . $uneFiche['nom'];
						$mois = $uneFiche['mois'];
						$justificatifs = $uneFiche['nbJustificatifs'];
						$dateModif = $uneFiche['dateModif'];
						$idVisiteur = $uneFiche['idVisiteur'];
					    $etat = $uneFiche['libelle'];
						$rest = substr($mois, 0, -2);
						
						if( $rest == '2016')
						{
							
						
				?>
				
					<tr>
						   <td><?php echo $Visiteur?></td>
						   <td><?php echo $mois?></td>
						   <td><?php echo $justificatifs?></td>
						   <td><?php echo $dateModif?></td>
						   <td><?php echo $etat?></td>
						<td><a href="index.php?uc=fichesFrais&action=details&visiteur=<?php echo $idVisiteur?>&mois=<?php echo $mois?>">Details</a></td>
					</tr>
					
						 <?php
						}
					}
				?>
				  </table>
			 </fieldset>
			 
			   <fieldset id = "tableauPercent">
			  <table class="table table-striped table-hover table-bordered table-responsive">
					    <h2 id="titre" style = "text-align : center;" >archives de 2015</h2>
					   <tr>
						   <th>Visiteur</th>
						   <th>Mois</th>
						   <th>Nombre de justificatifs</th>
						   <th>Date de modification</th>
						   <th>Etat</th>
						   <th>Details</th>
					   </tr>
				<?php
					foreach ($lesArchives as $uneFiche)
					{
						$Visiteur = $uneFiche['prenom'] . " " . $uneFiche['nom'];
						$mois = $uneFiche['mois'];
						$justificatifs = $uneFiche['nbJustificatifs'];
						$dateModif = $uneFiche['dateModif'];
						$idVisiteur = $uneFiche['idVisiteur'];
					    $etat = $uneFiche['libelle'];
						$rest = substr($mois, 0, -2);
						
						if( $rest == '2015')
						{
							
						
				?>
				
					<tr>
						   <td><?php echo $Visiteur?></td>
						   <td><?php echo $mois?></td>
						   <td><?php echo $justificatifs?></td>
						   <td><?php echo $dateModif?></td>
						   <td><?php echo $etat?></td>
							<td><a href="index.php?uc=fichesFrais&action=details&visiteur=<?php echo $idVisiteur?>&mois=<?php echo $mois?>">Details</a></td>
					</tr>
					
						 <?php
							}
					}
				?>
				  </table>
			 </fieldset>
			 </br>
			 </br>
			 <fieldset id = "tableauPercent">
			  <table class="table table-striped table-hover table-bordered table-responsive">
					    <h2 id="titre" style = "text-align : center;" >archives de 2014</h2>
					   <tr>
						   <th>Visiteur</th>
						   <th>Mois</th>
						   <th>Nombre de justificatifs</th>
						   <th>Date de modification</th>
						   <th>Etat</th>
						   <th>Details</th>
					   </tr>
				<?php
					foreach ($lesArchives as $uneFiche)
					{
						$Visiteur = $uneFiche['prenom'] . " " . $uneFiche['nom'];
						$mois = $uneFiche['mois'];
						$justificatifs = $uneFiche['nbJustificatifs'];
						$dateModif = $uneFiche['dateModif'];
						$idVisiteur = $uneFiche['idVisiteur'];
					    $etat = $uneFiche['libelle'];
						$rest = substr($mois, 0, -2);
						
						if( $rest == '2014')
						{
							
						
				?>
				
					<tr>
						   <td><?php echo $Visiteur?></td>
						   <td><?php echo $mois?></td>
						   <td><?php echo $justificatifs?></td>
						   <td><?php echo $dateModif?></td>
						   <td><?php echo $etat?></td>
							<td><a href="index.php?uc=fichesFrais&action=details&visiteur=<?php echo $idVisiteur?>&mois=<?php echo $mois?>">Details</a></td>
					</tr>
					
						 <?php
						}
					}
				?>
				  </table>
			 </fieldset>
			 </br>
			 </br>
			   <fieldset id = "tableauPercent">
			  <table class="table table-striped table-hover table-bordered .table-responsive">
					   <h2 id="titre" style = "text-align : center;" >archives de 2013</h2>
					   <tr>
						   <th>Visiteur</th>
						   <th>Mois</th>
						   <th>Nombre de justificatifs</th>
						   <th>Date de modification</th>
						   <th>Etat</th>
						   <th>Details</th>
					   </tr>
				<?php
					foreach ($lesArchives as $uneFiche)
					{
						$Visiteur = $uneFiche['prenom'] . " " . $uneFiche['nom'];
						$mois = $uneFiche['mois'];
						$justificatifs = $uneFiche['nbJustificatifs'];
						$dateModif = $uneFiche['dateModif'];
						$idVisiteur = $uneFiche['idVisiteur'];
					    $etat = $uneFiche['libelle'];
						$rest = substr($mois, 0, -2);
						
						if( $rest == '2013')
						{
							
						
				?>
				
					<tr>
						   <td><?php echo $Visiteur?></td>
						   <td><?php echo $mois?></td>
						   <td><?php echo $justificatifs?></td>
						   <td><?php echo $dateModif?></td>
						   <td><?php echo $etat?></td>
							<td><a href="index.php?uc=fichesFrais&action=details&visiteur=<?php echo $idVisiteur?>&mois=<?php echo $mois?>">Details</a></td>
					</tr>
					
						 <?php
							}
					}
				?>
				  </table>
			 </fieldset>
			 </br>
			 </br>
			    <fieldset id = "tableauPercent">
			  <table class="table table-striped table-hover table-bordered .table-responsive">
					  <h2 id="titre" style = "text-align : center;" >archives de 2012</h2>
					   <tr>
						   <th>Visiteur</th>
						   <th>Mois</th>
						   <th>Nombre de justificatifs</th>
						   <th>Date de modification</th>
						   <th>Etat</th>
						   <th>Details</th>
					   </tr>
				<?php
					foreach ($lesArchives as $uneFiche)
					{
						$Visiteur = $uneFiche['prenom'] . " " . $uneFiche['nom'];
						$mois = $uneFiche['mois'];
						$justificatifs = $uneFiche['nbJustificatifs'];
						$dateModif = $uneFiche['dateModif'];
						$idVisiteur = $uneFiche['idVisiteur'];
					    $etat = $uneFiche['libelle'];
						$rest = substr($mois, 0, -2);
						
						if( $rest == '2012')
						{
							
						
				?>
				
					<tr>
						   <td><?php echo $Visiteur?></td>
						   <td><?php echo $mois?></td>
						   <td><?php echo $justificatifs?></td>
						   <td><?php echo $dateModif?></td>
						   <td><?php echo $etat?></td>
							<td><a href="index.php?uc=fichesFrais&action=details&visiteur=<?php echo $idVisiteur?>&mois=<?php echo $mois?>">Details</a></td>
					</tr>
					
						 <?php
							}
					}
				?>
				  </table>
			 </fieldset>
			 </br>
			 </br>
			    <fieldset id = "tableauPercent">
			  <table class="table table-striped table-hover table-bordered .table-responsive">
					    <h2 id="titre" style = "text-align : center;" >archives de 2011</h2>
					   <tr>
						   <th>Visiteur</th>
						   <th>Mois</th>
						   <th>Nombre de justificatifs</th>
						   <th>Date de modification</th>
						   <th>Etat</th>
						   <th>Details</th>
					   </tr>
				<?php
					foreach ($lesArchives as $uneFiche)
					{
						$Visiteur = $uneFiche['prenom'] . " " . $uneFiche['nom'];
						$mois = $uneFiche['mois'];
						$justificatifs = $uneFiche['nbJustificatifs'];
						$dateModif = $uneFiche['dateModif'];
						$idVisiteur = $uneFiche['idVisiteur'];
					    $etat = $uneFiche['libelle'];
						$rest = substr($mois, 0, -2);
						
						if( $rest == '2011')
						{
							
						
				?>
				
					<tr>
						   <td><?php echo $Visiteur?></td>
						   <td><?php echo $mois?></td>
						   <td><?php echo $justificatifs?></td>
						   <td><?php echo $dateModif?></td>
						   <td><?php echo $etat?></td>
							<td><a href="index.php?uc=fichesFrais&action=details&visiteur=<?php echo $idVisiteur?>&mois=<?php echo $mois?>">Details</a></td>
					</tr>
					
						 <?php
							}
					}
				?>
				  </table>
			 </fieldset>
			 </br>
			 </br>
			    <fieldset id = "tableauPercent">
			  <table class="table table-striped table-hover table-bordered .table-responsive">
					   <h2 id="titre" style = "text-align : center;" >archives de 2010</h2>
					   <tr>
						   <th>Visiteur</th>
						   <th>Mois</th>
						   <th>Nombre de justificatifs</th>
						   <th>Date de modification</th>
						   <th>Etat</th>
						   <th>Details</th>
					   </tr>
				<?php
					foreach ($lesArchives as $uneFiche)
					{
						$Visiteur = $uneFiche['prenom'] . " " . $uneFiche['nom'];
						$mois = $uneFiche['mois'];
						$justificatifs = $uneFiche['nbJustificatifs'];
						$dateModif = $uneFiche['dateModif'];
						$idVisiteur = $uneFiche['idVisiteur'];
					    $etat = $uneFiche['libelle'];
						
						$rest = substr($mois, 0, -2);
						
						if( $rest == '2010')
						{
							
						
				?>
				
					<tr>
						   <td><?php echo $Visiteur?></td>
						   <td><?php echo $mois?></td>
						   <td><?php echo $justificatifs?></td>
						   <td><?php echo $dateModif?></td>
						   <td><?php echo $etat?></td>
							<td><a href="index.php?uc=fichesFrais&action=details&visiteur=<?php echo $idVisiteur?>&mois=<?php echo $mois?>">Details</a></td>
					</tr>
					
						 <?php
							}
					}
				?>
				  </table>
			 </fieldset>
		
	       

  