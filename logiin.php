<?php
session_start();
// Connexion à la base de données
require('connect.php');

$error = ''; // Initialize error variable

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cree'])) {
    // Vérifier si les champs email et mot de passe sont remplis
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        // Récupérer les données du formulaire
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Préparer la requête SQL pour vérifier les informations de connexion
        $query = "SELECT * FROM signup WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        
        // Exécuter la requête
        $stmt->execute();
        
        // Vérifier si l'utilisateur existe dans la base de données
        if ($stmt->rowCount() > 0) {
            // L'utilisateur existe, vérifier le mot de passe
            $user = $stmt->fetch();
          
            if ($user && password_verify($password, $user['password'])) {
                // Start session and set user email
                $_SESSION['email'] = $email;
                // Redirect to blog.php or any other page after successful login
                header("Location: blog.php");
                exit();
            } else {
                // Incorrect password
                $error = "Mot de passe incorrect.";
            }
        } else {
            // Email not found
            $error = "Adresse e-mail introuvable. Veuillez créer un compte.";
        }
    } else {
        // Handle case when 'email' or 'password' is not set in $_POST
        $error = "Veuillez fournir une adresse e-mail et un mot de passe.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap-reboot.rtl.css" rel="stylesheet">
    <title>Connexion</title>

    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap-reboot.rtl.css" rel="stylesheet">
    <title>Connexion</title>

    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap-reboot.rtl.css" rel="stylesheet">
    <title>Connexion</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Roboto", sans-serif;
            background-color: #f4f4f4;
            overflow-x: hidden;
        }

        .top-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #138808; /* Retour à la couleur verte */
            padding: 10px 0;
            z-index: 1000;
            transition: background-color 0.3s ease;
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
            transition: color 0.3s ease;
        }

        .top-nav nav ul li a:hover {
            color: #ffd700; /* Changement de couleur au survol */
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            transition: box-shadow 0.3s ease;
        }

        .login-form h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #138808; /* Retour à la couleur verte */
            font-size: 32px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #555;
            font-size: 18px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 25px;
            background-color: #f2f2f2;
            box-shadow: inset 2px 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            background-color: #e0e0e0;
            box-shadow: inset 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 25px;
            background-color: #138808; /* Retour à la couleur verte */
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0f6b06; /* Changement de couleur de fond au survol */
        }

        #creer {
            display: block;
            text-align: center;
            color: #138808; /* Retour à la couleur verte */
            text-decoration: none;
            margin-top: 20px;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        #creer:hover {
            color: #ffd700; /* Changement de couleur au survol */
        }

        footer {
            background-color: #138808; /* Retour à la couleur verte */
            color: #fff;
            padding: 20px 0;
            text-align: center;
            transition: background-color 0.3s ease;
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
                    <li>
                        <a href="acceuil.php">Accueil</a>
                        <a href="logiin.php">Connexion</a>
                        <a href="creation.php">Inscription</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="login-container">
        <form action="blog.php" method="POST" class="login-form">
            <h2>Connexion</h2>
            <?php if(!empty($error)) { ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php } ?>
            <div class="form-group">
                <label for="username">E-mail :</label>
                <input type="email" id="email" name="email" placeholder="contact@gmail.com" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="cree">Se connecter</button>
            <a href="creation.php" id="creer">Créer un compte</a>
        </form>
    </div>

    <footer>
        <div class="footer-container">
            <p>Tous droits réservés &copy; 2024</p>
        </div>
    </footer>
</body>
</html>
