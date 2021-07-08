var tabla;
var chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(37, 144, 62)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(231,233,237)'
};
var color = Chart.helpers.color;
function init()
{
	year_summary();
    cantidad_items();
    mostrar_lotes();
    mostrarResultados(2020); 

} 
/*=============================================================================
=============================================================================*/
function cantidad_items(){
	$.post(base_url+"/Ajax/reporteComprasAjax.php?op=count", function(r){
		$("#count").html(r);
	});
}
/*=============================================================================
=============================================================================*/
function mostrar_lotes(){
	$.post(base_url+'/Ajax/loteAjax.php?op=lote',(response)=>{
		const lotes = JSON.parse(response);
		console.log(lotes)
		let template='';
		if(response ==='[]'){
			template+=`
			<tr>	
				<td class="text-center" colspan="6">No hay registro en el sistema</td>
			</tr>
			`;
		}else{ 
			lotes.forEach(lote => {
					if(lote.estado=='warning'){
						template+=`
						<tr class="table-${lote.estado}">	
							<td>${lote.id}</td>
							<td>${lote.producto}</td>
							<td>${lote.stock}</td>
							<td>${lote.presentacion}</td>
							<td>${lote.mes}</td>
							<td>${lote.dia}</td>
						</tr>
						`;
					}else if(lote.estado=='danger'){
						template+=`
						<tr class="table-${lote.estado}">	
							<td>${lote.id}</td>
							<td>${lote.producto}</td>
							<td>${lote.stock}</td>
							<td>${lote.presentacion}</td>
							<td>${lote.mes}</td>
							<td>${lote.dia}</td>
						</tr>
						`;
					}
			});
		}
			$("#lote").html(template);
	});
}
/*=============================================================================
=============================================================================*/
function mostrarResultados(year){
	$('.result').html('<canvas id="purchases"></canvas>');
	$.ajax({
		type: 'POST',
		url: base_url+'/Ajax/reporteComprasAjax.php?op=statistics',
		data: {year : year},
		dataType: 'JSON',
		success:function(response){    
			var ctx = document.getElementById("purchases");
			ctx.height = 80;
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SETIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'],
					datasets: [
						{
							label: "COMPRAS",
							backgroundColor: color(chartColors.green).alpha(0.5).rgbString(),
							borderColor: chartColors.green,
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
function year_summary(){
	$.post(base_url+"/Ajax/reporteComprasAjax.php?op=ra", function(r){
		$("#year_summary").html(r);
	});
}
/*=============================================================================
=============================================================================*/
init(); 