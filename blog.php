<?php

// Start session
session_start();

// Include database connection
require('connect.php');

// Initialize the $email variable
$email = '';

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    // Retrieve the user's email from the session
    $email = $_SESSION['email'];
    
    // Prepare and execute SQL statement to fetch user's name based on email
    $stmt = $conn->prepare("SELECT email FROM commentaire  WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If user found, set $email to their email
    if ($user) {
        $email = $user['email'];
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'comm' field is set in the form submission
    if(isset($_POST['comm'])) {
        // Retrieve comment data from the form
        $comm = $_POST['comm'];
        
        // If the user is logged in, use their email; otherwise, use the provided email
        $commenter_email = isset($_SESSION['email']) ? $_SESSION['email'] : $_POST['email'];
        
        // Prepare and execute SQL statement to insert the comment into the database
        $stmt = $conn->prepare("INSERT INTO commentaire (email, comm) VALUES (?, ?)");
        $stmt->execute([$commenter_email, $comm]);

        // Redirect to blog.php
        header("Location: blog.php");
        exit();
    } else {
        // Handle the case where the 'comm' field is not set
        echo "The 'comm' field is not set in the form submission.";
    }
}

// Retrieve comments from the database
$sql = "SELECT email, comm FROM commentaire";
$result = $conn->query($sql);

// Close connection
$conn = null;
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap-reboot.min.css" rel="stylesheet">
    <title>Blog sur le contexte en Palestine</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2; /* Couleur de fond légèrement grisée */
            color: #333;
        }
        header {
            background-color: #238636; /* Vert foncé */
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px; /* Ajouter de l'espace en dessous de l'en-tête */
            border-bottom: 4px solid #185f2a; /* Bordure inférieure */
        }
        #container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px; /* Coins arrondis */
        }
        .post {
            margin-bottom: 40px;
            border: 1px solid #cc0000; /* Bordure rouge */
            padding: 20px;
            position: relative;
            overflow: hidden;
            transition: box-shadow 0.3s;
            border-radius: 10px; /* Coins arrondis */
        }
        .post:hover {
            box-shadow: 0 0 20px rgba(204, 0, 0, 0.5);
        }
        .post h2 {
            color: #cc0000; /* Rouge */
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .post p {
            line-height: 1.6;
        }
        .post img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 5px;
            display: block;
            transition: transform 0.3s;
        }
        .post:hover img {
            transform: scale(1.1);
        }
        .author {
            font-style: italic;
            color: #cc0000; /* Rouge */
            font-weight: bold;
        }
        .comment-form {
            margin-top: 40px;
            text-align: center;
        }
        .comment-form textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .comment-form input[type="text"],
        .comment-form textarea {
            display: block;
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .comment-form input[type="submit"] {
            background-color: #cc0000; /* Rouge */
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            display: inline-block;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-family: 'Roboto', sans-serif;
        }
        .comment-form input[type="submit"]:hover {
            background-color: #a30000; /* Rouge plus foncé au survol */
        }
        .comment {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .comment p {
            margin-bottom: 5px;
        }
        .comment .author {
            font-style: italic;
            color: #cc0000; /* Rouge */
            font-weight: bold;
        }
        footer {
            background-color: #238636; /* Vert foncé */
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        footer p {
            margin-bottom: 0;
        }
        .btn {
            background-color: #cc0000; /* Rouge */
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #a30000; /* Rouge plus foncé au survol */
        }
        .post img {
            max-width: 100%;
            height: auto;
            margin: 0 auto 20px;
            display: block;
            border-radius: 5px;
        }
        .icon {
            color: #cc0000; /* Rouge */
            font-size: 20px;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Blog sur la Palestine</h1>
        <p>Explorer la situation actuelle de Palestine</p>
    </header>

    <div id="container">
        <div class="post" id="post1">
            <h2>Explorer la situation actuelle de Palestine</h2>
            <img src="p1.jpg" alt="Culture palestinienne">
            <p>La Palestine est une région du Moyen-Orient qui a été au centre de conflits politiques et territoriaux depuis des décennies. Actuellement, la situation en Palestine est très tendue en raison des conflits entre les Palestiniens et les Israéliens.</p>
            <p>Les Palestiniens revendiquent leur droit à un État indépendant avec Jérusalem-Est comme capitale, tandis que les Israéliens soutiennent la souveraineté d'Israël sur toute la ville de Jérusalem.</p>
            <p>Les tensions continuent d'augmenter, avec des affrontements fréquents entre les forces israéliennes et les manifestants palestiniens, ainsi que des attaques de roquettes sporadiques depuis Israël vers la bande de Gaza.</p>
        
            <form action="" method="post" class="comment-form">
                <div class="form-group">
                    <?php if (!isset($_SESSION['email'])) : ?>
                    <input type="text" name="email" placeholder="Votre nom" required>
                    <?php endif; ?>
                    <textarea id="comm" name="comm" cols="110" rows="10" placeholder="Tapez votre commentaire.." required></textarea>
                </div>
                <input type="submit" value="Ajouter un commentaire">
            </form>

            <div class="comm">
                <h3>Commentaires :</h3>
                <?php 
                // Display comments
                if ($result->rowCount() > 0) {
                    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<div class='comment'>";
                        echo "<p><i class='fas fa-user icon'></i><span class='author'>" . $row["email"] . "</span></p>";
                        echo "<p>" . $row["comm"] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "No comments yet.";
                }
                ?>
            </div>
        </div>
    </div>

    <footer>
        <p>Tous droits réservés &copy; 2024</p>
    </footer>
</body>
</html>
