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
    $password = $_POST['password'];

    // Pulisci i dati
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query per verificare se l'utente esiste già nel database
    $check_query = "SELECT * FROM users WHERE Username='$username'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        // L'utente esiste già, mostra un messaggio di errore
        $error = "Username già in uso.";
    } else {
        // Inserisci l'utente nel database
        $insert_query = "INSERT INTO users (Username, Password) VALUES ('$username', '$password')";
        if ($conn->query($insert_query) === TRUE) {
            // Utente registrato con successo, reindirizza all'area di login
            header("Location: index.php");
            exit();
        } else {
            // Errore durante l'inserimento dell'utente nel database
            $error = "Errore durante la registrazione.";
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
    <title>Registrati</title>
</head>
<body>
    <div class="container">
    <h1>Registrati</h1>
        <form action="signup.php" method="post">
            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Inserisci l'username..." class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Inserisci la password..." required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="signup">Registrati</button>
            </div>
        </form>
        <div class="error">
            <?php echo $error; ?>
        </div>
        <div class="reindir">
            <a href="../index.php">Hai già un account? Accedi</a>
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
    .reindir {
        display: flex;
        flex-direction: column;
    }
    .error {
        color: red;
        margin-bottom: 10px;
    }
</style>
</html>
