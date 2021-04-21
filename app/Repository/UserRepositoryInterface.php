<?php

namespace App\Repository;

interface UserRepositoryInterface
{
   public function getAll();

   public function create($data, $imageName);

   public function findByEmail(string $email);
}
