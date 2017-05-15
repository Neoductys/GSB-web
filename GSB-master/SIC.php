<html>
	<head>
	<title>
	Laboratoire Galaxy Swiss Bourdin
	</title>
	<?php include("hautConnecteComptable.php");?>
<div id="corps2">
<center>

<h2>Syst&egrave;me Informatique</h2>
<p align="center"><img src="images/ReseauGSB.png"></p>
</br>
<p>Principales fonctions des serveurs : DHCP, DNS, Annuaire et gestion centralis&eacute;e des environnements, Intranet, Messagerie, Agenda partag&eacute;.
</p>
<p>Les applications m&eacute;tiers : Base d&apos;information pharmaceutique, Serveur d&eacute;di&eacute;es &agrave; la recherche, Base de donn&eacute;es, Progiciel de Gestion int&eacute;gr&eacute;.
</p>



<h2>Organisation du r&eacute;seaux avec ces diff&eacute;rents services</h2>
<p align="center"><img src="images/Organisation.png"></p>
</br>
<p>Le &egrave;me informatique de l&apos;entreprise sur le site de Paris est compos&eacute; de tous les services administratifs, d&apos;un service labo-recherche, &apos;un service juridique et d&apos;un service communication.
</p>
<p>Les serveurs sont install&eacute;s dans une salle s&eacute;curis&eacute;e situ&eacute;e au 6&egrave;me &eacute;tage du b&acirc;timent. Seules les personnes &eacute;quip&eacute;es d&apos;une cl&eacute; de s&eacute;curit&eacute; ou d&apos;un badge auront acc&egrave;s &agrave; cette salle.
</p>


<h2>Segmentation</h2>
</br>

<table WIDTH="80%" CELLSPACING="3" BORDER="3" CELLPADDING="3">
<tr><td>N&deg;VLAN</td><td>Service</td><td>Adressage IP</td></tr>
<tr><td>10</td><td>R&eacute;seau & Syst&egrave;me</td><td>192.168.10.0/24</td></tr>
<tr><td>20</td><td>Direction / DSI</td><td>192.168.20.0/24</td></tr>
<tr><td>30</td><td>RH / Compta / Juridique / Secr&eacute;tariat Administratif</td><td>192.168.30.0/24</td></tr>
<tr><td>40</td><td>Communication / R&eacute;daction</td><td>192.168.40.0/24</td></tr>
<tr><td>50</td><td>D&eacute;veloppement</td><td>192.168.50.0/24</td></tr>
<tr><td>60</td><td>Commercial</td><td>192.168.60.0/24</td></tr>
<tr><td>70</td><td>Labo-Recherche</td><td>192.168.70.0/24</td></tr>
<tr><td>100</td><td>Accueil</td><td>192.168.100.0/24</td></tr>
<tr><td>150</td><td>Visiteurs</td><td>192.168.150.0/24</td></tr>
<tr><td>200</td><td>D&eacute;monstration</td><td>192.168.200.0/24</td></tr>
<tr><td>300</td><td>Serveurs</td><td>172.16.0.0/24</td></tr>
<tr><td>400</td><td>Sortie</td><td>172.18.0.0/30</td></tr>
</table>
</center>
	

<p>Les r&egrave;gles actuelles concernant les vlans sont les suivantes :
</p>
<ul>
<li>Chaque vlan sauf le vlan visiteur peut uniquement acc&eacute;der, quel que soit le protocole aux vlans "Serveurs" et "Sortie".</li>
<li>Le vlan "Visiteurs" peut uniquement acc&eacute;der aux serveur dns et dhcp et  sortir sur internet.</li>
<li>L&apos;adresse IP de chaque vlan est la premi&egrave;re adresse imm&eacute;diatement disponible du r&eacute;seau.</li>
</ul>

<center>
	<h2>Les Equipements</h2>
</br>
<p>Les &eacute;quipements informatiques sont fortement r&eacute;pandus sur le site,   puisque chaque employ&eacute; est &eacute;quip&eacute; d&apos;un poste fixe reli&eacute; au r&eacute;seau, ces &eacute;quipements correspondent &agrave; plus de 350 terminaux. De plus l&apos;entreprise compte un certain nombre de station de travail plus adapt&eacute; &agrave; la partie labo recherche, des PC portables pour les diff&eacute;rents services en ayant l&apos;utilit&eacute;.
</p>
<p>Pour les visiteurs m&eacute;dicaux deux situation sont possibles soit ils re&ccedil;oivent une indemnit&eacute; bisannuelle pour s'&eacute;quiper en informatique (politique Swiss-Bourdin) soit une dotation en &eacute;quipement (politique Galaxy). 
</p>
<p>L&apos;entreprise est &eacute;quip&eacute;e de la fibre optique pour relier les diff&eacute;rents services, d&apos;une multitude de serveur, d&apos;un commutateur MUTLAB, d&apos;un routeur. Chaque salle de r&eacute;union dispose d&apos;un vid&eacute;oprojecteur, d&apos;enceintes et d&apos;un tableau num&eacute;rique interactif. Plusieurs points d&apos;acc&egrave;s wifi sont disponible au sein de l&apos;entreprise.
</p>
</center>
</div>
	</body>
</html>
</div>
	</body>
</html>