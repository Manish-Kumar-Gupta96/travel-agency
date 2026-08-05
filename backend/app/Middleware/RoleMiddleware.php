<?php

namespace App\Middleware;


use Exception;



class RoleMiddleware
{


    /**
     * Allowed Roles
     */
    protected array $roles = [];





    public function __construct(
        array $roles = []
    )
    {

        $this->roles = $roles;

    }





    /**
     * Handle Role Authorization
     */
    public function handle(
        array $request,
        callable $next
    )
    {


        try
        {


            if(
                !isset($request['user'])
            )
            {

                throw new Exception(

                    "User authentication required"

                );

            }





            $userRole =

                $this->getUserRole(

                    $request['user']

                );





            if(
                !$this->hasRole(

                    $userRole

                )
            )
            {

                throw new Exception(

                    "Access denied. Invalid role"

                );

            }





            return $next(

                $request

            );


        }
        catch(Exception $e)
        {


            return [

                'status' => false,

                'code' => 403,

                'message' => $e->getMessage()

            ];


        }


    }





    /**
     * Get User Role
     */
    protected function getUserRole(
        array $user
    ): ?string
    {


        return $user['role']
            ?? null;


    }





    /**
     * Check Role
     */
    protected function hasRole(
        ?string $role
    ): bool
    {


        if(
            empty($role)
        )
        {

            return false;

        }





        return in_array(

            $role,

            $this->roles,

            true

        );


    }





    /**
     * Add Allowed Role
     */
    public function addRole(
        string $role
    ): void
    {


        if(
            !in_array(

                $role,

                $this->roles,

                true

            )
        )
        {

            $this->roles[] = $role;

        }


    }





    /**
     * Get Roles
     */
    public function getRoles(): array
    {

        return $this->roles;

    }





    /**
     * Check Admin Role
     */
    public function isAdmin(
        array $user
    ): bool
    {


        return (

            isset($user['role'])

            &&

            $user['role'] === 'admin'

        );


    }





    /**
     * Check Manager Role
     */
    public function isManager(
        array $user
    ): bool
    {


        return (

            isset($user['role'])

            &&

            $user['role'] === 'manager'

        );


    }





    /**
     * Check Staff Role
     */
    public function isStaff(
        array $user
    ): bool
    {


        return (

            isset($user['role'])

            &&

            $user['role'] === 'staff'

        );


    }





}
