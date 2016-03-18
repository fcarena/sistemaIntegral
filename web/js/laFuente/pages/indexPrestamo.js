(function(namespace, $) {
    "use strict";

    var newIndexPage = function() {
        // Create reference to this instance
        var o = this;

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
