<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('public/AdminLTE/plugins/jquery') }}/jquery.min.js"></script>

{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>--}}
<!-- Bootstrap -->
<script src="{{ asset('public/AdminLTE/plugins/bootstrap/js') }}/bootstrap.bundle.min.js"></script>
 <!-- Parsley -->
 <script src="{{ asset('public/js') }}/parsley.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('public/AdminLTE/plugins/overlayScrollbars/js') }}/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/AdminLTE/dist/js') }}/adminlte.js"></script>
<!-- DataTables -->
<script src="{{ asset('public/AdminLTE/plugins/datatables') }}/jquery.dataTables.js"></script>
<script src="{{ asset('public/AdminLTE/plugins/datatables') }}/dataTables.bootstrap4.js"></script>
<!-- FastClick -->
<script src="{{ asset('public/AdminLTE/plugins/fastclick') }}/fastclick.js"></script>
<!-- date-range-picker -->
<script src="{{ asset('public/AdminLTE/plugins/inputmask') }}/jquery.inputmask.bundle.js"></script>
<script src="{{ url('public/adminlte/plugins/moment') }}/moment.min.js"></script>
<script src="{{ asset('public/AdminLTE/plugins/daterangepicker') }}/daterangepicker.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('public/AdminLTE/plugins/jquery-mousewheel') }}/jquery.mousewheel.js"></script>
<script src="{{ asset('public/AdminLTE/plugins/raphael') }}/raphael.min.js"></script>
<script src="{{ asset('public/AdminLTE/plugins/jquery-mapael') }}/jquery.mapael.min.js"></script>
<script src="{{ asset('public/AdminLTE/plugins/jquery-mapael') }}/maps/world_countries.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('public/AdminLTE/plugins/chart.js') }}/Chart.min.js"></script>
<!-- PAGE SCRIPTS -->
{{--<script src="{{ asset('public/AdminLTE/dist/js/pages') }}/dashboard2.js"></script>--}}
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/AdminLTE/dist/js') }}/demo.js"></script>

{{--<!-- The core Firebase JS SDK is always required and must be listed first -->--}}
{{--<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-app.js"></script>--}}

{{--<!-- TODO: Add SDKs for Firebase products that you want to use--}}
     {{--https://firebase.google.com/docs/web/setup#available-libraries -->--}}
{{--<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-analytics.js"></script>--}}
{{--<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-messaging.js"></script>--}}
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script> --}}

<script>
  jQuery(function () {

    jQuery("#example1").DataTable();
    jQuery('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });

//      $('input.timepicker').timepicker({ timeFormat: 'HH:mm:ss p' });
  });

//  var firebaseConfig = {
//      apiKey: "AIzaSyBXiKRpiIY0K9ts1GKujUnP7SUmoc4fSBE",
//      authDomain: "locumset-e6bdb.firebaseapp.com",
//      databaseURL: "https://locumset-e6bdb.firebaseio.com",
//      projectId: "locumset-e6bdb",
//      storageBucket: "locumset-e6bdb.appspot.com",
//      messagingSenderId: "728933452950",
//      appId: "1:728933452950:web:191d66839cf88573a1c6b7",
//      measurementId: "G-7E6LCCG698"
//  };
//  // Initialize Firebase
//  firebase.initializeApp(firebaseConfig);
////  firebase.analytics();
//  console.log('step 1');
//  const messaging = firebase.messaging();
//
//  messaging.usePublicVapidKey("BBcexCIj65VnfQsLc-xQJGqOzXS4_1Gx6wGtyHTARv6LzuACQ2LLQz7q-NgDy2rKMbpmre-XVaOgMeK57Jh-nKc");
//  console.log('step 2');
//  messaging.requestPermission().then((permission) => {
//      if (permission === 'granted') {
//      console.log('Notification permission granted.');
//      // TODO(developer): Retrieve an Instance ID token for use with FCM.
//      // ...
//  } else {
//      console.log('Unable to get permission to notify.');
//  }
//  });
//
//
//
//
//  messaging.getToken().then((currentToken) => {
//      if (currentToken) {
//          sendTokenToServer(currentToken);
//          updateUIForPushEnabled(currentToken);
//      } else {
//          // Show permission request.
//          console.log('No Instance ID token available. Request permission to generate one.');
//  // Show permission UI.
//  updateUIForPushPermissionRequired();
//  setTokenSentToServer(false);
//  }
//  }).catch((err) => {
//      console.log('An error occurred while retrieving token. ', err);
//  showToken('Error retrieving Instance ID token. ', err);
//  setTokenSentToServer(false);
//  });


</script>

@yield('jsscript')