@extends('SchoolAdmin.layouts.main')
@section('title','Permissions')
@section('content')
<style>
    .block-inner { padding: 15px 0px; }
</style>
<div class="create-main-outer pb-5">
    <div class="form-block">
        <h1>Permissions</h1>
        <div class="border rounded d-flex flex-wrap block-inner">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="status">Select Role</label>
                    <select class="selectpicker form-control" id="role_id" name="role_id">
                        <option value="{{ route('schooladmin.roles-permissions.permissions') }}">Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ route('schooladmin.roles-permissions.permissions',["id" => $role->id]) }}" {{ $id  == $role->id ? "selected" : "" }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
@if($id != "")
<form action="{{ route('schooladmin.roles-permissions.permissions.submit',['role_id' => $id]) }}" method="POST" name="permissions_data" class="permissions_data" id="permissions_data">
<table class="table">
    <thead>
      <tr>
        <th scope="col">Module</th>
        <th scope="col">View</th>
        <th scope="col">Add</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($rolesWithPermissions as $role)
    <tr>
        <td scope="row">{{ $role->name}}</td>
        <td>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="view_{{$role->id}}" {{ isset($role->role_permissions($id)->first()->is_view ) && $role->role_permissions($id)->first()->is_view ? "checked" : "" }}>
            </div>
        </td>
        <td>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="add_{{$role->id}}" {{ isset($role->role_permissions($id)->first()->is_add ) && $role->role_permissions($id)->first()->is_add ? "checked" : "" }}>
            </div>
        </td>
        <td>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="edit_{{$role->id}}" {{ isset($role->role_permissions($id)->first()->is_edit ) && $role->role_permissions($id)->first()->is_edit ? "checked" : "" }}>
            </div>
        </td>
        <td>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="delete_{{$role->id}}" {{ isset($role->role_permissions($id)->first()->is_delete ) && $role->role_permissions($id)->first()->is_delete ? "checked" : "" }}>
            </div>
        </td>
    </tr>

    @endforeach

    </tbody>
  </table>
  <div class="form-block pb-5">
    <button type="submit" class="btn btn-primary float-right">Update</button>
</div>
</form>
  @endif
<script>
$("#role_id").change(function(e){
  window.location = $(this).val();
});
</script>
@include('components.ajaxFormSubmit',['formId' => 'permissions_data'])
@endsection
