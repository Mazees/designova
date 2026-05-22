<?php

class AuthController extends Controller
{
    public function login()
    {
        $this->view('auth/login', [
            'title' => 'Login - Designova'
        ]);
    }

    public function register()
    {
        $this->view('auth/register', [
            'title' => 'Register - Designova'
        ]);
    }
}
