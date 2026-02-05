<?php
declare(strict_types = 1);
namespace App\Models;
use App\Model;

class SignUp extends Model{
    public function __construct(protected User $userModel, protected Invoice $invoiceModel)
    {
        parent::__construct();
    }
    public function register(array $userInfo, array $invoiceInfo):int{
        try{
            $this->db->beginTransaction();


            $lastInsertId = $this->userModel->create($userInfo['email'], $userInfo['user_name']);
            $invoiceId = $this->invoiceModel->create($invoiceInfo['amount'], $lastInsertId);        



            $this->db->commit();
        }
        catch(\Throwable $e){
            
            if($this->db->inTransaction()){
                
                $this->db->rollBack();
            }
            throw $e;

        }
        return (int) $invoiceId;
    }
}