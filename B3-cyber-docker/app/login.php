<?php
    require_once('./functions.php');

    if (isset($_POST['send'])) {
        // dd($_POST);

        $link = connectDB();
        $sql = 'SELECT * FROM users WHERE email=:email AND password = :password';

        $sth = $link->prepare($sql);
        $sth->execute([
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ]);

        $result = $sth->fetch();
        // dd($result);
        if ($result !== false && count($result) != 0) {
            $_SESSION['user'] = $result;
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
      * {
        box-sizing: border-box;
      }
      body {
        font-family: 'Open Sans', sans-serif;
        background-color: #fafafa;
        margin: 0;
        padding: 0;
      }

      form {
        width: 400px;
        margin: 0 auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
      }

      h1 {
        text-align: center;
        color: #333;
        font-size: 24px;
        margin-bottom: 30px;
      }

      label {
        display: block;
        margin-bottom: 5px;
        color: #777;
        font-size: 14px;
      }

      input[type="email"],
      input[type="password"] {
        width: 100%;
        padding: 12px 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
        font-size: 16px;
        font-weight: 400;
        color: #555;
        background-color: #fff;
        box-shadow: none;
        transition: border-color 0.3s;
        box-sizing: border-box;
      }

      input[type="email"]:focus,
      input[type="password"]:focus {
        border-color: #7f7f7f;
      }

      input[type="submit"] {
        background-color: #6c63ff;
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: background-color 0.3s;
      }

      input[type="submit"]:hover {
        background-color: #4c46ba;
      }

      a {
        display: block;
        margin-top: 20px;
        text-align: center;
        color: #777;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s;
      }

      a:hover {
        color: #333;
      }
    </style>
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

        <label for="password">Mot de passe</label>
        <input 
            type="password" 
            name="password" 
            id="password" 
            value="" 
            placeholder="Entrez votre mot de passe" 
            required
        />
        <input type="submit" value="Login" name="send" />
    </form>
    <a href="registration.php">Pas encore de compte ?</a>
</body>
</html>
