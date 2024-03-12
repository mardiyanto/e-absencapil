<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="sys/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="sys/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="absendatang.php">Datang</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="absenpulang.php">Pulang</a>
      </li>
     
    </ul>
    
  </div>
</nav>
                <!-- Begin Page Content -->
				<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <!-- Default Card Example -->
            <div class="card mb-4">
                <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Kamera</h6>
                </div>
                <div class="card-body">
                    <div class="text-center" id="my_camera"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Isikan Kode Kariawan</h6>
                </div>
                <div class="card-body">
                    <form method='post' action='#' enctype='multipart/form-data'>
                        <div class='form-group'>
                            <label>Kode Kariawan</label>
                            <input type='text' class='form-control' name='kode_pegawai' id='kode_pegawai' /><br>
                            <div class='modal-footer'>
                                <button type='button' onClick="take_snapshot()" class='btn btn-primary'>Capture and Save </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    Hasil Kamera
                </div>
                <div class="card-body">
                    <div id="results">Your captured image will appear here...</div>
                </div>
            </div>
        </div>
    </div>
</div>
                <!-- /.container-fluid -->
                <!-- Nested Row within Card Body -->
              
    <!-- Bootstrap core JavaScript-->
    <script src="sys/vendor/jquery/jquery.min.js"></script>
    <script src="sys/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="sys/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="sys/js/sb-admin-2.min.js"></script>
		<!-- First, include the Webcam.js JavaScript Library -->
		<script type="text/javascript" src="webcamjs-master/webcam.min.js"></script>
	<!-- Configure a few settings and attach camera -->
	<script language="JavaScript">
		Webcam.set({
			width: 320,
			height: 240,
			image_format: 'jpeg',
			jpeg_quality: 90
		});
		Webcam.attach( '#my_camera' );
	</script>
	<!-- Code to handle taking the snapshot and displaying it locally -->
	<script language="JavaScript">
		// preload shutter audio clip
		var shutter = new Audio();
		shutter.autoplay = false;
		shutter.src = navigator.userAgent.match(/Firefox/) ? 'webcamjs-master/demos/shutter.ogg' : 'webcamjs-master/demos/shutter.mp3';
		
		function take_snapshot() {
        // play sound effect
        shutter.play();

        // take snapshot and get image data
        Webcam.snap(function (data_uri) {
            // display results in page
            document.getElementById('results').innerHTML =
                '<h2>Here is your image:</h2>' +
                '<img src="' + data_uri + '"/>';

            // Get the ID Pegawai from the input field
            var kode_pegawai = document.getElementById('kode_pegawai').value;

            // Send the image data and ID Pegawai to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_image.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                    // Add any additional logic or response handling here
                }
            };

            // Encode the data URI and ID Pegawai and send it to the server
            xhr.send('image=' + encodeURIComponent(data_uri) + '&kode_pegawai=' + encodeURIComponent(kode_pegawai));
        });
    }
	</script>
</body>
</html>
