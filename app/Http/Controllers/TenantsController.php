<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Requests\TenantsRequest;

class TenantsController extends Controller
{
    public function index(Request $request)
    {
        $tenants = Tenant::query()->with('domains')->get();
        foreach ($tenants as $tenant){
            $domains = [];
            foreach ($tenant->domains as $domain){
                $domains[] = $domain->domain;
            }
            $tenant->domain = implode(',', $domains);
        }
        return view('tenants.index', [
            'tenants' => $tenants,
        ]);
    }

    public function create()
    {
        $tenant = new Tenant();
        $tenant->domain = '';
        return view('tenants.create_and_edit', ['tenant' => $tenant]);
    }

    public function store(TenantsRequest $request)
    {
        $id = $request->get('id');
        $domain = explode('|', $request->get('domain', $id));
        $tenant = Tenant::query()->create(['id' => $id]);
        foreach ($domain as $val){
            $tenant->domains()->create(['domain' => $val]);
        }

        return redirect('/');
    }

    public function edit(Tenant $tenant)
    {
        $domains = [];
        foreach ($tenant->domains as $domain){
            $domains[] = $domain->domain;
        }
        $tenant->domain = implode(',', $domains);
        return view('tenants.create_and_edit', ['tenant' => $tenant]);
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        // 把之前的 redirect 改成返回空数组
        return [];
    }
}
