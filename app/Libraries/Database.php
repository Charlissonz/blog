<?php
class Database{
    private $host = 'localhost';
    private $usuario = 'root';
    private $senha = '';
    private $banco = 'blog';
    private $porta = '3306';
    private $dbh;
    private $stmt;

public function __construct(){
    $dsn = 'mysql:host='.this->host.';port='.$this->porta.';dbname='.$this->banco;
    $opcoes = [
        PDO::ATTR_PERSISTENT => TRUE,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    try {
        $this->dbh = new PDO($dsn, $this->usuario, $this->senha, $opcoes);
        $dbh = null;
    } catch (PDOException $e) {
        print "Error!: ". $e->getMessage(). "<br/>";
        die();
    }
}
public function query($sql){
    $this->stmt = $this->dbh->prepare($sql);
}
public function bind($parametro, $valor, $tipo = null){
    if(is_null($tipo)):
    switch (true):
    case is_int($valor):
    $tipo = PDO::PARAM_INT;
    break;
    case is_bool($valor):
    $tipo = PDO::PARAM_BOLL;
    break;
    case is_null($valor):
    $tipo = PDO::PARAM_NULL;
    break;
    default;
    $tipo = PDO::PARAM_STR;
endswitch;
endif;

$this->smtm->bindValue($parametro, $valor, $tipo);
}
public function executa(){
    return $this->stmt->execute();
}
public function resultado(){
    $this->executa();
    return $this ->stmt->fetch(PDO::FETCH_OBJ);
}
public function resultados(){
    $this->executa();
    return $this ->stmt->fetchALL(PDO::FETCH_OBJ);
}
public function totalResultados(){
    return $this->stmt->rowCount();
}
public function ultimoIdInserido(){
    return $this->dbh->lastInsertid();

}
}
?>