<?php

require_once '../../_config/db.php';
require_once '../../models/commandemodel.php';
require_once '../../controllers/commandecontroller.php';

session_start();

$commandeModel = new CommandeModel($database); 
$commandeController = new CommandeController($commandeModel);

$commandesEnAttente = $commandeModel->getCommandesEnAttente();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Commandes</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
    <h1>Gestion des Commandes</h1>
    <button class="back-button" onclick="history.back()">Retour</button>
    
    <div class="orders">
        <?php if (!empty($commandesEnAttente)): ?>
            <?php foreach ($commandesEnAttente as $commande): ?>
                <div class="order-item">
                    <h2>Commande ID: <?php echo htmlspecialchars($commande['id_commande']); ?></h2>
                    <?php if (isset($commande['nom'])): ?>
                    <?php endif; ?>
                    <p>Total: <?php echo htmlspecialchars($commande['total_price']); ?> FCFA</p>
                    <form action="gestion_commandes.php" method="POST">
                        <input type="hidden" name="commande_id" value="<?php echo $commande['id_commande']; ?>">
                        <button type="submit">Valider la commande</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune commande en attente.</p>
        <?php endif; ?>
    </div>
</body>
</html>
