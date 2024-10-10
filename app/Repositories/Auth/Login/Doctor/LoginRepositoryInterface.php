<?php
namespace App\Repositories\Auth\Login\Doctor;

interface LoginRepositoryInterface{
    public function login($request,$model);
    public function logout($request);
}