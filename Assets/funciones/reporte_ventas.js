var tabla;
var chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(231,233,237)'
};
var color = Chart.helpers.color;
function init()
{
	sales_seller();
	year_summary();
	cantidad_items();
	estadistica_vendedores();
	mostrarResultados(2020); 

} 
/*=============================================================================
=============================================================================*/
function cantidad_items(){
	$.post(base_url+"/Ajax/reporteVentasAjax.php?op=count", function(r){
		$("#count").html(r);
	});
}
/*=============================================================================
=============================================================================*/
function mostrarResultados(year){
	$('.result').html('<canvas id="sales"></canvas>');
	$.ajax({
		type: 'POST',
		url: base_url+'/Ajax/reporteVentasAjax.php?op=statistics',
		data: {year : year},
		dataType: 'JSON',
		success:function(response){    
			var ctx = document.getElementById("sales");
			ctx.height = 80;
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SETIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'],
					datasets: [ 
						{
							label: "VENTAS",
							backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
							borderColor: chartColors.blue,
							borderWidth: "1",
							fill: false,
							data: response
						}
					]
				},
				options: {
					responsive: true,
					tooltips: {
						mode: 'index',
						intersect: false
					},
					hover: {
						mode: 'nearest',
						intersect: true
					},
					barPercentage: 0.5
				}
			});
		}
	});
	return false;
}

/*=============================================================================
=============================================================================*/
function estadistica_vendedores(){
	$.ajax({
	  type: 'POST',
	  url: base_url+'/Ajax/reporteVentasAjax.php?op=seller',
	  success:function(response){  
		var quantity = [];
		var workers = [];
		var datos = JSON.parse(response);  
		if (response.length > 0) {
			for (i = 0; i < datos.length; i++) {
				quantity.push(datos[i][0]);
				workers.push(datos[i][1]);

			}
			var ctx = document.getElementById("employee");
			ctx.height = 187;
			var myChart = new Chart(ctx, {
				type: 'bar',
				data: {
				  labels:workers,
				  datasets: [
					{
					  label: "GANANCIAS",
					  backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
					  borderColor: chartColors.blue,
					  borderWidth: "1",
					  fill: false,
					  data: quantity
					}
				  ]
				},
				options: {
				  responsive: true,
				  tooltips: {
					mode: 'index',
					intersect: false
				  },
				  hover: {
					mode: 'nearest',
					intersect: true
				  },
				  barPercentage: 0.5
				}
			});
		}
	  }
	});
}
/*=============================================================================
=============================================================================*/
function sales_seller(){
	$.post(base_url+'/Ajax/reporteVentasAjax.php?op=saleSeller',(response)=>{
		const sellers = JSON.parse(response);
		let template='';
		if(response ==='[]'){
			template+=`
			<tr>	
				<td class="text-center" colspan="6">No hay registro en el sistema</td>
			</tr>
			`;
		}else{
			sellers.forEach(seller => {
				template+=`
					<tr>	
						<td><img style="width:30px;height:30px;background:transparent" src="${seller.perfil}" class="img-thumbnail"></td>
						<td>${seller.vendedor}</td>
						<td>${seller.dni}</td>
						<td>${seller.cargo}</td>
						<td><span class="badge badge-info">${seller.ventas}</span></td>
						<td>${seller.ganancias}</td>
					</tr>
				`;
			});
		}
		$("#sales_seller").html(template);
	});
}
/*=============================================================================
=============================================================================*/
function year_summary(){
	$.post(base_url+"/Ajax/reporteVentasAjax.php?op=ra", function(r){
		$("#year_summary").html(r);
	});
}
/*=============================================================================
=============================================================================*/
init(); 