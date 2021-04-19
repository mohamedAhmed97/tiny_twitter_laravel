<?php
 namespace App\Repository;
 use Illuminate\Http\Request;
 use App\Http\Requests\Auth\LoginRequest;

 interface UserRepositoryInterface {
    
      public function create($data,$imageName);
 
      public function findByEmail(string $email);
 
   }
