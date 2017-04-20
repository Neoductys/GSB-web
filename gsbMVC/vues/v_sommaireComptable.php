    <!-- Division pour le sommaire -->
		</br>
		</br>
        <ul id="menu" class ="well">
			  <strong><u>Menu</u></strong> :</br></br>
				Bienvenue <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']  ?>
			<ul class="list-group">
			</br>
           <li class="list-group-item">
              <a href="index.php?uc=fichesFrais&action=fiches" title="Liste des fiches en cours">Liste des fiches en cours</a>
           </li>
		   </br>
           <li class="list-group-item">
              <a href="index.php?uc=fichesFrais&action=archives" title="Consultation de mes fiches de frais">Archives des fiches</a>
           </li>
		   </br>
		   <li class="list-group-item">
              <a href="index.php?uc=fichesFrais&action=clients" title="Liste des fiches en cours">Liste des Clients</a>
           </li>
		   </br>
		   <li class="list-group-item">
              <a href="index.php?uc=fichesFrais&action=ValidationFrais" title="ValidationFrais">Valider des frais</a>
           </li>
		   </br>
			<li class="list-group-item">
              <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
           </li>
         </ul>
		</ul>
        

    