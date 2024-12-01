<?php
include 'conn.php'; // Conexão com o banco de dados

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera os dados do formulário
    $id = $_POST['id'];
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $contacto = htmlspecialchars($_POST['contacto']);
    $message = htmlspecialchars($_POST['message']);
    
    // Valida os dados (exemplo simples)
    if (empty($name) || empty($email) || empty($contacto) || empty($message)) {
        $error = "Todos os campos são obrigatórios.";
    } else {
        // Atualiza a mensagem no banco de dados
        $sql = "UPDATE messagesss SET name = ?, email = ?, contacto = ?, message = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssi', $name, $email, $contacto, $message, $id);

        if ($stmt->execute()) {
            // Mensagem atualizada com sucesso
            header("Location: tabela.php"); // Redireciona para a lista de mensagens
            exit();
        } else {
            $error = "Erro ao atualizar a mensagem. Tente novamente.";
        }
    }
}

// Caso não seja um envio de formulário, busca a mensagem para exibir no formulário de edição
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT id, name, email, contacto, message FROM messagesss WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $contacto = $row['contacto'];
        $message = $row['message'];
    } else {
        $error = "Mensagem não encontrada.";
    }
} else {
    $error = "ID não especificado.";
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le message</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Modifier le message</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form action="edit_message.php" method="POST">
            <input type="hidden" name="id" value="<?= $id; ?>">

            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($name); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($email); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="contacto">Contacto:</label>
                <input type="text" class="form-control" name="contacto" value="<?= htmlspecialchars($contacto); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="message">Mensagem:</label>
                <textarea class="form-control" name="message" rows="4" required><?= htmlspecialchars($message); ?></textarea>
            </div>

            <button type="submit" class="btn btn-warning">Enregistrer les modifications</button>
            <a href="tabela.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php $conn->close(); // Fecha a conexão com o banco ?>
