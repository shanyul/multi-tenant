<?php

namespace App\Http\Requests;

class TenantsRequest extends Request
{
    public function rules()
    {
        return [
            'id'            => 'required',
            'domain'        => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'id'        => '租户标识',
            'domain'    => '租户域名',
        ];
    }
}
