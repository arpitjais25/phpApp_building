<?php
declare(strict_types =1);
namespace App;
class DB{
    private \PDO $pdo;
    public function __construct(
        array $config
    )
    {
        $defaultOptions = [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_EMULATE_PREPARES =>false
        ];
        
         try{
            $this->pdo = new \PDO($config['driver'].':host='.$config['host'].';dbname='.$config['db_database'], $config['user'],$config['password'],
                $config['options']??$defaultOptions
            );
            // var_dump($db);
        }
        catch(\PDOException $e){
           echo $e->getMessage()." ".$e->getCode().$e->getLine();       
        }
        // return $this->pdo ;
    }
}