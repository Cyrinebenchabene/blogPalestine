<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Accueil - Palestine Blog</title>

    <style>
        /* CSS pour le header */
        .top-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #138808; /* Vert associé à la Palestine */
            padding: 8px 0;
            z-index: 1000;
        }

        .top-nav .wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 32px;
        }

        .top-nav .logo-icon img {
            max-height: 40px;
        }

        .top-nav nav ul {
            display: flex;
            list-style: none;
        }

        .top-nav nav ul li {
            margin-right: 20px;
        }

        .top-nav nav ul li:last-child {
            margin-right: 0;
        }

        .top-nav nav ul li a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 14px;
        }

        /* CSS pour le footer */
        .footer-container {
            background-color: #138808; /* Vert associé à la Palestine */
            color: #fff;
            padding: 40px 0; /* Agrandir l'espace entre le contenu et le footer */
            text-align: center;
        }

        .footer-right p {
            margin: 5px;
        }

        /* CSS pour les sections */
        .container {
            padding-top: 100px; /* Agrandir l'espace entre le header et le contenu */
            padding-bottom: 40px; /* Ajustement de l'espacement en bas */
            max-width: 800px; /* Limite de largeur pour le contenu */
            margin: 0 auto; /* Centrage horizontal */
        }

        .section {
            margin-bottom: 60px; /* Ajustement de l'espacement entre les sections */
        }

        .images-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .image {
            flex: 0 0 calc(50% - 10px); /* Largeur de 50% avec espace entre les images */
            position: relative;
            border: 2px solid #138808; /* Ajout d'une bordure verte */
            border-radius: 12px; /* Arrondi des coins */
            overflow: hidden; /* Cacher le contenu débordant */
        }

        .image img {
            max-width: 100%; /* Les images occupent la largeur maximale */
            transition: transform 0.3s ease; /* Transition pour l'effet de survol */
        }

        .image:hover img {
            transform: scale(1.05); /* Zoom sur l'image au survol */
        }

        .image-text {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #138808; /* Fond associé à la Palestine */
            color: #fff;
            padding: 8px 16px;
            border-radius: 8px; /* Arrondi des coins */
            font-size: 16px;
            text-align: center;
            opacity: 0; /* Initialisation de l'opacité à 0 */
            transition: opacity 0.3s ease; /* Transition pour l'opacité */
        }

        .image:hover .image-text {
            opacity: 1; /* Affichage du texte au survol */
        }

        /* CSS pour le texte important */
        .important-text {
            background-color: #fff; /* Fond blanc pour le texte */
            border: 2px solid #138808; /* Bordure verte */
            padding: 20px; /* Espacement interne */
            text-align: center; /* Centrage du texte */
            margin-bottom: 60px; /* Ajustement de l'espacement en bas */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Légère ombre portée */
            border-radius: 12px; /* Arrondi des coins */
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="top-nav">
        <div class="wrapper">
            <nav>
                <ul>
                    <li><a href="acceuil.php">Accueil</a></li>
                    <li><a href="logiin.php">Connexion</a></li>
                    <li><a href="creation.php">Inscription</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Contenu de la page d'accueil -->
    <div class="container">
        <div class="section">
            <h2 style="color: #138808; text-align: center;">Bienvenue sur Palestine Blog</h2>
        </div>

        <div class="section">
            <div class="important-text">
                <p> فلسطين ذلك الجرح الذي لا يندمل؛ جرح نتأجج ألمًا لما تعانيه من مواجع وويلات الاحتلال الغاصب، فإنها قضيتنا الأولى غير القابلة للنقاش ولا النقض أبدًا، فإننا نعيش حالة عشق لفلسطين عروس عروبتنا، ونجزم دون أن نأبه بأن نظلم من لا يعتبر فلسطين وطنًا له ولا قضيته بأنه مجرد من الإنسانية.</p>
           <p>"Palestine est cette plaie qui ne guérit jamais ; une plaie qui brûle de douleur à cause des souffrances et des tourments infligés par l'occupation oppressante. C'est notre cause principale, indéniable et inébranlable. Nous vivons dans un état d'amour passionné pour la Palestine, la fiancée de notre identité arabe. Nous affirmons sans équivoque que quiconque ne considère pas la Palestine comme sa patrie et sa cause la prive injustement de son humanité."</p>
            </div>
        </div>

        <div class="section images-container">
            <div class="image">
                <img src="pa.png" alt="Palestine 1">
                <div class="image-text">Palestine Blog</div>
            </div>
            <div class="image">
                <img src="p2.jpg" alt="Palestine 2">
                <div class="image-text">Palestine Blog</div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-right">
            <p>Tous droits réservés &copy; 2024</p>
            </div>
        </div>
    </footer>
</body>
</html>
