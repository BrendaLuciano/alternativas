<?php

class Sql extends PDO
{
    const HOSTNAME = "127.0.0.1";
    const USERNAME = "root";
    const PASSWORD = "";
    const DBNAME = "dbalternativas";

    private $conn;

    public function __construct()
    {

        $this->conn = new \PDO(
            "mysql:dbname=" . Sql::DBNAME . ";host=" . Sql::HOSTNAME,
            Sql::USERNAME,
            Sql::PASSWORD
        );
    }

    public function query($rawQuery,  $params = array())
    {
        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;
    }

    private function setParams($stmt, $params = array())
    {
        foreach ($params as $key => $value) {
            $this->setParam($stmt, $key, $value);
        }
    }

    private function setParam($stmt, $key, $value)
    {
        $stmt->bindParam($key, $value);
    }

    public function select($rawQuery, $params = array()): array
    {
        $stmt = $this->query($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
