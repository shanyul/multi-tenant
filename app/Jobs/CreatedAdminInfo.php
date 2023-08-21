<?php

namespace App\Jobs;

use Stancl\Tenancy\Contracts\Tenant;

class CreatedAdminInfo
{
    protected $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public function handle()
    {
        $this->tenant->run(function ($tenant) {

        });
    }
}
