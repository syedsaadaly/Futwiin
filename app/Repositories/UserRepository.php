<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepoRepository.
 *
 * @package namespace App\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    public function register(array $data);
    public function login(array $credentials);
    public function logout();
    public function showLoginForm();
    public function showRegistrationForm();
}
