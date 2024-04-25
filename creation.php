<?php
    session_start();

    require("connect.php"); 
    // Database connection file

    if (isset($_POST['cree'])) {
        // Retrieve form database
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Hash the password (recommended)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Create a PDO instance (assuming $conn is already defined in connect.php)
            $stmt = $conn->prepare("INSERT INTO signup (nom, prenom, email, password) 
                                    VALUES (:nom, :prenom, :email, :password)");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            
            // Execute the query
            $stmt->execute();

           // Redirect the user to a success page
           header("Location: blog.php");
           exit();
       } catch(PDOException $e) {
           // Handle database errors
           echo "Erreur : " . $e->getMessage();
       }
   }
   ?>
    
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Inscription</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Roboto", sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .top-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #138808; /* Changement de couleur de la barre de navigation */
            padding: 8px 0;
            z-index: 1000;
        }

        .top-nav .wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 32px;
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

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 80px);
            padding-top: 80px;
        }

        .login-form {
            background-color: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 80%;
        }

        .login-form h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #138808; /* Changement de couleur du titre */
            font-size: 32px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 25px;
            background-color: #f2f2f2;
            transition: background-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            background-color: #e0e0e0;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 25px;
            background-color: #138808; /* Changement de couleur du bouton */
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0f6b06;
        }

        #creer {
            display: block;
            text-align: center;
            color: #138808; /* Changement de couleur du lien */
            text-decoration: none;
            margin-top: 10px;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        #creer:hover {
            color: #0f6b06; /* Changement de couleur au survol */
        }

        footer {
            background-color: #138808; /* Changement de couleur du pied de page */
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }

    </style>
</head>
<body>
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

    <div class="login-container">
        <form action="blog.php" method="POST" class="login-form">
            <h2>Inscription</h2>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="cree">S'inscrire</button>
            <a href="logiin.php" id="creer">Se connecter</a>
        </form>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-right">
                <p>Tous droits réservés &copy; 2024</p>
            </div>
        </div>
    </footer>
</body>
</html>
