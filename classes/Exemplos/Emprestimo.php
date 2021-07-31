<?php

class Emprestimo
{
    private $codigo_emprestimo;
    private $data_emprestimo;
    private $data_devolucao;
    private $status_emprestimo;
    private $codigo_revista;
    private $codigo_livro;
    private $codigo_usuario;
    /**
     * @return mixed
     */
    public function getCodigo_emprestimo()
    {
        return $this->codigo_emprestimo;
    }

    /**
     * @return mixed
     */
    public function getData_emprestimo()
    {
        return $this->data_emprestimo;
    }

    /**
     * @return mixed
     */
    public function getData_devolucao()
    {
        return $this->data_devolucao;
    }

    /**
     * @return mixed
     */
    public function getStatus_emprestimo()
    {
        return $this->status_emprestimo;
    }

    /**
     * @return mixed
     */
    public function getCodigo_revista()
    {
        return $this->codigo_revista;
    }

    /**
     * @return mixed
     */
    public function getCodigo_livro()
    {
        return $this->codigo_livro;
    }

    /**
     * @return mixed
     */
    public function getCodigo_usuario()
    {
        return $this->codigo_usuario;
    }

    /**
     * @param mixed $codigo_emprestimo
     */
    public function setCodigo_emprestimo($codigo_emprestimo)
    {
        $this->codigo_emprestimo = $codigo_emprestimo;
    }

    /**
     * @param mixed $data_emprestimo
     */
    public function setData_emprestimo($data_emprestimo)
    {
        $this->data_emprestimo = $data_emprestimo;
    }

    /**
     * @param mixed $data_devolucao
     */
    public function setData_devolucao($data_devolucao)
    {
        $this->data_devolucao = $data_devolucao;
    }

    /**
     * @param mixed $status_emprestimo
     */
    public function setStatus_emprestimo($status_emprestimo)
    {
        $this->status_emprestimo = $status_emprestimo;
    }

    /**
     * @param mixed $codigo_revista
     */
    public function setCodigo_revista($codigo_revista)
    {
        $this->codigo_revista = $codigo_revista;
    }

    /**
     * @param mixed $codigo_livro
     */
    public function setCodigo_livro($codigo_livro)
    {
        $this->codigo_livro = $codigo_livro;
    }

    /**
     * @param mixed $codigo_usuario
     */
    public function setCodigo_usuario($codigo_usuario)
    {
        $this->codigo_usuario = $codigo_usuario;
    }
    
    public function insereDadosLivro($data_emprestimo, $data_devolucao, $status, $revista, $livro, $usuario)
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $sql = "INSERT INTO emprestimo (data_emprestimo, data_devolucao, status_emprestimo, codigo_revista, codigo_livro, codigo_usuario) 
VALUES (?,?,?,?,?, ?)";
        if ($stmt = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $stmt->bind_param("sssiii", $data_emprestimo, $data_devolucao, $status, $revista, $livro, $usuario);
           
            $stmt->execute();
            
                    $conn->close();
                    // any additional code you need would go here.
                } else {
                    $error = $stmt->errno . ' ' . $stmt->error;
                    echo $error; // 1054 Unknown column 'foo' in 'field list'
                }
    }
    
    
    public function AlteraDados($data_devolucao, $status, $codigo_emprestimo)
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        $sql = "UPDATE emprestimo SET data_devolucao = ?, status_emprestimo = ? WHERE codigo_emprestimo = $codigo_emprestimo";
        if ($stmt = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $stmt->bind_param("ss", $data_devolucao, $status);
            
            $stmt->execute();
            
            $conn->close();
            // any additional code you need would go here.
        } else {
            $error = $stmt->errno . ' ' . $stmt->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
        }
    }
    
    public function SelecionaDados($codigo_emprestimo)
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("SELECT * FROM emprestimo WHERE codigo_emprestimo = $codigo_emprestimo");
        return $result;
        // any additional code you need would go here.
    }
    
    public function SelecionaEmprestimosRevistas()
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
         

        $result = $conn->query("SELECT e.data_emprestimo, e.data_devolucao, r.nome_revista, e.status_emprestimo
FROM revista as r, emprestimo as e WHERE r.codigo_revista = e.codigo_revista");
        return $result;
        // any additional code you need would go here.
    }
    
    public function SelecionaEmprestimosLivros()
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        $data1 = date('Y-m-d');
        
        $result = $conn->query("SELECT e.data_emprestimo, e.data_devolucao, l.titulo_livro, e.status_emprestimo
FROM livro as l, emprestimo as e WHERE l.codigo_livro = e.codigo_livro");
        return $result;
        // any additional code you need would go here.
    }

}

?>