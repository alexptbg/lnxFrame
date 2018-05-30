var mysql      = require('mysql');
var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '',
  database : 'system'
});

connection.connect();

var MCP9808_1 = new require('./x18.js');
var MCP9808_2 = new require('./x19.js');

MCP9808_1.Initialize(function() {});
MCP9808_2.Initialize(function() {});

setInterval(function() {
   //timestamp
   const dateTime = new Date().getTime();
   const timestamp = Math.floor(dateTime / 1000);
   //datetime
   var date = new Date();
   var Y = date.getFullYear();
   var M = date.getMonth()+1;
   if (M < 10) {
     M = "0"+M;
   }
   var D = date.getDate();
   if (D < 10) {
     D = "0"+D;
   }
   var h = date.getHours();
   if (h < 10) {
     h = "0"+h;
   }
   var m = date.getMinutes();
   if (m < 10) {
     m = "0"+m;
   }
   var s = date.getSeconds();
   if (s < 10) {
     s = "0"+s;
   }
   var datetime = Y+"-"+M+"-"+D+" "+h+":"+m+":"+s;

   MCP9808_1.AmbientTemperature(function(error,data) {
     if (data != undefined) {
       var insert_data = { datetime: datetime, timestamp: timestamp, name: "temp1", temp: data.toFixed(2) };
       //console.log(insert_data);
       connection.query('INSERT INTO `temperatures` SET ?', insert_data, function(err,res){
         if(err) throw err;
         console.log('Last insert ID:', res.insertId);
       });
     }
   });

   MCP9808_2.AmbientTemperature(function(error,data) {
     if (data != undefined) {
       var insert_data = { datetime: datetime, timestamp: timestamp, name: "temp2", temp: data.toFixed(2) };
       //console.log(insert_data);
       connection.query('INSERT INTO `temperatures` SET ?', insert_data, function(err,res){
         if(err) throw err;
         console.log('Last insert ID:', res.insertId);
       });
     }
   });

}, 10000);

//connection.end();