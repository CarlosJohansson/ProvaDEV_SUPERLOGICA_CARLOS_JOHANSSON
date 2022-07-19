<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios_model extends CI_Model
{
    public function select(string $nomeDaTabela, array $informacao = null)
    {
        $this->db->select('*');
        $query = $this->db->get($nomeDaTabela);

        return $query->result();
    }

    public function insert(string $nomeDaTabela, array $informacao, string $pk = null, int $id = null): int
    {
        if (!is_null($id)) {
            $resultado = $this->db->set($informacao)
                ->where($pk, $id)
                ->update($nomeDaTabela);
        } else {
            $resultado = $this->db->insert($nomeDaTabela, $informacao);
        }

        if($resultado){
            $idInserido = $this->db->insert_id();
        }

        return $idInserido;
    }
}