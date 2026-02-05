<?php
declare(strict_types = 1);
namespace App\Models;

use App\Model;

class User extends Model{
    public function create(string $email, string $full_name, bool $is_Active = true):int{
        $newUserStmt = $this->db->prepare('INSERT INTO users (email, full_name, is_active, created_at) VALUES (?,?,?,NOW())');
        $newUserStmt->execute([$email, $full_name, $is_Active]);
        return (int) $this->db->lastInsertId();
    }
}