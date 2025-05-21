<?php
require_once("../Classes/Planta.class.php");

$busca = isset($_GET['busca']) ? $_GET['busca'] : 0;
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 0;

$lista = Planta::listar($tipo, $busca);
$itens = '';

foreach($lista as $planta){
    $item = file_get_contents('itens_listagem_plantas.html');
    $item = str_replace('{id}', $planta->getId(), $item);
    $item = str_replace('{nome}', $planta->getNome(), $item);
    $item = str_replace('{tipo}', $planta->getTipo(), $item);
    $item = str_replace('{finalidade}', $planta->getFinalidade(), $item);
    $item = str_replace('{ambiente}', $planta->getAmbiente(), $item);
    $item = str_replace('{cuidados}', $planta->getCuidados(), $item);
    $itens .= $item;
}

$listagem = file_get_contents('listagem_planta.html');
$listagem = str_replace('{itens}', $itens, $listagem);
print($listagem);
?>
