<?php
require_once("Database.class.php");

class Planta {
    private $id, $nome, $tipo, $finalidade, $ambiente, $cuidados;

    public function __construct($id, $nome, $tipo, $finalidade, $ambiente, $cuidados) {
        $this->setId($id);
        $this->setNome($nome);
        $this->setTipo($tipo);
        $this->setFinalidade($finalidade);
        $this->setAmbiente($ambiente);
        $this->setCuidados($cuidados);
    }

    public function setId($id) {
        $this->id = $id >= 0 ? $id : 0;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setFinalidade($finalidade) {
        $this->finalidade = $finalidade;
    }

    public function setAmbiente($ambiente) {
        $this->ambiente = $ambiente;
    }

    public function setCuidados($cuidados) {
        $this->cuidados = $cuidados;
    }

    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getTipo() { return $this->tipo; }
    public function getFinalidade() { return $this->finalidade; }
    public function getAmbiente() { return $this->ambiente; }
    public function getCuidados() { return $this->cuidados; }

    public function inserir(): bool {
        $sql = "INSERT INTO planta (nome, tipo, finalidade, ambiente, cuidados)
                VALUES (:nome, :tipo, :finalidade, :ambiente, :cuidados)";
        $params = [
            ':nome' => $this->getNome(),
            ':tipo' => $this->getTipo(),
            ':finalidade' => $this->getFinalidade(),
            ':ambiente' => $this->getAmbiente(),
            ':cuidados' => $this->getCuidados()
        ];
        return Database::executar($sql, $params);
    }

    public function alterar(): bool {
        $sql = "UPDATE planta SET nome=:nome, tipo=:tipo, finalidade=:finalidade, ambiente=:ambiente, cuidados=:cuidados WHERE id=:id";
        $params = [
            ':id' => $this->getId(),
            ':nome' => $this->getNome(),
            ':tipo' => $this->getTipo(),
            ':finalidade' => $this->getFinalidade(),
            ':ambiente' => $this->getAmbiente(),
            ':cuidados' => $this->getCuidados()
        ];
        return Database::executar($sql, $params);
    }

    public function excluir(): bool {
        $sql = "DELETE FROM planta WHERE id = :id";
        $params = [':id' => $this->getId()];
        return Database::executar($sql, $params);
    }

    public static function listar($tipo = 0, $info = ''): array {
        $sql = "SELECT * FROM planta";
        $params = [];

        switch ($tipo) {
            case 1:
                $sql .= " WHERE id = :info ORDER BY id";
                $params = [':info' => $info];
                break;
            case 2:
                $sql .= " WHERE nome LIKE :info ORDER BY nome";
                $params = [':info' => '%' . $info . '%'];
                break;
        }

        $resultado = Database::executar($sql, $params);
        $plantas = [];

        while ($registro = $resultado->fetch()) {
            $plantas[] = new Planta(
                $registro['id'],
                $registro['nome'],
                $registro['tipo'],
                $registro['finalidade'],
                $registro['ambiente'],
                $registro['cuidados']
            );
        }

        return $plantas;
    }
}
?>
