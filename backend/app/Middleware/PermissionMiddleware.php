<?php

namespace App\Middleware;


use App\Services\PermissionService;


use Exception;



class PermissionMiddleware
{


    protected PermissionService $permissionService;


    protected array $permissions = [];





    public function __construct(
        PermissionService $permissionService,
        array $permissions = []
    )
    {

        $this->permissionService = $permissionService;

        $this->permissions = $permissions;

    }





    /**
     * Handle Permission Check
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





            $userId =

                $request['user']['id'];





            foreach(
                $this->permissions as $permission
            )
            {


                if(
                    !$this->checkPermission(

                        $userId,

                        $permission

                    )
                )
                {

                    throw new Exception(

                        "Permission denied: ".$permission

                    );

                }


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
     * Check User Permission
     */
    protected function checkPermission(
        int $userId,
        string $permission
    ): bool
    {


        return $this->permissionService->hasPermission(

            $userId,

            $permission

        );


    }





    /**
     * Add Permission
     */
    public function addPermission(
        string $permission
    ): void
    {


        if(
            !in_array(

                $permission,

                $this->permissions,

                true

            )
        )
        {

            $this->permissions[] = $permission;

        }


    }





    /**
     * Get Permissions
     */
    public function getPermissions(): array
    {

        return $this->permissions;

    }





    /**
     * Check Multiple Permissions
     */
    public function hasAnyPermission(
        int $userId,
        array $permissions
    ): bool
    {


        foreach(
            $permissions as $permission
        )
        {


            if(
                $this->checkPermission(

                    $userId,

                    $permission

                )
            )
            {

                return true;

            }


        }





        return false;


    }





    /**
     * Check All Permissions
     */
    public function hasAllPermissions(
        int $userId,
        array $permissions
    ): bool
    {


        foreach(
            $permissions as $permission
        )
        {


            if(
                !$this->checkPermission(

                    $userId,

                    $permission

                )
            )
            {

                return false;

            }


        }





        return true;


    }





}
