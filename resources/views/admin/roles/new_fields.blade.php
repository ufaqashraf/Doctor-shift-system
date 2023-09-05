@inject('role', 'Spatie\Permission\Models\Role')

<div class="form-group row">
    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
    <p class="help-block"></p>
    @if($errors->has('name'))
        <p class="help-block">
            {{ $errors->first('name') }}
        </p>
    @endif
</div>
<div class="clearfix"></div>
<p class="pull-right">
    <!-- <a href="javascript:void(0);" onclick="FormControls.selectUnSelectGlobal('selected');" class="head_permission">Allow all</a> -->&nbsp;|&nbsp;
    <input id="allow_all" type="checkbox"  class="allow_all" value="allow_all" onclick="FormControls.checkAll(this);" checked="true"> ALLOW ALL
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
                    <th width="60%">
                        {{ $GroupPermission['title'] }}
                    </th>
                    <th>
                        <label  id="id-{{ $GroupPermission['name'] }}" class="btn btn-sm  p-id-allow_{{ $GroupPermission['name'] }} id-allow_{{ $GroupPermission['name'] }} label_all @if(isset($AllowedPermissions[$GroupPermission['id']])) all active btn-info @else btn-default @endif" data-permission="{{ $GroupPermission['name'] }}">
                            <input id="allow_{{ $GroupPermission['name'] }}" type="checkbox" name="permission[]" class="allow_all allow {{ $GroupPermission['name'] }} allow_{{ $GroupPermission['name'] }}" value="{{ $GroupPermission['name'] }}" @if(isset($AllowedPermissions[$GroupPermission['id']])) checked="true" @endif onclick="FormControls.checkMyModule(this,'allow_{{ $GroupPermission['name'] }}');"> Allow
                        </label>
                    </th>
                </tr>
                @if(count($SubPermissions))
                    @foreach($SubPermissions as $SubPermission)
                        @if($SubPermission['parent_id'] == $GroupPermission['id'] || $SubPermission['id'] == $GroupPermission['id'])
                            <tr>
                                <td align="right">{{ $SubPermission['title'] }}</td>
                                <td>
                                    <label id="id-{{ $SubPermission['name'] }}" class="btn btn-sm  id-allow_{{ $GroupPermission['name'] }} label_all @if(isset($AllowedPermissions[$SubPermission['id']])) active btn-info all @else btn-default @endif" data-permission="{{ $GroupPermission['name'] }}" data-sub_permission="{{ $SubPermission['name'] }}">
                                        {{--<input id="sub-allow_{{ $SubPermission['name'] }}" type="checkbox" name="permission[]" class="allow_all allow {{ $GroupPermission['name'] }}  sub-allow_{{ $GroupPermission['name'] }}" value="{{ $SubPermission['name'] }}" @if(isset($AllowedPermissions[$GroupPermission['id']])) checked="true" @endif onclick="FormControls.checkMyParent(this,'allow_{{ $GroupPermission['name'] }}' , 'sub-allow_{{ $GroupPermission['name'] }}', '{{ $SubPermission['name'] }}' );"> Allow--}}
                                        <input id="sub-allow_{{ $SubPermission['name'] }}" type="checkbox" name="permission[]" class="allow_all allow {{ $GroupPermission['name'] }}  sub-allow_{{ $GroupPermission['name'] }}" value="{{ $SubPermission['name'] }}" @if(isset($AllowedPermissions[$SubPermission['id']])) checked="true" @endif onclick="FormControls.checkMyParent(this,'allow_{{ $GroupPermission['name'] }}' , 'sub-allow_{{ $GroupPermission['name'] }}', '{{ $SubPermission['name'] }}' );"> Allow
                                    </label>

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