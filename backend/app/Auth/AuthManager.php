<?php

namespace App\Auth;

class AuthManager
{
    protected ?array $user = null;

    public function login(array $user): string
    {
        $this->user = $user;
        \App\Core\Security\Auth::setUser($user);
        return \App\Core\Security\Auth::login($user);
    }

    public function user(): ?array
    {
        return $this->user ?? \App\Core\Security\Auth::user();
    }

    public function check(): bool
    {
        return $this->user() !== null;
    }

    public function logout(): void
    {
        $this->user = null;
        \App\Core\Security\Auth::logout();
    }
}
