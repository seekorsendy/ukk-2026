<?php

namespace App\Middleware;

/** Dibuat otomatis oleh RoleController -- hanya role "user" yang boleh lewat. */
class UserOnly extends EnsureRole
{
    protected function roles(): array
    {
        return ['user'];
    }
}
