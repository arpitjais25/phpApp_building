<?php
declare(strict_types = 1);
namespace App\Models;

use App\Model;

class Invoice extends Model{
    public function create(float $amount, int $userId):int{
        $stmt = $this->db->prepare('INSERT INTO invoise (amount, user_id) VALUES (?,?)');
        $stmt->execute([$amount, $userId]);
        return (int) $this->db->lastInsertId();
    }

    // find

    public function find():array{
        $stmt = $this->db->prepare('SELECT invoise.id AS invoice_id, user_id,amount, full_name 
                                    FROM invoise 
                                    INNER JOIN users ON user_id = users.id ');
        $stmt->execute();
        return (array) $stmt->fetchAll() ??[];
    }
}