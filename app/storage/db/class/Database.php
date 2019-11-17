<?php

class Database
{
    private $type;

    private $dir;

    private $filename;

    private $path;

    public $conn;

    public function __construct($type, $dir, $filename)
    {
        $this->type = $type;
        $this->dir = $dir;
        $this->filename = $filename;

        if (!$this->DbExist())
        {
            echo $this->createDB();
        }
    }

    public function deleteDB()
    {
        return unlink($this->getFilePath());
    }

    public function createDB()
    {
        return shell_exec('touch ' . $this->getFilePath());
    }

    public function getConfigPath()
    {
        return $this->path = sprintf(
            '%s:%s/../%s',
            $this->type,
            $this->dir,
            $this->filename
        );
    }

    public function getFilePath()
    {
        return $this->dir . '/../' . $this->filename;
    }

    public function DbExist()
    {
        return file_exists($this->getFilePath());
    }

    public function setConnection()
    {
        $this->conn = new PDO($this->getConfigPath());
        $this->conn->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }

    public function createTable($sql, $name)
    {
        try{
            $exec = $this->conn->exec($sql);
            if(!$exec)
            {
                echo "Successfully create table <$name>.\n";
            }

        }catch (Exception $e)
        {
            echo $e;
        }
    }

    public function insertInto($table, $data)
    {

    }

}
