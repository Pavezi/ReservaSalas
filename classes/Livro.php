<?php

class Livro
{
    private $codigo_livro;
    private $titulo_livro;
    private $edicao_livro;
    private $ano_publicacao_livro;
    private $assunto;
    private $isbn;
    private $codigo_livro_autor;
    private $codigo_autor;
    private $nome_autor;
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
    public function getTitulo_livro()
    {
        return $this->titulo_livro;
    }

    /**
     * @return mixed
     */
    public function getEdicao_livro()
    {
        return $this->edicao_livro;
    }

    /**
     * @return mixed
     */
    public function getAno_publicacao_livro()
    {
        return $this->ano_publicacao_livro;
    }

    /**
     * @return mixed
     */
    public function getAssunto()
    {
        return $this->assunto;
    }

    /**
     * @return mixed
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @return mixed
     */
    public function getCodigo_livro_autor()
    {
        return $this->codigo_livro_autor;
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
     * @param mixed $codigo_livro
     */
    public function setCodigo_livro($codigo_livro)
    {
        $this->codigo_livro = $codigo_livro;
    }

    /**
     * @param mixed $titulo_livro
     */
    public function setTitulo_livro($titulo_livro)
    {
        $this->titulo_livro = $titulo_livro;
    }

    /**
     * @param mixed $edicao_livro
     */
    public function setEdicao_livro($edicao_livro)
    {
        $this->edicao_livro = $edicao_livro;
    }

    /**
     * @param mixed $ano_publicacao_livro
     */
    public function setAno_publicacao_livro($ano_publicacao_livro)
    {
        $this->ano_publicacao_livro = $ano_publicacao_livro;
    }

    /**
     * @param mixed $assunto
     */
    public function setAssunto($assunto)
    {
        $this->assunto = $assunto;
    }

    /**
     * @param mixed $isbn
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    /**
     * @param mixed $codigo_livro_autor
     */
    public function setCodigo_livro_autor($codigo_livro_autor)
    {
        $this->codigo_livro_autor = $codigo_livro_autor;
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

    public function insereDados($titulo, $edicao, $ano, $assunto, $isbn, $nome)
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $sql = "INSERT INTO livro (titulo_livro, edicao_livro, ano_publicacao_livro, assunto, isbn) VALUES (?,?,?,?,?)";
        if ($stmt = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $stmt->bind_param("ssisi", $titulo, $edicao, $ano, $assunto, $isbn);

            $stmt->execute();
            $codigo_livro = $stmt->insert_id;
            
            $sql = "INSERT INTO autor (nome_autor) VALUES (?)";
            if ($stmt = $conn->prepare($sql)) { // assuming $mysqli is the connection
                $stmt->bind_param("s", $nome);
                
                $stmt->execute();
                $codigo_autor = $stmt->insert_id;
                
                $sql = "INSERT INTO livro_autor (codigo_livro, codigo_autor) VALUES (?,?)";
                if ($stmt = $conn->prepare($sql)) { // assuming $mysqli is the connection
                    $stmt->bind_param("ii", $codigo_livro, $codigo_autor);
                    
                    $stmt->execute();
                
                $conn->close();
                // any additional code you need would go here.
                }}} else {
                $error = $stmt->errno . ' ' . $stmt->error;
                echo $error; // 1054 Unknown column 'foo' in 'field list'
            }
    }
    
    public function SelecionaDados($nome_livro)
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("SELECT * FROM livro WHERE titulo_livro LIKE '%$nome_livro%' ORDER BY titulo_livro");
        return $result;
        // any additional code you need would go here.
    }
    
    public function SelecionaDadosGerais()
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("SELECT codigo_livro, titulo_livro FROM livro");
        return $result;
        // any additional code you need would go here.
    }
    
    public function DeletaDados($codigo_livro)
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("DELETE FROM livro WHERE codigo_livro = $codigo_livro");
        
        $result = $conn->query("DELETE FROM livro_autor WHERE codigo_livro = $codigo_livro");
        return $result;
        // any additional code you need would go here.
    }
    
    public function PesquisaDadosLivro($nome_livro)
    {
        $conn = new mysqli("localhost", "root", "root", "biblioteca");
        
        if ($conn->connect_error) {
            echo "error: " . $conn->connect_error;
        }
        
        $result = $conn->query("SELECT e.codigo_emprestimo, e.data_emprestimo, e.data_devolucao, l.titulo_livro, e.status_emprestimo
FROM livro as l, emprestimo as e
WHERE l.titulo_livro LIKE '%$nome_livro%' AND l.codigo_livro = e.codigo_livro");
        return $result;
        // any additional code you need would go here.
    }
    
}

?>