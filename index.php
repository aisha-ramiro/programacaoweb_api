<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Consulta Senadores</title>
    <style>
        body {
            background: #fdf8e6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .pesquisa {
            background: white;
            padding: 40px;
            border-radius: 10px;
            pesquisa-shadow: 0 3px 6px rgba(0,0,0,0.1);
            text-align: center;
        }
        input, button {
            margin-top: 20px;
            padding: 10px 15px;
            border-radius: 20px;
            border: none;
            font-size: 16px;
        }
        input {
            width: 250px;
            background: #f0f0f0;
        }
        button {
            background-color: #c2bb9f;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="pesquisa">
    <h2>Consulta Senadores</h2>
    <p>Busque por senadores que iniciaram a partir de determinado ano</p>

    <form action="resultados.php" method="GET">
        <input type="number" name="ano" placeholder="Digite o ano" required>
        <br>
        <button type="submit">Consultar</button>
    </form>
</div>

</body>
</html>
