 $(document).ready(function(){
  
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.boton_subir').fadeIn();
            } else {
                $('.boton_subir').fadeOut();
            }
        });
  
        $('.boton_subir').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
  
    });