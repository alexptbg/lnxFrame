//include the module (uses the relative path)
var MCP9808 = new require('./x19.js');
	
//initialize the sensor
MCP9808.Initialize(function()
{
	//call the inner function every second
	setInterval(function()
	{
		//get the ambient temperature
		MCP9808.AmbientTemperature(function(error,data)
	    {
	    	//print the ambient temperature to the console
	    	if (data != undefined) {
	    		console.log(data.toFixed(2));
	    	} else {
	         console.log("error");
	      }
	    });
	}, 1000);
});