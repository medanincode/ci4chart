<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Aplikasi Chart Sederhana</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
	<div class="container mt-3">
		<div class="row">
			<div class="col-md-3">
				<label for="">Pilih Bulan</label>
				<select id="bulan" class="form-control">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4" selected="">4</option>
				</select>
			</div>
		</div>
	</div>
	<div id="container"></div>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
	<script>
	// Chart
	const options = {
	  chart: {
	    type: 'spline',
	    events: {
	    	load: getData(4)
	    }
	  },
	  title: {
	    text: 'Corona Virus Indonesia'
	  },
		 xAxis: {
		        type: 'datetime',
		        dateTimeLabelFormats: {
		            day: '%e of %b'
		        }
		},
	  series: [
	  	{
	  		name:'Kasus',
	  		data:[],
	  		pointStart: Date.UTC(2020, 3, 1),
	        pointInterval: 24 * 3600 * 1000 // one day
	  	}
	  ]
	};
	const chart = Highcharts.chart('container', options)

	// Data
	$("#bulan").change(function(){
		const val = $(this).val();
		getData(val);
	})
	function getData(bulan) {
	  	const url = `/home/apiData/${bulan}`;
	    $.getJSON(url,function(data) {
	    	const p =[];
			data.map((obj) => {
			    p.push(parseInt(obj.jumlah))
		    });
			chart.series[0].update({
				data:p,
				pointStart: Date.UTC(2020, bulan-1, 1)
			})
			chart.redraw(); 
		})
	}
	</script>	
</body>
</html>


