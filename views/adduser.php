<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Utilisateur</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
    <div class="form-container">
        <h1>Ajouter Utilisateur</h1>
        <form action="index.php" method="POST">
            <input type="hidden" name="action" value="createUser">
            
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>
            
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>
            
            <label for="telephone">Téléphone:</label>
            <input type="tel" id="telephone" name="telephone" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="mot_de_passe">Mot de Passe:</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            
            <button type="submit">Ajouter Utilisateur</button>
        </form>
    </div>
</body>
</html>
