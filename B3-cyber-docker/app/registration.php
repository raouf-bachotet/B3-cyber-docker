<?php
    require_once('./functions.php');

    if (isset($_POST['send'])) {
        // dd($_POST);

        $link = connectDB();

        // Vérifier si l'adresse email existe déjà
        $email = $_POST['email'];
        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';
        $sth = $link->prepare($sql);
        $sth->bindParam(':email', $email, PDO::PARAM_STR);
        $sth->execute();
        $count = $sth->fetchColumn();

        // Si l'adresse email existe déjà, afficher un message d'erreur
        if ($count > 0) {
            echo "Cette adresse email existe déjà.";
            exit;
        }

        // Si l'adresse email n'existe pas, insérer les données dans la base de données
        $password = $_POST['password'];
        $sql = 'INSERT INTO users (`email`, `password`) VALUES (:email, :password)';
        $sth = $link->prepare($sql);
        $sth->execute([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        header("Location: login.php");
    }
?>


<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background-color: #f7f7f7;
}

form {
    background-color: #fff;
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

h1 {
    text-align: center;
    margin-top: 0;
    font-size: 2.5rem;
}

label {
    display: block;
    margin-bottom: 5px;
    font-size: 1.2rem;
}

input[type="email"],
input[type="password"] {
    display: block;
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    font-size: 1.2rem;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
    transition: all 0.3s ease;
}

input[type="submit"] {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 1.2rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #388e3c;
}

a {
    display: block;
    margin-top: 20px;
    text-align: center;
    font-size: 1.2rem;
    color: #4caf50;
    text-decoration: none;
    transition: all 0.3s ease;
}

a:hover {
    color: #388e3c;
}
</style>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <form method="POST">
        <label for="email">Email</label>
        <input 
            type="email" 
            name="email" 
            id="email" 
            value="" 
            placeholder="Entrez votre adresse email" 
            required
        />
        <label for="email2">Confirmation</label>
        <input 
            type="email" 
            name="email2" 
            id="email2" 
            value="" 
            placeholder="Confirmez votre adresse email" 
            required
        />

        <label for="password">Mot de passe</label>
        <input 
            type="password" 
            name="password" 
            id="password" 
            value="" 
            placeholder="Entrez votre mot de passe" 
            required
        />
        <label for="password">Confirmation</label>
        <input 
            type="password" 
            name="password2" 
            id="password2" 
            value="" 
            placeholder="Confirmer votre mot de passe" 
            required
        />
        <input type="submit" value="Créer" name="send" />
    </form>
    <a href="login.php">Vous avez déjà un compte ?</a>
</body>
</html>