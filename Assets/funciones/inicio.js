var tabla;
function init()
{
	cantidad_items();
	estadistica_venta();
	most_selled_products();
	mostrar_lotes();
	productos_recientes();

} 
/*=============================================================================
=============================================================================*/
function cantidad_items(){
    $.post(base_url+"/Ajax/inicioAjax.php?op=count", function(r){
		$("#count").html(r);
	});
}
/*=============================================================================
=============================================================================*/
function estadistica_venta(){
	$.post(base_url+"/Ajax/inicioAjax.php?op=statistics", function(r){
		$("#statistics").html(r);
	});
}
/*=============================================================================
=============================================================================*/
function most_selled_products(){
	$.post(base_url+"/Ajax/inicioAjax.php?op=products", function(r){
		$("#products").html(r);
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
				<td class="text-center" colspan="8">No hay registro en el sistema</td>
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
							<td>${lote.laboratorio}</td>
							<td>${lote.presentacion}</td>
							<td>${lote.proveedor}</td>
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
							<td>${lote.laboratorio}</td>
							<td>${lote.presentacion}</td>
							<td>${lote.proveedor}</td>
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
function productos_recientes(){
	$.post(base_url+'/Ajax/inicioAjax.php?op=recently',(response)=>{
		const productos = JSON.parse(response);
		//console.log(response);
		let template='';
		if(response ==='[]'){
			template+=`
			<li class="item">
				<div class="product-info">
					<span class="product-description">
						No hay productos
					</span>
				</div>
			</li>
			`;
		}else{ 
			productos.forEach(producto => {
				template+=`
					<li class="item">
						<div class="product-img">
							<img src="${producto.imagen}" alt="${producto.producto}" class="img-size-50">
						</div>
						<div class="product-info">
							<a href="javascript:void(0)" class="product-title">${producto.producto}
								<span class="badge badge-info float-right">${producto.precio}</span>
							</a>
							<span class="product-description">
								${producto.descripcion}
							</span>
						</div>
					</li>
				`;
			});
		}
			$("#recently").html(template);
	});
}
/*=============================================================================
=============================================================================*/
init(); 