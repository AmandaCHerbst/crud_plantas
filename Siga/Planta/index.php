<?php
require_once("../Classes/Planta.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? 0;
    $nome = $_POST['nome'] ?? "";
    $tipo = $_POST['tipo'] ?? "";
    $finalidade = $_POST['finalidade'] ?? "";
    $ambiente = $_POST['ambiente'] ?? "";
    $cuidados = $_POST['cuidados'] ?? "";
    $acao = $_POST['acao'] ?? "";

    $destino_anexo = '';
    if ($_FILES['anexo']['name']) {
        $destino_anexo = 'uploads/' . $_FILES['anexo']['name'];
        move_uploaded_file($_FILES['anexo']['tmp_name'], PATH_UPLOAD . $destino_anexo);
    }

    $planta = new Planta($id, $nome, $tipo, $finalidade, $ambiente, $cuidados, $destino_anexo);

    if ($acao == 'salvar')
        $resultado = ($id > 0) ? $planta->alterar() : $planta->inserir();
    elseif ($acao == 'excluir')
        $resultado = $planta->excluir();

    header("Location: index.php");
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $formulario = file_get_contents('form_cad_planta.html');

    $id = $_GET['id'] ?? 0;
    $planta = Planta::listar(1, $id)[0] ?? null;

    $formulario = str_replace('{id}', $planta?->getId() ?? 0, $formulario);
    $formulario = str_replace('{nome}', $planta?->getNome() ?? '', $formulario);
    $formulario = str_replace('{tipo}', $planta?->getTipo() ?? '', $formulario);
    $formulario = str_replace('{finalidade}', $planta?->getFinalidade() ?? '', $formulario);
    $formulario = str_replace('{ambiente}', $planta?->getAmbiente() ?? '', $formulario);
    $formulario = str_replace('{cuidados}', $planta?->getCuidados() ?? '', $formulario);

    echo $formulario;
    include_once('lista_planta.php');
}
?>
