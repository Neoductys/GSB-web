<html>
<head>
	<title>connexion</title>
	<link rel="stylesheet"
				media="screen"
				type="test/css"
				title="CSS"
				href="csstest.css"/>
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	
	<script type="text/javascript">
	function verifChamps()
	{
		if (
			(document.getElementById("log").value=="")||(document.getElementById("mdp").value=="")
            )
		{
			alert("Remplir tous les champs");
			return false;
		}
	}
	</script>
</head>

<body id="basicBody">
<div class="col-md-12" id="titre">Connectez vous</div>
	<div class="col-md-4" id="corps" style="margin-left:35%;">
		<div class="col-md-12" id="intitule">
			Session Visiteur
		</div>
		  	<form method="post" action="identificationVisiteur.php" name="identification" onSubmit="return verifChamps()">
		    
				<div class="col-md-6" style="margin-bottom:10px;">Votre login : <input type="text" name="log" id="log" size="25" maxlength="25"/></div>
				<div class="col-md-6">Votre mot de passe :<input type="password" name="mdp" id="mdp" size="25" maxlength="25"/></div>

				<div class="col-md-12">
		        	<input face="Comic Sans MS" type="submit" name="validation" value="Demande de connexion"/>
		        </div>

				<div class="col-md-12" size="4">Si 
			        vous &ecirc;tes nouvel utilisateur vous devez
			        remplir le <a href="formulaireInscriptionVisiteur.html">formulaire d'inscription</a>.
		        </div>   
			</form>
	</div>
</body>
</html>
