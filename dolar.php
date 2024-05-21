<?php
// URL da API CoinGecko para obter preços, volume, market cap, alta/baixa em 24h e variações percentuais
$api_url = 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd&include_market_cap=true&include_24hr_vol=true&include_24hr_change=true';

// Inicializar cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Executar solicitação cURL
$response = curl_exec($ch);
if ($response === FALSE) {
    die('Erro ao obter dados da API: ' . curl_error($ch));
}
curl_close($ch);

// Decodificar a resposta JSON
$data = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Erro ao decodificar resposta JSON.');
}

// Obter dados
$bitcoin_price = $data['bitcoin']['usd'];
$market_cap = $data['bitcoin']['usd_market_cap'];
$volume_24h = $data['bitcoin']['usd_24h_vol'];
$change_percentage_24h = $data['bitcoin']['usd_24h_change'];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Meus Bitcoins</title>
</head>
<body class="bg-dark text-white" style="min-height:100vh;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-black mb-5">
        <div class="container">
            <a class="navbar-brand text-warning" href="index.php"><i class="bi bi-currency-bitcoin fs-3"></i> Bitcoin</a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mainnavbar" aria-controls="mainnavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        <div class="navbar-collapse collapse justify-content-between" id="mainnavbar">
            <div class="navbar-nav gap-2">
                <a class="btn btn-secondary active" href="index.php"><i class="bi bi-stack"></i> Painel</a>
                <a class="btn btn-success" href="#"><i class="bi bi-file-earmark-plus"></i> Novo Registro</a>
                <a class="btn btn-primary" href="#"><i class="bi bi-wallet"></i> Meus Registro</a>
                <a class="btn btn-warning" href="index.php"><i class="fa-solid fa-brazilian-real-sign"></i> BRL</a>
            </div>
            <div class="navbar-nav">
                <a class="btn btn-danger my-2"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>
        </div>
        </div>
    </nav>

    <div class="container mb-5">
        <h2><i class="bi bi-cash-stack"></i> Painel Gerenciador</h2>
        <p>Olá, usuário. Painel com uma visão geral de seus registros de compras e vendas em Bitcoin.</p>
    </div>

    <div class="container">
        <div class="card-group">
            <div class="card text-bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-header"><i class="bi bi-currency-bitcoin"></i> Bitcoin (USD)</div>
                <div class="card-body">
                    <h2><i class="bi bi-currency-dollar"></i><?php echo number_format($bitcoin_price, 2, ',', '.'); ?></h2><br/>
                    <p><strong>Variação em 24h:</strong> <?php echo number_format($change_percentage_24h, 2, ',', '.'); ?>%</p>
                    <p><strong>Market Cap:</strong> $<?php echo number_format($market_cap, 2, ',', '.'); ?> USD</p>
                </div>
            </div>

            <div class="card text-bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header"><i class="bi bi-clock-history"></i> Últimos registros</div>
                <div class="card-body">
                    <p>Compra de $ 500 em Bitcoin em 10/06/2023</p>
                    <p>Venda de $ 80 em Bitcoin em 22/10/2023</p>
                    <p>Compra de $ 150 em Bitcoin em 15/02/2024</p>
                    <p><a class="btn btn-primary" href="#">Ver mais...</a></p>
                </div>
            </div>

            <div class="card text-bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header"><i class="bi bi-file-earmark-plus"></i> Novo registro</div>
                <div class="card-body">
                    <p><a class="btn btn-success" href="#"><i class="bi bi-cart-plus-fill"></i> Nova Compra</a></p>
                    <p><a class="btn btn-danger" href="#"><i class="bi bi-cart-dash-fill"></i> Nova Venda</a></p>
                </div>
            </div>
        </div>
    </div<>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
