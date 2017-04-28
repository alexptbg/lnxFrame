<!DOCTYPE html>
<html lang="en">
<?php
$dir = "./slider/";
$dirs = array_diff(scandir($dir),array('..', '.'));
$file_display = array('jpg','jpeg','png','JPG','JPEG','PNG');
$dir_contents = scandir($dir);
foreach ($dir_contents as $file) {
  $ext = explode('.',$file);
  $extension = $ext[1];
  $file_type = strtolower($extension);
  if ($file !== '.' && $file !== '..' && in_array($file_type, $file_display) == true) {
    $paths[] = $dir.$file;
  }
}				    
shuffle($paths);
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link type="text/css" rel="stylesheet" href="css/digital-7.css" />
  <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css" />
  <link type="text/css" rel="stylesheet" href="css/weather-icons.min.css" />
  <link type="text/css" rel="stylesheet" href="css/ka-ex.css" />
  <link type="text/css" rel="stylesheet" href="css/alex.css" />
</head>
<body>
    <div class="container">
      <div id="clock">
          <!--<p id="week"><span>ПОН</span><span>ВТО</span><span>СРД</span><span>ЧЕТ</span><span>ПЕТ</span><span>СЪБ</span><span>НЕД</span></p>-->
          <p id="week"><span>ПО</span><span>ВТ</span><span>СР</span><span>ЧЕ</span><span>ПЕ</span><span>СЪ</span><span>НЕ</span></p>
          <p id="ctime"></p>
          <p id="cdate"></p>
      </div>
      <div id="weather">
          <p id="zone">Гоце Делчев</p>
          <!--<img id="cond" src="img/na.png" alt="cond" />-->
          <p id="icond"><i class="wi"></i></p>
          <p id="condi">&nbsp;</p>
          <p id="temps"><span id="min">&nbsp;</span><span id="temp">&nbsp;</span><span id="max">&nbsp;</span></p>
          <!--<p id="ext"><span id="min">&nbsp;</span><span id="max">&nbsp;</span></p>-->
          <p id="ext"><span id="hum">&nbsp;</span><span id="wind">&nbsp;</span></p>
          <p id="ext"><span id="nuv">&nbsp;</span><span id="mb">&nbsp;</span></p>
          <p id="ext"><span id="sunrise">&nbsp;</span><span id="sunset">&nbsp;</span></p>
      </div>
      <div id="chip">
          <p id="cpu">--.-</p>
      </div>
      <div id="rooms">
          <p id="room">ХОЛ: <span id="temp1">--.-</span></p>
      </div>
      <div id="rooms">
          <p id="room">СТАЯ: <span id="temp2">--.-</span></p>
      </div>
      <div id="controls">
         <button id="start" type="button"><i class="fa fa-power-off" aria-hidden="true"></i></button>
         <button id="play" type="button"><i class="fa fa-play" aria-hidden="true"></i></button> 
         <button id="prev" type="button"><i class="fa fa-step-backward" aria-hidden="true"></i></button> 
         <button id="next" type="button"><i class="fa fa-step-forward" aria-hidden="true"></i></button>
      </div>
      <div id="controls">
         <button id="pause" type="button"><i class="fa fa-pause" aria-hidden="true"></i></button>
         <button id="stop" type="button"><i class="fa fa-stop" aria-hidden="true"></i></button>
         <button id="refresh" type="button"><i class="fa fa-refresh" aria-hidden="true"></i></button>
         <button id="reboot" type="button"><i class="fa fa-retweet" aria-hidden="true"></i></button>
      </div>
    </div>
	<script src="js/jquery-1.12.3.min.js"></script>
    <script src="js/jquery.backstretch.min.js"></script>
  <script type="text/javascript" src="js/moment.min.js"></script>
  <script type="text/javascript" src="js/moment-timezone-with-data-2010-2020.js"></script>
  <script type="text/javascript">
  $(function() {
    /*
    $('body').mouseover(function(){
      $(this).css({cursor: 'none'});
    });
    */
    /*
    $('body').click(function(e){
	  e.preventDefault();
      return false;
    });
    //116 = F5
    $('body').keypress(function(e){
      if (e.keyCode == 116) {
	    //console.log("F5");
	  } else {
	    e.preventDefault();
	    return false;
	  }
    });
    */	
    $('body').bind("mousewheel",function() {
      return false;
    });
    $('body').on("contextmenu",function(){
      return false;
    });  
      $('body').attr('unselectable','on')
        .css({'-moz-user-select':'-moz-none',
          '-moz-user-select':'none',
          '-o-user-select':'none',
          '-khtml-user-select':'none',
          '-webkit-user-select':'none',
          '-ms-user-select':'none',
          'user-select':'none'
        }).bind('selectstart', function(){ 
          return false; 
      });  
      //time
      startTime();
      function startTime() {
        $('#ctime').html(moment().tz("Europe/Sofia").format('HH:mm:ss'));
      }
      setInterval(startTime,1000);
      //date
      startDate();
      function startDate() {
        var monthn = ["Януари","Февруари","Март","Април","Май","Юни","Юли","Август","Септември","Октомври","Ноември","Декември"];
        var dayc;
        var datec = "#A7F700";
        var datetime = new Date();
        var Y = datetime.getFullYear();
        var M = datetime.getMonth()+1;
        var D = datetime.getDate();
        var date = D+' '+monthn[M-1]+' '+Y;
        $('#cdate').css({ 'color':datec });
        $("#cdate").text(date);
        var d = datetime.getDay();
        if (d == d) {
	      dayc = "#A7F700";
        } else {
	      dayc = "#FF0000";
        }
        var weekno = d-1;
        var week_el = 'p#week span:eq('+weekno+')';
        $('p#week span').css({ 'color':'#666666', 'text-decoration':'none' });
        $('p#week span:eq('+weekno+')').css({ 'color':dayc, 'text-decoration':'underline' });
	  	//console.log("date loaded");
	  }
      setInterval(startDate,90000);
      
      var wicon = {
        "01d": "wi-day-sunny",
        "02d": "wi-day-cloudy",
        "03d": "wi-cloud",
        "04d": "wi-cloudy",
        "09d": "wi-showers",
        "10d": "wi-rain",
        "11d": "wi-thunderstorm",
        "13d": "wi-snow",
        "50d": "wi-day-fog",
        
        "01n": "wi-night-clear",
        "02n": "wi-night-alt-cloudy",
        "03n": "wi-cloud",
        "04n": "wi-cloudy",
        "09n": "wi-showers",
        "10n": "wi-rain",
        "11n": "wi-thunderstorm",
        "13n": "wi-snow",
        "50n": "wi-night-fog"
      };
        
      slider();        
      //buttons
      $('#start').click(function(x) {
        x.preventDefault();
        slider();
      });
      $('#play').click(function(x) {
        x.preventDefault();
        $('body').data('backstretch').resume();
      });
      $('#next').click(function(x) {
        x.preventDefault();
        $('body').data('backstretch').next();
      });
      $('#prev').click(function(x) {
        x.preventDefault();
        $('body').data('backstretch').prev();
      });
      $('#pause').click(function(x) {
        x.preventDefault();
        $('body').data('backstretch').pause();
      });
      $('#stop').click(function(x) {
        x.preventDefault();
        $("body").data('backstretch').destroy(0);
      });
      $('#refresh').click(function(x) {
        x.preventDefault();
        window.location.reload(true);
      });
      var funcs = [
        function one() { $('button#reboot').attr('class', 'orange'); },
        function two() { $('button#reboot').attr('class', 'red'); },
        function three() { 
          $.ajax({
            url: 'scripts/reboot.php',
            dataType: 'json',
            type: 'get',
            contentType: 'application/json',
            success: function(data,textStatus,jQxhr){
              console.log(data);
            },
            error: function(jqXhr,textStatus,errorThrown){
              console.log(errorThrown);
            }
          });
        }
      ];
      $('#reboot').data('counter', 0).click(function(x) {
  	    x.preventDefault();
        var counter = $(this).data('counter');
        funcs[ counter ]();
        $(this).data('counter', counter < funcs.length-1 ? ++counter : 0);
      });
      //weather
      $.ajax({
        url: 'curl/weather.php',
        dataType: 'json',
        type: 'get',
        contentType: 'application/json',
        success: function(data,textStatus,jQxhr){
          //console.log(data);
          //alert(data[0].wdesc);
          var sunrise = moment(data[0].wsunrise,"HH:mm:ss").format("HH:mm");
          var sunset = moment(data[0].wsunset,"HH:mm:ss").format("HH:mm");
          //$('.td-weather-city').text('Гоце Делчев');//data.name
          $('p#condi').text(data[0].wdesc);
          //$('p#temp').text(data.main.temp);
          $('p#icond i.wi').addClass(wicon[data[0].wicon]);
          //console.log(data[0].wicon);
          //console.log(data.weather[0].icon);
          $('span#min').text(data[1].wuwmin);
          $('span#max').text(data[1].wuwmax);
          $('span#hum').text(data[0].whum+'%');
          $('span#wind').text(data[0].wwind+'км/ч');
          $('span#nuv').text(data[0].wclouds+'%');
          $('span#mb').text(data[0].wpress+'мб');
          $('span#sunrise').text(sunrise);
          $('span#sunset').text(sunset);
        },
        error: function(jqXhr,textStatus,errorThrown){
          console.log(errorThrown);
        },
        timeout: 5000
      });
      //temp out
      $.ajax({
        url: 'curl/temp_out.php',
        dataType: 'json',
        type: 'get',
        contentType: 'application/json',
        success: function(data,textStatus,jQxhr){
          //console.log(data);
          var temp = data.TEMP;
          $('span#temp').text(temp.toFixed(2));
        },
        error: function(jqXhr,textStatus,errorThrown){
          console.log(errorThrown);
        },
        timeout: 5000
      });
      //temp in
      $.ajax({
        url: 'ajax/temp.php',
        dataType: 'json',
        type: 'get',
        contentType: 'application/json',
        success: function(data,textStatus,jQxhr){
          //console.log(data[0]);
          if (data[0].name == 'temp1') { var temp1 = parseFloat(data[0].temp)+parseFloat(0.5); $('span#temp1').text(temp1.toFixed(2)); } else { $('span#temp1').text(data[0].name); }
          if (data[1].name == 'temp2') { var temp2 = parseFloat(data[1].temp)+parseFloat(1); $('span#temp2').text(temp2.toFixed(2)); } else { $('span#temp2').text(data[1].name); }
        },
        error: function(jqXhr,textStatus,errorThrown){
          console.log(errorThrown);
        },
        timeout: 5000
      });
            //cpu
            $.ajax({
                url: "scripts/cpu.php",
                dataType: "json",
                type: "GET",
                contentType: "application/json",
                success: function(cpu,textStatus,jQxhr){
                    //console.log(cpu);
                    var cpuTemp = parseFloat(cpu)-parseFloat(1.0);
                    $("#cpu").text(cpuTemp.toFixed(1));
                    if (cpuTemp > 76) {
		                $('#cpu').css({ "color": "#FF0000" });
		            } else if (cpuTemp > 62 && cpuTemp < 77) {
		                $('#cpu').css({ "color": "#ff9900" });
		            } else {
		                $('#cpu').css({ "color": "#A7F700" });
		            }
                },
                error: function(jqXhr,textStatus,errorThrown){
                    console.log(errorThrown);
                },
                timeout: 3000
            });
      //repeats
      setInterval(function(){
        $.ajax({
          url: 'curl/temp_out.php',
          dataType: 'json',
          type: 'get',
          contentType: 'application/json',
          success: function(data,textStatus,jQxhr){
            //console.log(data);
            var temp = data.TEMP;
            $('span#temp').text(temp.toFixed(2));
          },
          error: function(jqXhr,textStatus,errorThrown){
            console.log(errorThrown);
          },
          timeout: 5000
        });
            //cpu
            $.ajax({
                url: "scripts/cpu.php",
                dataType: "json",
                type: "GET",
                contentType: "application/json",
                success: function(cpu,textStatus,jQxhr){
                    //console.log(cpu);
                    var cpuTemp = parseFloat(cpu)-parseFloat(1.0);
                    $("#cpu").text(cpuTemp.toFixed(1));
                    if (cpuTemp > 76) {
		                $('#cpu').css({ "color": "#FF0000" });
		            } else if (cpuTemp > 62 && cpuTemp < 77) {
		                $('#cpu').css({ "color": "#ff9900" });
		            } else {
		                $('#cpu').css({ "color": "#A7F700" });
		            }
                },
                error: function(jqXhr,textStatus,errorThrown){
                    console.log(errorThrown);
                },
                timeout: 3000
            });
      },15000);
      setInterval(function(){
        $.ajax({
          url: 'ajax/temp.php',
          dataType: 'json',
          type: 'get',
          contentType: 'application/json',
          success: function(data,textStatus,jQxhr){
            //console.log(data[0]);
          if (data[0].name == 'temp1') { var temp1 = parseFloat(data[0].temp)+parseFloat(0.5); $('span#temp1').text(temp1.toFixed(2)); } else { $('span#temp1').text(data[0].name); }
          if (data[1].name == 'temp2') { var temp2 = parseFloat(data[1].temp)+parseFloat(1); $('span#temp2').text(temp2.toFixed(2)); } else { $('span#temp2').text(data[1].name); }
          },
          error: function(jqXhr,textStatus,errorThrown){
            console.log(errorThrown);
          },
          timeout: 5000
        });
      },10000);
      setInterval(function(){
        $.ajax({
          url: 'curl/weather.php',
          dataType: 'json',
          type: 'get',
          contentType: 'application/json',
          success: function(data,textStatus,jQxhr){
            //console.log(data);
            //alert(data[0].wdesc);
            var sunrise = moment(data[0].wsunrise,"HH:mm:ss").format("HH:mm");
            var sunset = moment(data[0].wsunset,"HH:mm:ss").format("HH:mm");
            //$('.td-weather-city').text('Гоце Делчев');//data.name
            $('p#condi').text(data[0].wdesc);
            //$('p#temp').text(data.main.temp);
            $("p#icond i").removeClass();
            $("p#icond i").addClass("wi "+wicon[data[0].wicon]);
            //console.log(data.weather[0].icon);
            $('span#min').text(data[1].wuwmin);
            $('span#max').text(data[1].wuwmax);
            $('span#hum').text(data[0].whum+'%');
            $('span#wind').text(data[0].wwind+'км/ч');
            $('span#nuv').text(data[0].wclouds+'%');
            $('span#mb').text(data[0].wpress+'мб');
            $('span#sunrise').text(sunrise);
            $('span#sunset').text(sunset);
          },
          error: function(jqXhr,textStatus,errorThrown){
            console.log(errorThrown);
          },
          timeout: 5000
        });
      },60000);

    });//function end

    function slider() {
      var images = ['<?=implode("', '", $paths)?>'];
      $.backstretch(
        images,
        {
          fade: 750,
          duration: 11250
       });
    }
  </script>

</body>
</html>
