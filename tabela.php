<?php
include 'conn.php'; // Inclui a conexão com o banco de dados

// Recupera as mensagens do banco de dados
$sql = "SELECT id, name, email, contacto, message, data FROM messagesss ORDER BY data DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des messages</title>
    <!-- Adicionando o CDN do Bootstrap -->
    <link href="assets/img/logo.jpg" rel="icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Customização adicional para melhorar a aparência */
        table th, table td {
            text-align: center;
            vertical-align: middle;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        /* Para corrigir o problema do "risco" nas colunas de ação */
        td .btn {
            margin-right: 5px;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Messages reçus</h1>

        <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>E-mail</th>
                            <th>Contact</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td><?= htmlspecialchars($row['name']); ?></td>
                                <td><?= htmlspecialchars($row['email']); ?></td>
                                <td><?= htmlspecialchars($row['contacto']); ?></td>
                                <td><?= nl2br(htmlspecialchars($row['message'])); ?></td>
                                <td><?= date('d/m/Y', strtotime($row['data'])); ?></td> <!-- Alteração para formatar a data -->
                                <td>
                                    <div class="action-buttons">
                                        <!-- Botões de ação -->
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewMessageModal<?= $row['id']; ?>">
                                            Voir
                                        </button>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editMessageModal<?= $row['id']; ?>">
                                            Modifier
                                        </button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteMessageModal<?= $row['id']; ?>">
                                            Supprimer
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Visualizar -->
                            <div class="modal fade" id="viewMessageModal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewMessageModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewMessageModalLabel">Afficher le message</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Nome:</strong> <?= htmlspecialchars($row['name']); ?></p>
                                            <p><strong>Email:</strong> <?= htmlspecialchars($row['email']); ?></p>
                                            <p><strong>Contacto:</strong> <?= htmlspecialchars($row['contacto']); ?></p>
                                            <p><strong>Mensagem:</strong><br><?= nl2br(htmlspecialchars($row['message'])); ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Pour fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Editar -->
                            <div class="modal fade" id="editMessageModal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editMessageModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editMessageModalLabel">Modifier le message</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="edit_message.php" method="POST">
                                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                <div class="form-group">
                                                    <label for="name">Nome:</label>
                                                    <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($row['name']); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email:</label>
                                                    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($row['email']); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="contacto">Contacto:</label>
                                                    <input type="text" class="form-control" name="contacto" value="<?= htmlspecialchars($row['contacto']); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message">Mensagem:</label>
                                                    <textarea class="form-control" name="message" rows="4" required><?= htmlspecialchars($row['message']); ?></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Pour fermer</button>
                                                    <button type="submit" class="btn btn-warning">Enregistrer les modifications</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Deletar -->
                            <div class="modal fade" id="deleteMessageModal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteMessageModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteMessageModalLabel">Confirmer la suppression</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Êtes-vous sûr de vouloir supprimer ce message ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <a href="delete_message.php?id=<?= $row['id']; ?>" class="btn btn-danger">Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center">Aucun message trouvé.</p>
        <?php endif; ?>

        <?php $conn->close(); // Fecha a conexão com o banco ?>
    </div>

    <!-- Adicionando o CDN do Bootstrap JavaScript e Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
