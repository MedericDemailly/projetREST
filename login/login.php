<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styleLogin.css">
    <title>Se connecter</title>
</head>
<body>
<div class="container">
      <h1>Connexion</h1>
      <form action='../utilisateur/apiLogin.php' method='POST'>
        <label for="username">Identifiant :</label>
        <input type="text" id="username" name="username" placeholder="Entrez votre identifiant">

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe">

        <button type="submit">Se connecter</button>
      </form>
    </div>
</body>
</html>