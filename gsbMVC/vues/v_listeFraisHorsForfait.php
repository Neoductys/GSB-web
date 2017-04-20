
<table class="table table-striped table-hover table-bordered table-responsive">
  	   
          
    <?php    
	    foreach( $lesFraisHorsForfait as $unFraisHorsForfait) 
		{
			$libelle = $unFraisHorsForfait['libelle'];
			$date = $unFraisHorsForfait['date'];
			$montant=$unFraisHorsForfait['montant'];
			$id = $unFraisHorsForfait['id'];
	?>		
            <tr>
                <td> <?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
                <td><a href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=<?php echo $id ?>" 
				onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer ce frais</a></td>
             </tr>
	<?php		 
          
          }
	?>	  
                      <legend>Nouvel élément hors forfait
            </legend>                    
 
      <form id ="widef" action="index.php?uc=gererFrais&action=validerCreationFrais" method="post">
    
         
          <fieldset >
			<table class="table table-striped table-hover table-bordered table-responsive">
				 
							<tr>
							   <th>Date (jj/mm/aaaa):</th>
							   <th>Libellé</th>
							   <th>Montant :</th>
							   
						   </tr>
						   <tr>
								<td> <input class="btn btn-default" type="text" id="txtDateHF" name="dateFrais" size="10" maxlength="10" value=""  /></td>
							   <td> <input class="btn btn-default" type="text" id="txtLibelleHF" name="libelle" size="70" maxlength="256" value="" /></td>
							   <td><input class="btn btn-default" text" id="txtMontantHF" name="montant" size="10" maxlength="10" value="" /></td>
							</tr>
              <!--<label for="txtDateHF">Date (jj/mm/aaaa): </label>
              <input class="btn btn-default" type="text" id="txtDateHF" name="dateFrais" size="10" maxlength="10" value=""  />
            
            
              <label for="txtLibelleHF">Libellé</label>
              <input class="btn btn-default" type="text" id="txtLibelleHF" name="libelle" size="70" maxlength="256" value="" />
            
            
              <label for="txtMontantHF">Montant : </label>
              <input class="btn btn-default" text" id="txtMontantHF" name="montant" size="10" maxlength="10" value="" />
            -->
			</table>
          </fieldset>
     
      <div class="piedForm">
      <p>
        <input class="btn btn-default" id="ajouter" type="submit" value="Ajouter" size="20" />
        <input class="btn btn-default" id="effacer" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form>
	  </div>
  </div>
  

