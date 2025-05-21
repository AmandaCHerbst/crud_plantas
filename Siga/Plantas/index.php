<?php
require_once("../Classes/Planta.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "";
    $finalidade = isset($_POST['finalidade']) ? $_POST['finalidade'] : "";
    $ambiente = isset($_POST['ambiente']) ? $_POST['ambiente'] : "";
    $cuidados = isset($_POST['cuidados']) ? $_POST['cuidados'] : "";
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";

    $planta = new Planta($id, $nome, $tipo, $finalidade, $ambiente, $cuidados);
    
    if ($acao == 'salvar') {
        if ($id > 0)
            $resultado = $planta->alterar();
        else
            $resultado = $planta->inserir();
    } elseif ($acao == 'excluir') {
        $resultado = $planta->excluir();
    }

    if ($resultado)
        header("Location: index.php");
    else
        echo "Erro ao salvar dados.";
    
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $formulario = file_get_contents('form_cad_planta.html');

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $resultado = Planta::listar(1, $id);
    if ($resultado) {
        $planta = $resultado[0];
        $formulario = str_replace('{id}', $planta->getId(), $formulario);
        $formulario = str_replace('{nome}', $planta->getNome(), $formulario);
        $formulario = str_replace('{tipo}', $planta->getTipo(), $formulario);
        $formulario = str_replace('{finalidade}', $planta->getFinalidade(), $formulario);
        $formulario = str_replace('{ambiente}', $planta->getAmbiente(), $formulario);
        $formulario = str_replace('{cuidados}', $planta->getCuidados(), $formulario);
    } else {
        $formulario = str_replace('{id}', 0, $formulario);
        $formulario = str_replace('{nome}', '', $formulario);
        $formulario = str_replace('{tipo}', '', $formulario);
        $formulario = str_replace('{finalidade}', '', $formulario);
        $formulario = str_replace('{ambiente}', '', $formulario);
        $formulario = str_replace('{cuidados}', '', $formulario);
    }

    print($formulario); 
    include_once('lista_planta.php');
}
?>
