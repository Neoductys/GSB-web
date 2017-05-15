<?php



	/*	connection to the serveur GSB	*/
		
		$connect=mysqli_connect("localhost","root","","gsb") or die ("Connexion à " . SERVEUR . " impossible");
		
//function hash($mdp)
//{
    //$mdp = '$mdp';
    //$grain = 'b54sFmjJ52';
    //$sel = 'a12Gfd51gzR';
    //$mdp = md5(sha1($grain) . sha1($mdp) . sha1($sel));
 
    //return($mdp);
//}



	/* check the connection to the server */
		if (mysqli_connect_errno()) {
		    printf("Échec de la connexion : %s\n", mysqli_connect_error());
		exit();
	}
?>
