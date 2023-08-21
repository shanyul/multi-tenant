@extends('layouts.app')
@section('title', '租户列表')

@section('content')
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card panel-default">
        <div class="card-header">
          所有租户
          <a href="/tenants/create" class="float-right">新增租户</a>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>租户标识</th>
              <th>租户域名</th>
              <th>租户数据库</th>
              <th>创建时间</th>
              <th>更新时间</th>
              <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tenants as $tenant)
              <tr>
                <td>{{ $tenant->id }}</td>
                <td>{{ $tenant->domain }}</td>
                <td>{{ $tenant->tenancy_db_name }}</td>
                <td>{{ $tenant->created_at }}</td>
                <td>{{ $tenant->updated_at }}</td>
                <td>
                  <button class="btn btn-danger btn-del-address" type="button" data-id="{{ $tenant->id }}">删除</button>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scriptsAfterJs')
<script>
$(document).ready(function() {
  // 删除按钮点击事件
  $('.btn-del-address').click(function() {
    // 获取按钮上 data-id 属性的值，也就是地址 ID
    var id = $(this).data('id');
    // 调用 sweetalert
    swal({
        title: "确认要删除该地址？",
        icon: "warning",
        buttons: ['取消', '确定'],
        dangerMode: true,
      })
    .then(function(willDelete) { // 用户点击按钮后会触发这个回调函数
      // 用户点击确定 willDelete 值为 true， 否则为 false
      // 用户点了取消，啥也不做
      if (!willDelete) {
        return;
      }
      // 调用删除接口，用 id 来拼接出请求的 url
      axios.delete('/tenants/' + id)
        .then(function () {
          // 请求成功之后重新加载页面
          location.reload();
        })
    });
  });
});
</script>
@endsection
