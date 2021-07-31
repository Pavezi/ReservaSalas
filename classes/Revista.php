<?php

class Revista
{
    private $codigo_revista;
    private $nome_revista;
    private $tema_revista;
    private $ano;
    private $numero;
    private $issn;
    private $codigo_revista_autor;
    private $codigo_autor;
    private $nome_autor;
    
    /**
     * @return mixed
     */
    public function getCodigo_revista_autor()
    {
        return $this->codigo_revista_autor;
    }

    /**
     * @return mixed
     */
    public function getCodigo_autor()
    {
        return $this->codigo_autor;
    }

    /**
     * @return mixed
     */
    public function getNome_autor()
    {
        return $this->nome_autor;
    }

    /**
     * @param mixed $codigo_revista_autor
     */
    public function setCodigo_revista_autor($codigo_revista_autor)
    {
        $this->codigo_revista_autor = $codigo_revista_autor;
    }

    /**
     * @param mixed $codigo_autor
     */
    public function setCodigo_autor($codigo_autor)
    {
        $this->codigo_autor = $codigo_autor;
    }

    /**
     * @param mixed $nome_autor
     */
    public function setNome_autor($nome_autor)
    {
        $this->nome_autor = $nome_autor;
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
    public function getNome_revista()
    {
        return $this->nome_revista;
    }

    /**
     * @return mixed
     */
    public function getTema_revista()
    {
        return $this->tema_revista;
    }

    /**
     * @return mixed
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @return mixed
     */
    public function getIssn()
    {
        return $this->issn;
    }

    /**
     * @param mixed $codigo_revista
     */
    public function setCodigo_revista($codigo_revista)
    {
        $this->codigo_revista = $codigo_revista;
    }

    /**
     * @param mixed $nome_revista
     */
    public function setNome_revista($nome_revista)
    {
        $this->nome_revista = $nome_revista;
    }

    /**
     * @param mixed $tema_revista
     */
    public function setTema_revista($tema_revista)
    {
        $this->tema_revista = $tema_revista;
    }

    /**
     * @param mixed $ano
     */
    public function setAno($ano)
    {
        $this->ano = $ano;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @param mixed $issn
     */
    public function setIssn($issn)
    {
        $this->issn = $issn;
    }
    
    public function insereDados($nome, $tema, $ano, $numero, $issn, $autor)
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $sql = "INSERT INTO revista (nome_revista, tema_revista, ano, numero, issn) VALUES (?,?,?,?,?)";
        if ($stmt = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $stmt->bind_param("ssiii", $nome, $tema, $ano, $numero, $issn);
            
            $stmt->execute();
            $codigo_revista = $stmt->insert_id;
            
            $sql = "INSERT INTO autor (nome_autor) VALUES (?)";
            if ($stmt = $conn->prepare($sql)) { // assuming $mysqli is the connection
                $stmt->bind_param("s", $autor);
                
                $stmt->execute();
                $codigo_autor = $stmt->insert_id;
                
                $sql = "INSERT INTO revista_autor (codigo_autor, codigo_revista) VALUES (?,?)";
                if ($stmt = $conn->prepare($sql)) { // assuming $mysqli is the connection
                    $stmt->bind_param("ii", $codigo_autor, $codigo_revista);
                    
                    $stmt->execute();
                    
                    $conn->close();
                    // any additional code you need would go here.
                }}} else {
                    $error = $stmt->errno . ' ' . $stmt->error;
                    echo $error; // 1054 Unknown column 'foo' in 'field list'
                }
    }
    
    public function SelecionaDados($nome_revista)
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("SELECT * FROM revista WHERE nome_revista LIKE '%$nome_revista%' ORDER BY nome_revista");
        return $result;
        // any additional code you need would go here.
    }
    
    public function PesquisaDadosRevista($nome_revista)
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("SELECT e.codigo_emprestimo, e.data_emprestimo, e.data_devolucao, r.nome_revista, e.status_emprestimo 
FROM revista as r, emprestimo as e 
WHERE r.nome_revista LIKE '%$nome_revista%' AND r.codigo_revista = e.codigo_revista");
        return $result;
        // any additional code you need would go here.
    }
    
    public function SelecionaDadosGerais()
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("SELECT codigo_revista, nome_revista FROM revista");
        return $result;
        // any additional code you need would go here.
    }
    
    
    public function DeletaDados($codigo_revista)
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("DELETE FROM revista WHERE codigo_revista = $codigo_revista");
        
        $result = $conn->query("DELETE FROM revista_autor WHERE codigo_revista = $codigo_revista");
        return $result;
        // any additional code you need would go here.
    }

}

?>