<!DOCTYPE html>
<html>
<head>
    <title>Tous Les Utilisateurs</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.17/jspdf.plugin.autotable.min.js"></script>
</head>
<body>
    <button id="download-csv">Télécharger CSV</button>
    <button id="download-pdf">Télécharger PDF</button>
    <button onclick="window.print()">Imprimer</button>

    <?php if (!empty($users)): ?>
        <table id="users-table">
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Mot de Passe</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['prenom']); ?></td>
                        <td><?php echo htmlspecialchars($user['nom']); ?></td>
                        <td><?php echo htmlspecialchars($user['telephone']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['mot_de_passe']); ?></td>
                        <td>
                            <button type="submit" href="views/actionsSuperAdmin/modifierUser.php?id=<?php echo htmlspecialchars($user['id_user']); ?>">Modifier </button><br><br>
                            <form action="views/actionsSuperAdmin/supprimerUser.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($user['id_user']); ?>">
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun utilisateur trouvé</p>
    <?php endif; ?>

    <script src="public/assets/js/script.js"></script>
</body>
</html>
