 <!-- Main Footer -->
 <footer class="main-footer" style="background-color:#28a745">
    <div style='color:white;'>
      <span>Copyright &copy; 2020 LOCUMSET.</span>
          &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            @if(Auth::user()->role_id == 2)
              <?php
                $dep = \App\Models\Admin\Departments::where(['id'=> Auth::user()->dept_id])->get('name')  ;
                $hosp = \App\Models\Admin\Hospital::where(['id'=> Auth::user()->hospital_id])->get();
              
              ?>
              <i class="nav-icon fas fa-hospital" aria-hidden="true"></i>&nbsp
              <span> {{$hosp[0]['name']}}</span> &nbsp &nbsp &nbsp
              <i class="nav-icon fa fa-envelope" aria-hidden="true"></i>&nbsp
              <span> {{$hosp[0]['email']}}</span> &nbsp &nbsp &nbsp
              <i class="nav-icon fa fa-phone" aria-hidden="true"></i>&nbsp
              <span> {{$hosp[0]['phone']}}</span> &nbsp &nbsp &nbsp
              
            @endif
         
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 1.0.0-DEV
        </div>
    </div>
    
  </footer>