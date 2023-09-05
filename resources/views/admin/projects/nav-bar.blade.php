  @inject('request', 'Illuminate\Http\Request')
  <li class="{{$request->segment(4)== 'edit'? 'active' :''}}" ><a href="{{ route('admin.projects.edit',[$Project->id]) }}">Project Details</a></li>
            <!-- <li class="{{$request->segment(3)== 'calls'? 'active' :''}}" ><a href="{{ route('admin.projects.calls',[$Project->id]) }}">Unit Calls</a>
            </li>
            <li class="{{$request->segment(3)== 'cast_call'? 'active' :''}}" ><a href="{{ route('admin.projects.cast_call',[$Project->id]) }}">Cast Call time</a>
            </li> -->
            <li class="{{$request->segment(3)== 'schedule'? 'active' :''}}"><a href="{{ route('admin.projects.schedule',[$Project->id]) }}">Shooting schedule</a>
            </li>
  <!--{<!----<li class="{{$request->segment(3)== 'recce'? 'active' :''}}"><a href="{{ route('admin.projects.recce',[$Project->id]) }}">Recce Notes</a>--}}
            {{--</li>--}}
            {{--<li><a href="{{ route('admin.projects.documents',[$Project->id]) }}">Users</a>--}}
}            </li>--} -->