function init() {
  buscar_producto();
  cart();
  $("#cat-carrito").show();
}
/*=============================================================================
=============================================================================*/
function buscar_producto(consulta) {
  $.post(base_url + "/Ajax/productoAjax.php?op=cata", { consulta }, (response) => {
    const productos = JSON.parse(response);
    let template = "";
    if(response !== "[]"){
      productos.forEach((producto) => {
        template += `  
              <div id="productCard" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch" style="width:100%">
                <div class="card bg-light">
                  <div class="card-header text-muted border-bottom-0">
                      <i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock}
                  </div>
                  <div class="card-body pt-0">
                  <div class="row">
                      <div class="col-7">
                          <h2 class="lead"><b>${producto.producto}</b></h2>
                          <h2 class="lead"><b>${producto.precio}</b></h2>
                          <ul class="ml-4 mb-0 fa-ul text-muted">
                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentración: ${
                                producto.concentracion
                              }</li>
                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle"></i></span> Adicional: ${
                                producto.adicional
                              }</li>
                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio: ${
                                producto.laboratorio
                              }</li>
                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> Tipo: ${
                                producto.tipo
                              }</li>
                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span> Presentación: ${
                                producto.presentacion
                              }</li>
                          </ul>
                      </div>
                      <div class="col-5 text-center">
                          <img src="${producto.imagen}" alt="${producto.producto}" class="img-circle img-fluid">
                      </div>
                  </div>
                  </div>
                  <div class="card-footer">
                      <div class="text-right">
                          <button id="${producto.id}" class="agregar_carrito btn btn-success btn-sm" name='${JSON.stringify(
                            producto
                          )}' onclick="addToCart(this)">
                              <i class="fas fa-cart-plus mr-2"></i>Agregar
                          </button>
                      </div>
                  </div>
              </div>
              </div>
              `;
      });
    }else{
      template += `
            <div class="col-12 col-sm-12 col-md-12">
                <img style="width:60%;height:60%;margin-left:20%;" class="product-image" src="../Assets/images/pordefecto/no_hay_producto.png" alt="No hay productos">
            </div>
      `;
    }
    $("#producto").html(template);
    comprobar();
  });
}
/*=============================================================================
=============================================================================*/
$(document).on("keyup", "#buscar_producto", function () {
  let valor = $(this).val();
  if (valor != "") {
    buscar_producto(valor);
  } else {
    buscar_producto();
  }
});
/*=============================================================================
=============================================================================*/
function monto_carrito() {

  var nColumnas = $("#mi-tabla tbody tr").length;
  $("#cantidadc").text(nColumnas) ;
};
/*=============================================================================
=============================================================================*/
function cart(){
    $.ajax({
        url: base_url + "/Ajax/cartAjax.php?op=list",
        type: "get",
        success: function (resp) {
          $('#content').html('');
            let productos = JSON.parse(resp)
            Object.values(productos).forEach((obj) => {
              const item = JSON.parse(obj)
              if(obj !== null){
                  $('#content').append(`
                  <tr id='fila' name='${item.id}'>
                      <th><img src="${item.imagen}" width="40px"></th>
                      <th>${item.producto +' '+ item.concentracion +' '+ item.adicional}</th>
                      <td>${item.presentacion}</td>
                      <td>${item.precio}</td>
                      <td><button type="button" id="button" name='${JSON.stringify(item)}' class="btn btn-danger btn-sm" href="#" onclick="remove(this)"><i class="fa fa-minus fa-xs"></i></button></td>
                  </tr>`);
                  monto_carrito();
                }else{
                  return
                }
            });
        },
      });
}
/*=============================================================================
=============================================================================*/
function addToCart(element) {
  $.ajax({
    url: base_url + "/Ajax/cartAjax.php?op=add",
    data: { product: element["name"] },
    type: "post",
    dataType: "json"
  });
  Swal.fire({
    title: 'Agregado',
    text: 'El producto se agregó al carrito',
    icon: 'success',
    showConfirmButton: false,
    timer: 1500
  })
  comprobar()
  cart();
}
/*=============================================================================
=============================================================================*/
function comprobar() {
  $.ajax({
    url: base_url + "/Ajax/cartAjax.php?op=list",
    type: "get",
    success: function (resp){
      const productos = JSON.parse(resp);
      const cards = $('#producto #productCard .agregar_carrito');
      cards.prop("disabled",false);
      for (let i = 0; i < productos.length; i++) {
        let producto = productos[i]
        for (let f = 0; f < cards.length; f++) {
          if(producto === cards[f].name)
          {
            cards[f]['disabled'] = true;
          }
        }
        
      }
    }
  });
}
/*=============================================================================
=============================================================================*/
function remove(element){
  $.ajax({
    url: base_url + "/Ajax/cartAjax.php?op=remove",
    data: { element: element['name'] },
    type: "post",
    dataType: "json",
    success: function(resp){
    }
  });
  comprobar();
  monto_carrito();
  cart();
}
/*=============================================================================
=============================================================================*/
function cleanCart() {
  $.ajax({
    url: base_url + "/Ajax/cartAjax.php?op=clean",
    type: "get",
    dataType: "json"
  });
  $('#content').html('');
  comprobar();
  monto_carrito();
}
/*=============================================================================
=============================================================================*/
$("body")
    .barcodeListener()
    .on("barcode.valid", function (e, code) {
    $("#buscar_producto").val(code);
    buscar_producto(code);
});
/*=============================================================================
=============================================================================*/
init();

