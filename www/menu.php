<div class="navbar navbar-default navbar-static-top " role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="accueil.php">Extranet - ADPC92</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="accueil.php">Accueil</a></li>
            <li><a href="#">Lien</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Operationnel <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
				<li class="dropdown-header">Direction départementale</li>
				<li><a href="list-dps.php?filter=en-attente">A traîter <span class="badge">118</span></a></li>
					<li class="divider"></li>
                <li class="dropdown-header">Gestion des DPS</li>
				<li><a href="list-dps.php?commune=0">Liste des DPS de l'Antenne</a></li>
				<li><a href="list-dps.php">Liste de tous les DPS</a></li>
					<li class="divider"></li>
                <li><a href="demande-dps.php">Demande de DPS</a></li>
					<li class="divider"></li>
				<li class="dropdown-header">Réglages oppérationnels</li>
				<li><a href="list-organisateur.php">Liste des organisateurs</a></li>
				<li><a href="add-organisateur.php">Ajouter un organisateur</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bureau <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
				<li class="dropdown-header">Trésorerie</li>
				<li><a href="tresorerie.php?filter=accepted">Trésorerie</a></li>
				<li><a href="devis.php">Devis</a></li>
				<li><a href="factures.php">Factures</a></li>
              </ul>
            </li>
			<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Adminsitration <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
				  <li><a href="liste-commune.php">Liste des communes</a></li>
					<li class="divider"></li>
					<li class="dropdown-header">Super Admin</li>
				  <li><a href="role.php">Gestion des rôles</a></li>
        </ul>
      </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
		  <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> admin admin <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
				<li class="disabled"><a href="modifier-mdp.php">Modifier son mot de passe</a></li>
            <li><a href="index.php?erreur=logout">Déconnexion</a></li>
			</li>
          </ul>
        </div><!--/.nav-collapse -->
