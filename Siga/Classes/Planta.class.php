<?php
require_once("Database.class.php");

class Planta {
    private $id, $nome, $tipo, $finalidade, $ambiente, $cuidados, $anexo;

    public function __construct($id, $nome, $tipo, $finalidade, $ambiente, $cuidados, $anexo) {
        $this->id = $id;
        $this->nome = $nome;
        $this->tipo = $tipo;
        $this->finalidade = $finalidade;
        $this->ambiente = $ambiente;
        $this->cuidados = $cuidados;
        $this->anexo = $anexo;
    }

    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getTipo() { return $this->tipo; }
    public function getFinalidade() { return $this->finalidade; }
    public function getAmbiente() { return $this->ambiente; }
    public function getCuidados() { return $this->cuidados; }
    public function getAnexo() { return $this->anexo; }

    public function inserir(): bool {
        $sql = "INSERT INTO planta (nome, tipo, finalidade, ambiente, cuidados, anexo)
                VALUES (:nome, :tipo, :finalidade, :ambiente, :cuidados, :anexo)";
        $param = [
            ':nome' => $this->nome,
            ':tipo' => $this->tipo,
            ':finalidade' => $this->finalidade,
            ':ambiente' => $this->ambiente,
            ':cuidados' => $this->cuidados,
            ':anexo' => $this->anexo
        ];
        return Database::executar($sql, $param) !== false;
    }

    public static function listar($tipo = 0, $info = ''): array {
        $sql = "SELECT * FROM planta";
        $param = [];

        if ($tipo == 1) {
            $sql .= " WHERE id = :info";
            $param = [':info' => $info];
        } elseif ($tipo == 2) {
            $sql .= " WHERE nome LIKE :info";
            $param = [':info' => "%$info%"];
        }

        $stmt = Database::executar($sql, $param);
        $plantas = [];

        while ($row = $stmt->fetch()) {
            $plantas[] = new Planta(
                $row['id'], $row['nome'], $row['tipo'],
                $row['finalidade'], $row['ambiente'],
                $row['cuidados'], $row['anexo']
            );
        }
        return $plantas;
    }

    public function alterar(): bool {
        $sql = "UPDATE planta SET nome = :nome, tipo = :tipo, finalidade = :finalidade,
                ambiente = :ambiente, cuidados = :cuidados, anexo = :anexo WHERE id = :id";
        $param = [
            ':id' => $this->id,
            ':nome' => $this->nome,
            ':tipo' => $this->tipo,
            ':finalidade' => $this->finalidade,
            ':ambiente' => $this->ambiente,
            ':cuidados' => $this->cuidados,
            ':anexo' => $this->anexo
        ];
        return Database::executar($sql, $param) !== false;
    }

    public function excluir(): bool {
        $sql = "DELETE FROM planta WHERE id = :id";
        return Database::executar($sql, [':id' => $this->id]) !== false;
    }
}
?>
