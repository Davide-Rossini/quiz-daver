<?php
// Includi il file config.php per ottenere le informazioni di connessione al database
require_once '../db/config.php';

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
    // Verifica quale pulsante è stato premuto
    if (isset($_POST['login'])) {
        // Prendi i dati inviati dal form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Pulisci i dati
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        // Query per verificare se l'utente esiste nel database
        $sql = "SELECT * FROM users WHERE Username='$username' AND Password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // L'utente è autenticato con successo, reindirizza l'utente solo se le credenziali sono presenti nel database
            header("Location: selezionaquiz.php");
            exit();
        } else {
            // Credenziali non valide
            $error = "Credenziali non valide.";
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
    <title>Quiz-Daver</title>
</head>
<body>
    <div class="container">
    <h1>Accedi</h1>
        <form action="index.php" method="post">
            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Inserisci l'username..." class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Inserisci la password..." required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </div>
        </form>
        <div class="error">
            <?php echo $error; ?>
        </div>

        <div class="reindir">
            <a href="login/cambia_password.script.php">Ti sei dimenticato la password?</a>
            <a href="signup/signup.php">Non sei registrato? Registrati ora!</a>
        </div>
    </div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
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
        background-color: white;
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
    body {
    margin: auto;
    font-family: -apple-system, BlinkMacSystemFont, sans-serif;
    overflow: auto;
    background: linear-gradient(315deg, rgba(101,0,94,1) 3%, rgba(60,132,206,1) 38%, rgba(48,238,226,1) 68%, rgba(255,25,25,1) 98%);
    animation: gradient 15s ease infinite;
    background-size: 400% 400%;
    background-attachment: fixed;
}

@keyframes gradient {
    0% {
        background-position: 0% 0%;
    }
    50% {
        background-position: 100% 100%;
    }
    100% {
        background-position: 0% 0%;
    }
}

.wave {
    background: rgb(255 255 255 / 25%);
    border-radius: 1000% 1000% 0 0;
    position: fixed;
    width: 200%;
    height: 12em;
    animation: wave 10s -3s linear infinite;
    transform: translate3d(0, 0, 0);
    opacity: 0.8;
    bottom: 0;
    left: 0;
    z-index: -1;
}

.wave:nth-of-type(2) {
    bottom: -1.25em;
    animation: wave 18s linear reverse infinite;
    opacity: 0.8;
}

.wave:nth-of-type(3) {
    bottom: -2.5em;
    animation: wave 20s -1s reverse infinite;
    opacity: 0.9;
}

@keyframes wave {
    2% {
        transform: translateX(1);
    }

    25% {
        transform: translateX(-25%);
    }

    50% {
        transform: translateX(-50%);
    }

    75% {
        transform: translateX(-25%);
    }

    100% {
        transform: translateX(1);
    }
}
</style>
</html
