@extends('layouts.app')
@section('title', ($tenant->id ? '修改': '新增') . '租户')

@section('content')
<div class="row">
    <div class="col-md-10 offset-lg-1">
    <div class="card">
  <div class="card-header">
    <h2 class="text-center">
      {{ $tenant->id ? '修改': '新增' }}租户
    </h2>
  </div>
  <div class="card-body">
    <!-- 输出后端报错开始 -->
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <h4>有错误发生：</h4>
        <ul>
          @foreach ($errors->all() as $error)
            <li><i class="glyphicon glyphicon-remove"></i> {{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <!-- 输出后端报错结束 -->
      @if($tenant->id)
        <form class="form-horizontal" role="form" action="/tenants/{{ $tenant->id }}" method="post">
          {{ method_field('PUT') }}
      @else
        <form class="form-horizontal" role="form" action="/tenants" method="post">
      @endif
      {{ csrf_field() }}
        <div class="form-group row">
          <label class="col-form-label text-md-right col-sm-2">租户标识</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="id" value="{{ old('id', $tenant->id) }}">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label text-md-right col-sm-2">租户域名</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="domain" value="{{ old('domain', $tenant->domain) }}" placeholder="多个域名以|隔开">
          </div>
        </div>
        <div class="form-group row text-center">
          <div class="col-12">
            <button type="submit" class="btn btn-primary">提交</button>
          </div>
        </div>
      </form>
  </div>
</div>
</div>
</div>
@endsection
