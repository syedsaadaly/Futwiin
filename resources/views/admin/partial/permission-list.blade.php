<div class="form-group">
    <label for="permissions">Permissions for Role: <strong>{{ $roleName }}</strong></label>
    <div class="row">
        @foreach ($Newpermissions as $category => $perms)
            <div class="col-md-6 col-12">
                <h5 class="mt-3">{{ $category }}</h5>

                <ul style="list-style: none; padding-left: 0;">
                    @foreach ($perms as $key => $label)
                        <li>{{ $label }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>

