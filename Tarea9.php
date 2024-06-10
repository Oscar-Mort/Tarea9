<?php

$url = 'https://pokeapi.co/api/v2/pokemon/?offset=0&limit=20';

$response = file_get_contents($url);
if ($response === FALSE) {
    die('Error occurred');
}
$data = json_decode($response, true);
$results = $data['results'];
?>

<style>
.div1 {
    text-align: center;
    background-color:#99ccff ;
    width: 300px;
    border: 1px solid;
    padding: 50px;
    
}
.h1 {
    font-family: arial;
}
.pokemon-info {
    text-align: center;
    font-family: arial;
}
.error {
    color: red;
    font-family: arial;
}
.footer{
    text-align: center;
    width: 100%;
    bottom: 0;
    position: fixed;
}
</style>

<!DOCTYPE html>
<html lang="es">
<link rel="icon" type="image/x-icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Pokebola-pokeball-png-0.png/769px-Pokebola-pokeball-png-0.png">


<head>
    <meta charset="UTF-8">
    <title>Lista de Pokémon</title>
    <link rel="stylesheet" href="styles.css">
</head>
<center>
<body>
    <div class="div1">
        <h1 class="h1">Encuentra tu Pokémon </h1> 
        <form method="GET" action="">
            <input type="text" name="query">
            <br><br><button type="submit">Buscar</button>
        </form>
        <?php
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $query = htmlspecialchars($_GET['query']);
            $url = 'https://pokeapi.co/api/v2/pokemon/' . strtolower($query);
            
            $response = @file_get_contents($url);
            if ($response !== FALSE) {
                $pokemon = json_decode($response, true);
                echo '<div class="pokemon-info">';
                echo '<h2>' . ucfirst($pokemon['name']) . ' (#' . $pokemon['id'] . ')</h2>';
                echo '<img src="' . $pokemon['sprites']['front_default'] . '" alt="' . $pokemon['name'] . '">';
                echo '</div>';
            } else {
                $headers = get_headers($url);
                if (strpos($headers[0], '404') !== false) {
                    echo '<p class="error">Se ha introducido un nombre y/o número de Pokémon incorrecto.</p>';
                }
            }
        }
        ?>
    </div>
    <footer class="footer"> Página creada por: <b>Óscar Moreno Martín - 17480820S </b></footer>
</body>
    </center>
</html>