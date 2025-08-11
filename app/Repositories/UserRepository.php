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
    public function getStats(): array;
    public function getRecentUsers(int $limit);
    public function getRecentPlans(int $limit);
    public function getRecentPredictions(int $limit);
    public function getRecentLeagues(int $limit);
    public function getRecentTeams(int $limit);
    public function getRecentUserPlans(int $limit);
    public function getAllUsers();
    public function deleteUserById($id);
    public function updateProfile(array $data);
}
