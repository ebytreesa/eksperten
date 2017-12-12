@extends('layout.home')

@section('title')
admin
@stop
@section('content')
<div class="row" style="padding-left:100px;">
<h1>Admin</h1>

<p>Username : {{  Auth::user()->username }}</p>
<p>Email : {{  Auth::user()->email }}</p>
</div>
<div class="col-sm-12" style="border:1px solid green; margin:10px;padding-bottom:10px;text-align:center;">
  <a href="/admin/listUsers" ><h3>USERS</h3></a>
</div>

<div class="col-sm-12" style="border:1px solid green; margin:10px;padding-bottom:10px;text-align:center;">
  <a href="/admin/listCat" ><h3>CATEGORIES</h3></a>
</div>
<div class="col-sm-12" style="border:1px solid green; margin:10px;padding-bottom:10px;text-align:center;">
  <a href="/admin/listQA" class="admin-items"> <h3>QA</h3></a>
</div>
<div class="col-sm-12" style="border:1px solid green; margin:10px;padding-bottom:10px;text-align:center;">
  <a href="/admin/listProfanity" class="admin-items"> <h3>Bandeords</h3></a>
</div>


@stop

