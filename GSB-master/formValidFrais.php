<?php if($_COOKIE["comptable"]=="")
	header("location:choixUtil.html");
	else?>

<html>
<title>Comptable</title>
<body id="basicBody">
	<title>Gestion des frais de visite</title>
	<?php
		include("hautConnecteComptable.php");
	?>
	
	<div class="col-md-offset-5" id="corps2">
		<div class="col-md-12" id="corps2">
			<div class="col-md-12" id="titre">Choisissez un visiteur et un mois </div>
				<?php
					include('listCptEnregFrais.php');
				?>
		</div>
		<div class="col-md-12">
			<?php
				include('footer.php');
			?>
		</div>
	</div>
</body>
</html>