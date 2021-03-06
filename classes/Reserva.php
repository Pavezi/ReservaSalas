<?php

class Reserva
{
    
    private $id;
    private $id_sala;
    private $horario_uso;
    private $dia_uso;
    private $responsavel;
    private $curso;
    private $ocupado;
    private $observacao;
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
    public function getIdSala()
    {
        return $this->id_sala;
    }

    /**
     * @return mixed
     */
    public function getHorarioDeUso()
    {
        return $this->horario_uso;
    }

    /**
     * @return mixed
     */
    public function getDiaDeUso()
    {
        return $this->dia_uso;
    }

    /**
     * @return mixed
     */
    public function getResponsavel()
    {
        return $this->responsavel;
    }

    /**
     * @return mixed
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * @return mixed
     */
    public function getOcupado()
    {
        return $this->ocupado;
    }

    /**
     * @return mixed
     */
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $id_sala
     */
    public function setId_sala($id_sala)
    {
        $this->id_sala = $id_sala;
    }

    /**
     * @param mixed $horario_uso
     */
    public function setHorario_de_uso($horario_uso)
    {
        $this->horario_uso = $horario_uso;
    }

    /**
     * @param mixed $dia_uso
     */
    public function setDia_de_uso($dia_uso)
    {
        $this->dia_uso = $dia_uso;
    }

    /**
     * @param mixed $dia_uso
     */
    public function setResponsavel($responsavel)
    {
        $this->responsavel = $responsavel;
    }

    /**
     * @param mixed $dia_uso
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;
    }

    /**
     * @param mixed $dia_uso
     */
    public function setOcupado($ocupado)
    {
        $this->ocupado = $ocupado;
    }

    /**
     * @param mixed $dia_uso
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;
    }
    


    public function setUpdateReserva($id, $id_sala, $horario_uso, $dia_uso, $responsavel, $curso, $ocupado, $observacao){
        $conn = new mysqli("b638c2eed6dd4e:bc103914@us-cdbr-east-04.cleardb.com", "b638c2eed6dd4e", "bc103914", "heroku_28d45ded57ee25e");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        $sql = "UPDATE reserva SET id_sala = ?, horario_uso = ?, dia_uso = ?, responsavel = ?, curso = ?, ocupado = ?, observacao = ? WHERE id = $id";
        if ($stmt = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $stmt->bind_param("issssis", $id_sala, $horario_uso, $dia_uso, $responsavel, $curso, $ocupado, $observacao);
            
            $stmt->execute();
            
            $conn->close();
            // any additional code you need would go here.
        } else {
            $error = $stmt->errno . ' ' . $stmt->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
        }
    }

    public function insereDados($id, $id_sala, $horario_uso, $dia_uso, $responsavel, $curso, $ocupado, $observacao)
    {
        $conn = new mysqli("us-cdbr-east-04.cleardb.com", "b638c2eed6dd4e", "bc103914", "heroku_28d45ded57ee25e");
      
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $sql = "INSERT INTO reserva (id, id_sala, horario_uso, dia_uso, responsavel, curso, ocupado, observacao) VALUES (?,?,?,?,?,?,?,?)";
        if ($stmt = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $stmt->bind_param("iissssis", $id, $id_sala, $horario_uso, $dia_uso, $responsavel, $curso, $ocupado, $observacao);
            
            $stmt->execute();
            
                    $conn->close();
                    // any additional code you need would go here.
                } else {
                    $error = $stmt->error . ' ' . $stmt->error;
                    echo $error; // 1054 Unknown column 'foo' in 'field list'
                }
    }
    
    public function SelecionaDados($id)
    {
        $conn = new mysqli("b638c2eed6dd4e:bc103914@us-cdbr-east-04.cleardb.com", "b638c2eed6dd4e", "bc103914", "heroku_28d45ded57ee25e");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("SELECT * FROM reserva WHERE id LIKE '%$id%' ORDER BY id");
        return $result;
        // any additional code you need would go here.
    }
    
    public function SelecionaDadosGerais()
    {
        $conn = new mysqli("b638c2eed6dd4e:bc103914@us-cdbr-east-04.cleardb.com", "b638c2eed6dd4e", "bc103914", "heroku_28d45ded57ee25e");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("SELECT Id, id_sala FROM reserva");
        return $result;
        // any additional code you need would go here.
    }
    
    public function DeletaDados($id)
    {
        $conn = new mysqli("b638c2eed6dd4e:bc103914@us-cdbr-east-04.cleardb.com", "b638c2eed6dd4e", "bc103914", "heroku_28d45ded57ee25e");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("DELETE FROM reserva WHERE id = $id");
        
        return $result;
        // any additional code you need would go here.
    }
    
}
