@extends('base')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Role: {{ $role->name }}
                        <a href="{{ url('roles') }}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            @error('permission')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <label class="fw-bold d-block">Permissions</label>

                            <!-- Search Bar -->
                            <input type="text" id="searchPermission" class="form-control mb-3" placeholder="Search permissions...">

                            <!-- Check All Checkbox -->
                            <div class="form-check mb-3">
                                <input type="checkbox" id="checkAll" class="form-check-input">
                                <label for="checkAll" class="form-check-label fw-bold">Check All</label>
                            </div>

                            <!-- Permissions Grid -->
                            <div class="row row-cols-1 row-cols-md-3 g-3" id="permissionList">
                                @foreach ($permissions as $permission)
                                    <div class="col permission-item">
                                        <div class="form-check">
                                            <input type="checkbox" 
                                                   class="form-check-input permission-checkbox" 
                                                   name="permission[]" 
                                                   value="{{ $permission->name }}" 
                                                   {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ ucfirst(str_replace('_', ' ', $permission->name)) }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">Update Permissions</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- JavaScript for "Check All" and Search Functionality -->
<script>
    document.getElementById('checkAll').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.permission-checkbox');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.getElementById('searchPermission').addEventListener('input', function() {
        let searchValue = this.value.toLowerCase();
        let permissionItems = document.querySelectorAll('.permission-item');
        
        permissionItems.forEach(item => {
            let label = item.querySelector('.form-check-label').innerText.toLowerCase();
            if (label.includes(searchValue)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>

@endsection
