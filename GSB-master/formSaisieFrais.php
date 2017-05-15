<?php
	include('connect.php');

?>
<html>
<head>
	
	<title>Gestion des frais de visite</title>
	
	<?php include("hautConnecteVisiteur.php");?>
	
	<script language="javascript">
	
        function ajoutLigne( pNumero){//ajoute une ligne de produits/qté à la div "lignes"     
			//masque le bouton en cours
			document.getElementById("but"+pNumero).setAttribute("hidden","true");	
			pNumero++;										//incrémente le numéro de ligne
            var laDiv=document.getElementById("lignes");	//récupère l'objet DOM qui contient les données
			var titre = document.createElement("label") ;	//crée un label
			laDiv.appendChild(titre) ;						//l'ajoute à la DIV
			titre.setAttribute("class","titre") ;			//définit les propriétés
			titre.innerHTML= "   "+ pNumero + " : ";
			//zone our la date du frais
			var ladate = document.createElement("input");
			laDiv.appendChild(ladate);
			ladate.setAttribute("name","FRA_AUT_DAT"+pNumero);
			ladate.setAttribute("size","12"); 
			ladate.setAttribute("class","zone");
			ladate.setAttribute("type","text");	
			//zone de saisie pour un nouveau libellé			
			var libelle = document.createElement("input");
			laDiv.appendChild(libelle);
			libelle.setAttribute("name","FRA_AUT_LIB"+pNumero);
			libelle.setAttribute("size","30"); 
			libelle.setAttribute("class","zone");
			libelle.setAttribute("type","text");
			//zone de saisie pour un nouveau montant		
			var mont = document.createElement("input");
			laDiv.appendChild(mont);
			mont.setAttribute("name","FRA_AUT_MONT"+pNumero);
			mont.setAttribute("size","3"); 
			mont.setAttribute("class","zone");
			mont.setAttribute("type","text");			
			var bouton = document.createElement("input");
			laDiv.appendChild(bouton);
			//ajoute une gestion évenementielle en faisant évoluer le numéro de la ligne
			bouton.setAttribute("onClick","ajoutLigne("+ pNumero +");");
			bouton.setAttribute("type","button");
			bouton.setAttribute("value","+");
			bouton.setAttribute("class","zone");	
			bouton.setAttribute("id","but"+ pNumero);				
        }

		function effacer(value_defaut, type)
		{
			truk=document.getElementById(id);
			type=truk.tagName;
			type=type.toLowerCase();
			   if (type=='input')
			   {
			      if (truk.value==value_defaut)
			         truk.value='';
			   }
			   else if (type=='textarea')
			   {
			      if (truk.innerHTML==value_defaut)
			         truk.innerHTML='';
			   }
		}
    </script>
	</head>
	<body id="basicBody">
		<div class='col-md-6' id="corps_saisie">
			<form name="formSaisieFrais" method="post" action="enregSaisieFrais.php">
				<div class="col-md-4" id="titreFrais">Saisie de vos frais de d&eacute;placements</div>
				<div class="col-md-12" style="margin-bottom:20px;">Code utilisateur : 
					<?php
						if (isset($_COOKIE['id']))
							echo $_COOKIE['id'];
						else
							echo "Identifiant introuvable, veuillez vous reconnecter";
					?>
				</div>
				<div class="col-md-12" id="intitule">Periode d'engagement :</div>
				
				<div class="col-md-12">
					<div class="col-md-2">*Mois : </div>
						<div class="col-md-5">
							<select name="FRA_MOIS" class="zone">
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
				</div>
				<div class="col-md-12" style="margin-top:5px;">
					<div class="col-md-2">*Ann&eacute;e : </div>
					<div class="col-md-5"><input name="FRA_AN" class="zone" size=4 value = "<?php echo date("Y");?>"/></div>
				</div>
				<div class="col-md-12" id="intitule">Frais au forfait</div>

				<div class="col-md-12">
					<div class="col-md-3">Repas midi : <input value=0 type="text" size="2" name="FRA_REPAS" class="zone" /></div>
					<div class="col-md-3">Nuit&eacute;es : <input value=0 type="text" size="2" name="FRA_NUIT" class="zone" /></div>
					<div class="col-md-3">Etape : <input value=0 type="text" size="5" name="FRA_ETAP" class="zone" /></div>
					<div class="col-md-3">Km : <input value=0 type="text" size="5" name="FRA_KM" class="zone" /></div>
				</div>

				<div class="col-md-12 titre" id='intitule'>Hors Forfait</div>
				<div class='col-md-12'>
					<div class='col-md-3'>Libell&eacute;</div>
					<div class="col-md-3"><input style="background-color: transparent; text-shadow: 0 1px 0 #fff;" placeholder="Saisir le motif du frais" type="text" size="60" name="FRA_AUT_LIB1"/></div>

				</div>

				<div class='col-md-12' style="margin-top:5px;">
					<div class='col-md-3'>Montant(&euro;)</div>
					<div class="col-md-3"><input value ="0" class="zone" size="3" name="FRA_AUT_MONT1" type="text" /></div>
				</div>

				<div class="col-md-12" style="margin-bottom:10px; margin-top:30px;">
					<input style ="margin-left:40px;" class="zone"type="reset" />
					<input style = "margin-left:20px;" class="zone"type="submit" />
				</div>
			</form>
		</div>
		<?php
		include('footer.php');
		?>
	</body>
</html>
