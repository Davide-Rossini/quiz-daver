<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@800&display=swap" rel="stylesheet">
    <title>Seleziona Quiz</title>
</head>
<body>
    <div class="container">
        <h1>Vuoi cominciare il quiz?</h1>
        <p></p>
        <div class="btnscelta">
            <form action="quiz/quiz1.php" method="post">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary green">Si</button>
                </div>
            </form>
            <form action="index.php" method="post">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary red">No</button>
                </div>
            </form>
        </div>
    </div>
</body>
<style>
    *{
        font-family: "Mukta", sans-serif;
    }
    h1{
        text-align: center;
        font-size: 60px;
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
        padding: 20px 40px; /* Modificato il padding per rendere i pulsanti più grandi */
        border-radius: 10px; /* Aumentato il border-radius */
        border: none;
        color: #fff;
        font-size: 30px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .green {
        background-color: #28a745;
    }
    .red {
        background-color: #dc3545;
    }
    .btn:hover {
        filter: brightness(90%);
    }
    .mukta-extrabold {
        font-family: "Mukta", sans-serif;
        font-weight: 800;
        font-style: normal;
    }

    .btnscelta {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }
</style>
</html>
