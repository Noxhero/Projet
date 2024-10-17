<!DOCTYPE html>
<html lang="fr">
<head>

</head>
<body>

    <div class="container">
        <h2>Se connecter</h2>
        <form method="post" action="connexion_traitement.php" class="login-form">
            Email: <input type="mail" name="email" required ><br>
            Pseudo: <input type="text" name="pseudo" required ><br>
            Mot de passe: <input type="password" name="mdp" required ><br>
            <label>
                <input type="checkbox" name="remember_me"> Se souvenir de moi
            </label><br>
            <input type="submit" name="login" value="Se connecter">
        </form>
    </div>
    
</body>
</html>