 {{-- // check if someone is logged in as normal user --}}
@if (Auth::guard('web')->check())
    <p class="text-success">
        You are Logged In as <strong>User</strong>
    </p>
@else
    <p class="text-danger">
        You are Logged Out as a <strong>User</strong>
    </p>
@endif

{{-- // check if someone is logged in as warehouse clerk --}}
@if (Auth::guard('admin')->check()) 
    <p class="text-success">
    You are Logged In as Employee Type ID <strong>{{ Auth::user()->employee_type_id }}</strong>
    </p>
@else
    <p class="text-danger">
        You are Logged Out as a <strong>Warehouse Clerk</strong>
    </p>
@endif