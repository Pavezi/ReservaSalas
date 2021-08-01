<?php

class Sala
{
    
    private $id;
    private $numero;
    private $predio;
    private $lab;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getPredio()
    {
        return $this->predio;
    }

    /**
     * @return mixed
     */
    public function getIs_lab()
    {
        return $this->lab;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @param mixed $predio
     */
    public function setpredio($predio)
    {
        $this->predio = $predio;
    }

    /**
     * @param mixed $lab
     */
    public function setIs_lab($lab)
    {
        $this->lab = $lab;
    }

    public function insereDados($id, $numero, $predio, $lab)
    {
        $conn = new mysqli("us-cdbr-east-04.cleardb.com", "b638c2eed6dd4e", "bc103914", "heroku_28d45ded57ee25e");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $sql = "INSERT INTO sala (id,numero, predio, lab) VALUES (?,?,?,?)";
        if ($stmt = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $stmt->bind_param("iiii", $id,$numero, $predio, $lab);
            
            $stmt->execute();
            
                    $conn->close();
                    // any additional code you need would go here.
                } else {
                    $error = $stmt->errno . ' ' . $stmt->error;
                    echo $error; // 1054 Unknown column 'foo' in 'field list'
                }
    }
    
    public function SelecionaDados($numero)
    {
        $conn = new mysqli("us-cdbr-east-04.cleardb.com", "b638c2eed6dd4e", "bc103914", "heroku_28d45ded57ee25e");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("SELECT * FROM sala WHERE numero LIKE '%$numero%' ORDER BY numero");
        return $result;
        // any additional code you need would go here.
    }
    
    public function SelecionaDadosGerais()
    {
        $conn = new mysqli("us-cdbr-east-04.cleardb.com", "b638c2eed6dd4e", "bc103914", "heroku_28d45ded57ee25e");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("SELECT * FROM sala");
        return $result;
        // any additional code you need would go here.
    }
  
    public function DeletaDados($id)
    {
        $conn = new mysqli("us-cdbr-east-04.cleardb.com", "b638c2eed6dd4e", "bc103914", "heroku_28d45ded57ee25e");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("DELETE FROM sala WHERE id = $id");
        
        return $result;
        // any additional code you need would go here.
    }
    
}

?>