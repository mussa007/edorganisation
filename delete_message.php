<?php
include 'conn.php'; // Conexão com o banco de dados

// Verifica se o ID foi passado via URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara a consulta SQL para excluir a mensagem
    $sql = "DELETE FROM messagesss WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    // Executa a consulta
    if ($stmt->execute()) {
        // Redireciona para a lista de mensagens após a exclusão
        header("Location: tabela.php?success=Mensagem excluída com sucesso");
        exit();
    } else {
        // Se a exclusão falhar, exibe uma mensagem de erro
        $error = "Erro ao excluir a mensagem. Tente novamente.";
    }
} else {
    // Se o ID não for passado, exibe uma mensagem de erro
    $error = "ID não especificado.";
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer le message</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Supprimer le message</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?= $error; ?>
            </div>
        <?php endif; ?>
        
        <!-- Mensagem de confirmação após sucesso -->
        <div class="alert alert-success">
        Message supprimé avec succès !
        </div>

        <a href="tabela.php" class="btn btn-primary">Revenir à la liste des messages</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php $conn->close(); // Fecha a conexão com o banco ?>
