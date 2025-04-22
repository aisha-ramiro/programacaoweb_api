<?php
$anoFiltro = isset($_GET['ano']) ? intval($_GET['ano']) : null;

$senadores = [];
$erro = null;

if ($anoFiltro) {
    $url = "https://adm.senado.gov.br/adm-dadosabertos/api/v1/senadores/aposentados";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response) {
        $data = json_decode($response, true);

        foreach ($data as $senador) {
            $anoInicial = intval(substr($senador['dataInicial'], 0, 4));

            if ($anoInicial >= $anoFiltro) {
                $senadores[] = $senador;
            }
        }
    } else {
        $erro = "Erro ao consultar a API.";
    }
} else {
    $erro = "Ano inválido.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultados</title>
    <style>
        body {
            background: #fdf8e6;
            padding: 40px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .voltar {
            background-color: #c2bb9f;
            color: white;
            padding: 10px 15px;
            border-radius: 20px;
            border: none;
            text-decoration: none;
            font-size: 16px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="header">
    <h2>Resultado das buscas</h2>
    <a class="voltar" href="index.php"> Nova Pesquisa</a>
</div>

<?php if (isset($erro)): ?>
    <p><?= $erro ?></p>
<?php elseif (count($senadores) > 0): ?>
    <div class="grid">
        <?php foreach ($senadores as $senador): ?>
            <div class="card">
                <strong>Nome:</strong> <?= $senador['nome'] ?><br>
                <strong>Tipo:</strong> <?= $senador['tipo'] ?><br>
                <strong>Início:</strong> <?= $senador['dataInicial'] ?><br>
                <strong>Remuneração:</strong> R$ <?= $senador['remuneracao'] ?><br>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Nenhum senador encontrado a partir do ano <?= $anoFiltro ?>.</p>
<?php endif; ?>

</body>
</html>
