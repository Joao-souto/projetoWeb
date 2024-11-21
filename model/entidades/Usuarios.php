<?php
class Usuarios {
    // Atributos
    private $idUsuario;
    private $nome;
    private $email;
    private $senha;
    private $dataCriacao;
    private $loginValido;

    // Construtor
    public function __construct($nome, $email, $senha) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }

    // Método para visualizar usuário
    public function visualizarUsuario(){
        echo "id_usuario: " . $this->idUsuario;
        echo "nome: " . $this->nome;
        echo "email: " . $this->email;
        echo "senha: " . $this->senha;
    }

    // Getters e Setters
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getDataCriacao() {
        return $this->dataCriacao;
    }

    public function setDataCriacao($dataCriacao) {
        $this->dataCriacao = $dataCriacao;
    }

    public function getLoginValido() {
        return $this->loginValido;
    }

    public function setLoginValido($valor) {
        $this->loginValido = $valor;
    }
}
?>