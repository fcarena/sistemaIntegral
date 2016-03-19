(function(namespace, $) {
    "use strict";

    var newBitacoraPage = function() {
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

        // Initialize app when document is ready
        $(document).ready(function() {
            o.initialize();
        });

    };
    var p = newBitacoraPage.prototype;


    p.initialize = function() {
    }

    namespace.newBitacoraPage = new newBitacoraPage;


}(this.laFuentePrestamos, jQuery));
