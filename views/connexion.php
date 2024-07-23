
<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
    <?php if (!isset($_SESSION['id_user']) && !isset($_SESSION['id_superUser'])): ?>
        <div class="container">
            <?php if (isset($message)) : ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>

            <h1>Connexion</h1>
            <form action="../index.php" method="POST" class="login-form">
                <input type="hidden" name="action" value="login">
                <label for="email">Adresse e-mail:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Se connecter</button>
            </form>
        </div>
    <?php endif; ?>
</body>
</html>
