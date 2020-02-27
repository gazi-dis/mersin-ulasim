<?php

$url = "https://ubs.mersin.bel.tr/hat/77m-yaz---tece---sehir-hastanesi"; // web Site URL
$veri =  file_get_contents($url); // verimiz geldi

$pattern = '@<td>(.*?)</td>@si';

preg_match_all($pattern,$veri,$yazilar);


$posts = array();
for($i=3;$i<30;$i++) {
	// başlığı ve url alıyoruz.
	$saat_kontrol = '@<td>(.*?)</td>@si';
	preg_match($saat_kontrol,$yazilar[0][$i],$saat);
	if (preg_match('/</i', $saat[1])) {
		$posts[$i-3]["saat"] = 'Servis Disi';
	} else{
		$posts[$i-3]["saat"] = trim($saat[1]).':00';
	}
}

//$posts[$i-3]["saat"] = '01:00:00';


// 28 M
$veri =  file_get_contents("https://ubs.mersin.bel.tr/hat/28m-tece-2cevre-yolu-sehir-hastanesi");
preg_match_all($pattern,$veri,$yazilar);

$m28s = array();
for($i=162;$i<222;$i++) {
	// başlığı ve url alıyoruz.
	$saat_kontrol = '@<td>(.*?)</td>@si';
	preg_match($saat_kontrol,$yazilar[0][$i],$saat);
	if (preg_match('/</i', $saat[1])) {
		$m28s[$i-162]["saat"] = 'Servis Disi';
	} else{
		$m28s[$i-162]["saat"] = trim($saat[1]).':00';
	}
}
//$m28s[$i-162]["saat"] = '01:01:00';

// 48 M
$veri =  file_get_contents("https://ubs.mersin.bel.tr/hat/48m--makine-ikmal-karayollari-2cevre-yolu-tece");
preg_match_all($pattern,$veri,$yazilar);

$m48s = array();
for($i=47;$i<62;$i++) {
	// başlığı ve url alıyoruz.
	$saat_kontrol = '@<td>(.*?)</td>@si';
	preg_match($saat_kontrol,$yazilar[0][$i],$saat);
	if (preg_match('/</i', $saat[1])) {
		$m48s[$i-47]["saat"] = 'Servis Disi';
	} else{
		$m48s[$i-47]["saat"] = trim($saat[1]).':00';
	}
}
//$m48s[$i-47]["saat"] = '01:02:00';
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="robots" content="noindex">
	<title>Toplu Taşıma Botu</title>
	<meta name="theme-color" content="#1a2a3e" />
	<link rel="shortcut icon" type="image/png" href="/favicon.png"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body style="background-color: 
#1a2a3e;">
	<section class="container">
		<div class="col-md-12 text-center text-white mt-4" style="font-size: 35px;font-weight: 700;text-shadow: 2px 2px 8px #ffc107;">
			Toplu Taşıma Botu
		</div>
		<!-- Modal -->
			<div class="modal fade" id="bildirim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content bg-warning">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <h1 class="text-center" id="otobus" style="font-weight: 700;"></h1><br>
			        <h3>Numaralı otobüs Teceden yola çıktı</h3>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
			      </div>
			    </div>
			  </div>
			</div>
	<div class="row text-center">
      <div class="col-lg-4 mt-4">
        <div class="card border-warning" style="border-width: 6px;">
          <div class="card-body">
            <h3 class="card-title text-center">77M</h3>
            <hr>
            	<button id="unmuteButton1" class="btn btn-primary px-5" type="button" style="border-radius: 50px;">Sesi Aç</button>
				<div class="mt-3">
					<table class="table table-striped" id="otobus77" style="width:100%">
						<?php
							foreach( $posts as $post) {
						 ?>
						  <tr>
						    <td><?php echo $post['saat']; ?></td>
						  </tr>
						<?php } ?>
					</table>
				</div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mt-4">
        <div class="card border-warning" style="border-width: 6px;">
          <div class="card-body">
            <h3 class="card-title text-center">28M</h3>
            <hr>
            	<button id="unmuteButton2" class="btn btn-primary px-5" type="button" style="border-radius: 50px;">Sesi Aç</button>
				<div class="mt-3">
					<table class="table table-striped" id="otobus28" style="width:100%">
						<?php
							foreach( $m28s as $m28) {
						 ?>
						  <tr>
						    <td><?php echo $m28['saat']; ?></td>
						  </tr>
						<?php } ?>
					</table>
				</div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mt-4">
        <div class="card border-warning" style="border-width: 6px;">
          <div class="card-body">
            <h3 class="card-title text-center">48M</h3>
            <hr>
            	<button id="unmuteButton3" class="btn btn-primary px-5" type="button" style="border-radius: 50px;">Sesi Aç</button>
				<div class="mt-3">
					<table class="table table-striped" id="otobus48" style="width:100%">
						<?php
							foreach( $m48s as $m48) {
						 ?>
						  <tr>
						    <td><?php echo $m48['saat']; ?></td>
						  </tr>
						<?php } ?>
					</table>
				</div>
          </div>
        </div>
      </div>
    </div>
</section>
<footer class="fixed-bottom bg-warning mt-4 py-1">
	<div class="text-center" style="font-color: #1a2a3e;font-size: 25px;">
		This bot was made by <b>Abdurrahman Gazi DİŞ</b>
	</div>
</footer>	

<audio id="m77" muted>
  <source src="77m.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
<audio id="m28" muted>
  <source src="28m.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
<audio id="m48" muted>
  <source src="48m.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>

<!-- <button onclick="playAudio()" type="button">Play Audio</button>
<button onclick="pauseAudio()" type="button">Pause Audio</button>  -->

</body>
</html>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script>
var x = document.getElementById("m77"); 

unmuteButton1.addEventListener('click', function() {
    m77.muted = false;
  });
unmuteButton2.addEventListener('click', function() {
    m28.muted = false;
  });
unmuteButton3.addEventListener('click', function() {
    m48.muted = false;
  });

/*function playAudio() { 
  x.play(); 
} 
function pauseAudio() { 
  x.pause(); 
} */

var saatler_77 = [],saatler_28 = [],saatler_48 = [];

$("table#otobus77 tr").each(function() {
    var arrayOfThisRow = [];
    var tableData = $(this).find('td');
    if (tableData.length > 0) {
        tableData.each(function() { arrayOfThisRow.push($(this).text()); });
        saatler_77.push(arrayOfThisRow);
    }
});
$("table#otobus28 tr").each(function() {
    var arrayOfThisRow = [];
    var tableData = $(this).find('td');
    if (tableData.length > 0) {
        tableData.each(function() { arrayOfThisRow.push($(this).text()); });
        saatler_28.push(arrayOfThisRow);
    }
});
$("table#otobus48 tr").each(function() {
    var arrayOfThisRow = [];
    var tableData = $(this).find('td');
    if (tableData.length > 0) {
        tableData.each(function() { arrayOfThisRow.push($(this).text()); });
        saatler_48.push(arrayOfThisRow);
    }
});

/*x = saatler.toString(saatler[2]);
var metin = x.split(":");
var saat = metin[0];
var dakika = metin[1];

document.write(metin[0]);

var zaman = new Date();
var sim_dakika = zaman.getMinutes();
var sim_saat = zaman.getHours();*/

function kontrol_77(){
	for(var i=0;i<saatler_77.length;i++){
		$('#bildirim').modal('hide');
		x = saatler_77[i].toString();
		var metin = x.split(":");
		var saat = metin[0];
		var dakika = metin[1];

		var zaman = new Date();
		var sim_dakika = zaman.getMinutes();
		var sim_saat = zaman.getHours();

		if (saat==sim_saat && dakika==sim_dakika) {
			document.getElementById('m77').play();
			$('#bildirim').modal('show');
			document.getElementById("otobus").innerHTML = "77M";
		}

	} setTimeout(function(){ kontrol_77(); }, 10000);
}
function kontrol_28(){
	for(var i=0;i<saatler_28.length;i++){
		$('#bildirim').modal('hide');
		x = saatler_28[i].toString();
		var metin = x.split(":");
		var saat = metin[0];
		var dakika = metin[1];

		var zaman = new Date();
		var sim_dakika = zaman.getMinutes();
		var sim_saat = zaman.getHours();

		if (saat==sim_saat && dakika==sim_dakika) {
			document.getElementById('m28').play();
			$('#bildirim').modal('show');
			document.getElementById("otobus").innerHTML = "28M";
		}

	} setTimeout(function(){ kontrol_28(); }, 10000);
}
function kontrol_48(){
	for(var i=0;i<saatler_48.length;i++){
		$('#bildirim').modal('hide');
		x = saatler_48[i].toString();
		var metin = x.split(":");
		var saat = metin[0];
		var dakika = metin[1];

		var zaman = new Date();
		var sim_dakika = zaman.getMinutes();
		var sim_saat = zaman.getHours();

		if (saat==sim_saat && dakika==sim_dakika) {
			document.getElementById('m48').play();
			$('#bildirim').modal('show');
			document.getElementById("otobus").innerHTML = "48M";
		}

	} setTimeout(function(){ kontrol_48(); }, 10000);
}

kontrol_77();
kontrol_28();
kontrol_48();

//document.write(saatler[2]);
</script>

