<?php

class AuthView {
    private $user = null;

    public function showLogin() {
        require 'templates/formLogin.phtml';
    }

    public function showSignup() {
        require 'templates/form_signup.phtml';
    }
}