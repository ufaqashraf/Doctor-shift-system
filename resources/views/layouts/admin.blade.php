<!doctype html>
<html lang="{{ app()->getLocale() }}">

@include('partials.head')


<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
	<div class="wrapper">

		@include('partials.topnav')
		
		@include('partials.leftsidebar')
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">

			@yield('content')
			
		</div>
		<!-- /.content-wrapper -->
		@include('partials.controlsidebar')
		
		@include('partials.footer')

    </div>
	@include('partials.script')
	<script type="text/javascript">
        $(document).ready(function(){
            $('#datatable').DataTable()
        });
	</script>
	{{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <script>
    @yield('pageScript')
    </script>



	<!-- The core Firebase JS SDK is always required and must be listed first -->
	<script src="https://www.gstatic.com/firebasejs/7.9.1/firebase-app.js"></script>

	<!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#available-libraries -->
	{{--<script src="https://www.gstatic.com/firebasejs/7.9.1/firebase-analytics.js"></script>--}}
	<script src="https://www.gstatic.com/firebasejs/7.9.1/firebase-messaging.js"></script>

    <script>

	var firebaseConfig = {
	apiKey: "AIzaSyBXiKRpiIY0K9ts1GKujUnP7SUmoc4fSBE",
	authDomain: "locumset-e6bdb.firebaseapp.com",
	databaseURL: "https://locumset-e6bdb.firebaseio.com",
	projectId: "locumset-e6bdb",
	storageBucket: "locumset-e6bdb.appspot.com",
	messagingSenderId: "728933452950",
	appId: "1:728933452950:web:191d66839cf88573a1c6b7",
	measurementId: "G-7E6LCCG698"
	};
	// Initialize Firebase
	firebase.initializeApp(firebaseConfig);
	//  firebase.analytics();
	console.log('step 1');
	const messaging = firebase.messaging();

	messaging.usePublicVapidKey("BKrnRB_p5XlIk_uS5bxgc4-t4a-9ZN-sXHPeVgnrEDkhPvarvi0-MyWIp1GJmCkQTJxWo12YY73DMJY0SUbwaQk");
	console.log('step 2');
	messaging.requestPermission().then((permission) => {
	    console.log('permission : ', permission)
	if (permission === 'granted') {
	console.log('Notification permission granted.');
	// TODO(developer): Retrieve an Instance ID token for use with FCM.
	// ...
	} else {
	console.log('Unable to get permission to notify.');
	}
	});


	messaging.getToken().then((currentToken) => {
	if (currentToken) {
	    console.log('currentTokenN : ', currentToken);
	sendTokenToServer(currentToken);
//	updateUIForPushEnabled(currentToken);
	} else {
	// Show permission request.
	console.log('No Instance ID token available. Request permission to generate one.');
	// Show permission UI.
	updateUIForPushPermissionRequired();
	setTokenSentToServer(false);
	}
	}).catch((err) => {
	console.log('An error occurred while retrieving token. ', err);
//	showToken('Error retrieving Instance ID token. ', err);
//	setTokenSentToServer(false);
	});

    function sendTokenToServer(token){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'home/admin_token/'+token,
            type: 'GET',
            success: function( data){
                console.log('data 1 : ', data);
//                if(data){
//                    appendData( data);
//                }
            }
        });

	}
</script>
</body>

</html>
