<?php
class publicacoes {
     // atributos
    public $idPublicacao;
    public $idUsuario;
    public $descricao;
    public $anexo; //?
    public $dataPublicacao;
    public $status;

    // Getter e Setter 
    public function getIdPublicacao() {
        return $this->idPublicacao;
    }

    public function setIdPublicacao($idPublicacao) {
        $this->idPublicacao = $idPublicacao;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getAnexo() {
        return $this->anexo;
    }

    public function setAnexo($anexo) {
        $this->anexo = $anexo;
    }


    public function getDataPublicacao() {
        return $this->dataPublicacao;
    }

    public function setDataPublicacao($dataPublicacao) {
        $this->dataPublicacao = $dataPublicacao;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

}
?>