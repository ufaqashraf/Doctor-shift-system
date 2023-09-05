@inject('role', 'Spatie\Permission\Models\Role')
<div class="form-group row">
    {!! Form::label('name', 'Name*', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'data-parsley-required' => 'true']) !!}
        <p class="help-block"></p>
        @if($errors->has('name'))
            <p class="help-block">
                {{ $errors->first('name') }}
            </p>
        @endif
    </div>
</div>
<div class="clearfix"></div>
<p class="pull-right">
    <a href="javascript:void(0);" onclick="FormControls.selectUnSelectGlobal('selected');" class="head_permission">Allow all</a>&nbsp;|&nbsp;
    <a href="javascript:void(0);" onclick="FormControls.selectUnSelectGlobal('non-selected');" class="head_permission">Deny all</a>
</p>
<div class="clearfix"></div>
@if(count($GroupPermissions))
    @php($counter = 1)
    <div class="row">
    @foreach($GroupPermissions as $GroupPermission)
    <div class="col-md-4">
            <table class="table table-bordered">
                <tbody>
                <tr style="background-color: lightgrey;">
                    <th>
                        {{ $GroupPermission['title'] }}
                    </th>
                    <th>
                        <div class="btn-group" data-toggle="buttons">
                            <label onclick="FormControls.selectUnSelectGroup('selected', $(this));" class="btn btn-sm @if(isset($AllowedPermissions[$GroupPermission['id']])) active btn-info @else btn-default @endif" data-permission="{{ $GroupPermission['name'] }}">
                                <input id="allow_{{ $GroupPermission['name'] }}" type="checkbox" name="permission[]" class="toggle allow {{ $GroupPermission['name'] }} allow_{{ $GroupPermission['name'] }}" value="{{ $GroupPermission['name'] }}" @if(isset($AllowedPermissions[$GroupPermission['id']])) checked="true" @endif> Allow
                            </label>
                            <label onclick="FormControls.selectUnSelectGroup('non-selected', $(this));" class="btn btn-sm @if(isset($AllowedPermissions[$GroupPermission['id']])) btn-default @else active btn-info @endif" data-permission="{{ $GroupPermission['name'] }}">
                                <input id="noallow_{{ $GroupPermission['name'] }}" type="checkbox" class="toggle noallow {{ $GroupPermission['name'] }} noallow_{{ $GroupPermission['name'] }}"> Deny
                            </label>
                        </div>
                    </th>
                </tr>
                @if(count($SubPermissions))
                    @foreach($SubPermissions as $SubPermission)
                        @if($SubPermission['parent_id'] == $GroupPermission['id'] || $SubPermission['id'] == $GroupPermission['id'])
                            <tr>
                                <td align="right">{{ $SubPermission['title'] }}</td>
                                <td>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label onclick="FormControls.selectUnSelectSubGroup('selected', $(this));" class="btn btn-sm @if(isset($AllowedPermissions[$SubPermission['id']])) active btn-info @else btn-default @endif" data-permission="{{ $GroupPermission['name'] }}" data-sub_permission="{{ $SubPermission['name'] }}">
                                            <input id="sub-allow_{{ $SubPermission['name'] }}" type="checkbox" name="permission[]" class="toggle allow {{ $GroupPermission['name'] }} sub-allow_{{ $GroupPermission['name'] }}" value="{{ $SubPermission['name'] }}" @if(isset($AllowedPermissions[$GroupPermission['id']])) checked="true" @endif> Allow
                                        </label>
                                        <label onclick="FormControls.selectUnSelectSubGroup('non-selected', $(this));" class="btn btn-sm @if(isset($AllowedPermissions[$SubPermission['id']])) btn-default @else active btn-info @endif" data-permission="{{ $GroupPermission['name'] }}" data-sub_permission="{{ $SubPermission['name'] }}">
                                            <input id="sub-noallow_{{ $SubPermission['name'] }}" type="checkbox" class="toggle noallow {{ $GroupPermission['name'] }} sub-noallow_{{ $GroupPermission['name'] }}"> Deny
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        @php($counter++)
        @if($counter == 4)
            @php($counter = 1)
            <div class="clear clearfix"></div>
        @endif
    @endforeach
</div>
@endif

<div class="clear clearfix"></div>