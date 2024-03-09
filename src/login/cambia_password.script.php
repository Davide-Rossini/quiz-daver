<?php
// Includi il file config.php per ottenere le informazioni di connessione al database
require_once '../../db/config.php';

// Messaggio di errore vuoto per la visualizzazione
$error = '';

// Connessione al database
$conn = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE, PORT);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Verifica se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prendi i dati inviati dal form
    $username = $_POST['username'];
    $newPassword = $_POST['new_password'];

    // Pulisci i dati
    $username = mysqli_real_escape_string($conn, $username);
    $newPassword = mysqli_real_escape_string($conn, $newPassword);

    // Verifica se l'utente esiste nel database
    $userCheckSql = "SELECT * FROM users WHERE Username='$username'";
    $result = $conn->query($userCheckSql);
    if ($result->num_rows === 0) {
        $error = "L'utente non esiste.";
        $errorColor = "red";
    } else {
        $row = $result->fetch_assoc();
        $currentPassword = $row['Password'];
        // Verifica se la nuova password è diversa dalla password attuale
        if ($newPassword === $currentPassword) {
            $error = "La nuova password non può essere uguale alla password attuale.";
            $errorColor = "red";
        } else {
            // Query per aggiornare la password nel database
            $updateSql = "UPDATE users SET Password='$newPassword' WHERE Username='$username'";
            if ($conn->query($updateSql) === TRUE) {
                // Password aggiornata con successo
                $error = "Password cambiata con successo.";
                $errorColor = "green";
            } else {
                $error = "Si è verificato un errore nell'aggiornamento della password: " . $conn->error;
                $errorColor = "red";
            }
        }
    }
}

// Chiudi la connessione
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@800&display=swap" rel="stylesheet">
    <title>Cambia Password</title>
</head>
<body>
    <div class="container">
        <h1>Cambia Password</h1>
        <form action="" method="post">
            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Inserisci l'username..." class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Inserisci la nuova password..." required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="reset">Cambia Password</button>
            </div>
        </form>
        <div class="error" style="color: <?php echo $errorColor ?? 'red'; ?>;">
            <?php echo $error; ?>
        </div>
        <div>
            <a href="../../src/index.php">Torna al login</a>
        </div>
    </div>
</body>
<style>
    *{
        font-family: "Mukta", sans-serif;
    }
    h1{
        text-align: center;
        font-size: 100px;
        color: #007bff;
        margin-bottom: 20px;
        margin-top: 20px;
    }
    .container {
        width: 30%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        margin-top: 100px;
        text-align: center;
    }
    .form-group {
        margin-bottom: 20px;
        margin-right: 20px;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 30px;
        text-align: center;
    }
    .btn {
        padding: 10px;
        border-radius: 5px;
        border: none;
        color: #fff;
        background-color: #007bff;
        cursor: pointer;
        font-size: 30px;
    }
    .btn-primary {
        background-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .mukta-extrabold {
        font-family: "Mukta", sans-serif;
        font-weight: 800;
        font-style: normal;
    }
    .error {
        margin-top: 10px;
    }
</style>
</html>
