<?php

class Usuario
{
    
    private $codigo_usuario;
    private $nome_usuario;
    private $perfil_usuario;
    private $telefone_usuario;
    private $cpf_usuario;
    /**
     * @return mixed
     */
    public function getCodigo_usuario()
    {
        return $this->codigo_usuario;
    }

    /**
     * @return mixed
     */
    public function getNome_usuario()
    {
        return $this->nome_usuario;
    }

    /**
     * @return mixed
     */
    public function getPerfil_usuario()
    {
        return $this->perfil_usuario;
    }

    /**
     * @return mixed
     */
    public function getTelefone_usuario()
    {
        return $this->telefone_usuario;
    }

    /**
     * @return mixed
     */
    public function getCpf_usuario()
    {
        return $this->cpf_usuario;
    }

    /**
     * @param mixed $codigo_usuario
     */
    public function setCodigo_usuario($codigo_usuario)
    {
        $this->codigo_usuario = $codigo_usuario;
    }

    /**
     * @param mixed $nome_usuario
     */
    public function setNome_usuario($nome_usuario)
    {
        $this->nome_usuario = $nome_usuario;
    }

    /**
     * @param mixed $perfil_usuario
     */
    public function setPerfil_usuario($perfil_usuario)
    {
        $this->perfil_usuario = $perfil_usuario;
    }

    /**
     * @param mixed $telefone_usuario
     */
    public function setTelefone_usuario($telefone_usuario)
    {
        $this->telefone_usuario = $telefone_usuario;
    }

    /**
     * @param mixed $cpf_usuario
     */
    public function setCpf_usuario($cpf_usuario)
    {
        $this->cpf_usuario = $cpf_usuario;
    }

    public function insereDados($nome, $perfil, $telefone, $cpf)
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $sql = "INSERT INTO usuario (nome_usuario, perfil_usuario, telefone_usuario, cpf_usuario) VALUES (?,?,?,?)";
        if ($stmt = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $stmt->bind_param("ssss", $nome, $perfil, $telefone, $cpf);
            
            $stmt->execute();
            
                    $conn->close();
                    // any additional code you need would go here.
                } else {
                    $error = $stmt->errno . ' ' . $stmt->error;
                    echo $error; // 1054 Unknown column 'foo' in 'field list'
                }
    }
    
    public function SelecionaDados($nome_usuario)
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("SELECT * FROM usuario WHERE nome_usuario LIKE '%$nome_usuario%' ORDER BY nome_usuario");
        return $result;
        // any additional code you need would go here.
    }
    
    public function SelecionaDadosGerais()
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("SELECT codigo_usuario, nome_usuario FROM usuario");
        return $result;
        // any additional code you need would go here.
    }
    
    public function DeletaDados($codigo_usuario)
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("DELETE FROM usuario WHERE codigo_usuario = $codigo_usuario");
        
        return $result;
        // any additional code you need would go here.
    }
    
}

?>