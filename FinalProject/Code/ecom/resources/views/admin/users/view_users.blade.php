@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('admin') }}">Users</a> <a href="#" class="current">View Users</a> </div>
    <h1>Users</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Orders</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>User ID</th>
                  <th>Join Date</th>
                  <th>User Name</th>
                  <th>User Email</th>
                  <th>User Country</th>
                  <th>User Mobile</th>
                  <th>User Permission</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($users as $user)
                  <tr class="gradeX">
                  <td class="center">{{ $user->id }}</td>
                  <td class="center">{{ $user->created_at }}</td>
                  <td class="center">{{ $user->name }}</td>
                  <td class="center">{{ $user->email }}</td>
                  <td class="center">{{ $user->country }}</td>
                  <td class="center">{{ $user->mobile }}</td>
                  @if($user->admin == 1) 
                    <td class="center">
                    <form action="{{ url('admin/view-users/update-permision') }}" method="post">{{ csrf_field() }}
                      <input type="hidden" name="user_id" value="{{ $user->id }}">
                      <select name="update_permision" value="{{ $user->admin }}">
                        <option value="1">Admin</option>
                        <option value="0">User</option>
                      </select>
                      <button type="submit" class="btn btn-success btn-mini">Change</button>

                    </form> 
                  </td>
                  @else
                    <td class="center">
                      <form action="{{ url('admin/view-users/update-permision') }}" method="post">{{ csrf_field() }}
                      <input type="hidden" name="user_id" value="{{ $user->id }}">
                      <select name="update_permision" value="{{ $user->admin }}">
                        <option value="0">User</option>
                        <option value="1">Admin</option>
                      </select>
                      <button type="submit" class="btn btn-success btn-mini">Change</button>

                    </form> 
                    </td>
                  @endif
                  <td class="center">
                    <a target="_blank" href="{{ url('admin/view-user/'.$user->id) }}" class="btn btn-success btn-mini">View User Details</a> 
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection