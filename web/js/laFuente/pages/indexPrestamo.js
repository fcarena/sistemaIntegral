(function(namespace, $) {
    "use strict";

    var newIndexPage = function() {
        // Create reference to this instance
        var o = this;
        var filtros;
        var monkeyList = new List('paginacion', {
          valueNames: ['id','dni','nombre','realizado', 'realizadoPor','recibido','productos', 'descripcion'],
          page: 5,
          plugins: [ ListPagination({}) ]
        });

        $(".input-busqueda").keyup(function(){
            filtros = [];
            $("input[name='busqueda']:checked").each(function() {
                filtros.push($(this).val());
            });
            monkeyList.search($(this).val(), filtros)
        });

        $('.devolucionParcial').click(function(){
          var productosPrestamos = [];
          $(this).parent().prev().children().find('input:checked').each(function(){
            productosPrestamos.push($(this).attr('productoPrestamo'));
          });

          $.ajax({
            method: "POST",
            url: "devolucionParcial",
            data: { prestamo: $(this).parent().parent().attr('prestamo-id'), productosPrestamos: productosPrestamos  }
          })
            .done(function( id ) {
              $.each(productosPrestamos, function (key,value) {
                  $('input[productoPrestamo="'+value+'"]').next().remove();
                  $('input[productoPrestamo="'+value+'"]').remove();
                  $('input[name="product[undefined]"]').remove();
              });
            });
          $(this).parent().prev().children().children().each(function(){
             $(this).prepend( "<input type='checkbox' id='inputMate' name='product["+$(this).attr('value-id')+"]'>" );
          });
        });

        if ($('#cantMates').text() == 0 ) {
          $('#inputMate').attr({'disabled':true, 'checked': false});
        }

        if ($('#cantBombillas').text() == 0 ) {
          $('#inputBombilla').attr({'disabled':true, 'checked': false});
        }

        if ($('#cantPaletas').text() == 0 ) {
          $('#inputPaleta').attr({'disabled':true, 'checked': false});
        }

        if ($('#cantPelotas').text() == 0 ) {
          $('#inputPelota').attr({'disabled':true, 'checked': false});
        }
        var cantPaletas=$('#cantPaletas').text();
        $('#inputPaleta').change(function() {
          var valor = cantPaletas - $(this).val();
          console.log(valor);
          if (valor >= 0){
            $('#cantPaletas').text(cantPaletas - $(this).val());
          }else{
            alert('no hay suficientes paletas!');
            $('#inputPaleta').val(cantPaletas);
          }
        });

        // Initialize app when document is ready
        $(document).ready(function() {
            o.initialize();
        });

    };
    var p = newIndexPage.prototype;


    p.initialize = function() {
    }

    namespace.newIndexPage = new newIndexPage;


}(this.laFuentePrestamos, jQuery));
