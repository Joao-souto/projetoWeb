<?php
class Publicacoes {
     // atributos
    private $idPublicacao;
    private $idUsuario;
    private $descricao;
    private $anexo; //?
    private $dataPublicacao;
    private $status;

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