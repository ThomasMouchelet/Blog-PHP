$(document).ready(function() {

    function progressBar(pourcents){
        $('.determinate').css('width',pourcents+'%');
    }

    $(".delete").on('click', function(e){
        e.preventDefault();
        var $a = $(this);
        var url = 'delete_billet.php?';
        var data = 'billet='+this.id;
        //$a.text('chargement');
        progressBar(0);
        $('.progress').fadeIn();

        $a.children('i').replaceWith('<div class="preloader-wrapper small active">'
                +'<div class="spinner-layer spinner-blue-only">'
                    +'<div class="circle-clipper left">'
                    +'<div class="circle"></div>'
                    +'</div><div class="gap-patch">'
                    +'<div class="circle"></div>'
                    +'</div><div class="circle-clipper right">'
                    +'<div class="circle"></div>'
                  +'</div>'
                +'</div>'
            +'</div>');

        progressBar(30);

        $.ajax({
                url: url,
                data: data
            })
            .done(function(data,text,jqXHR){
                $a.parents('tr').fadeOut();//On remonte les parents j'usqu'au tr
                progressBar(50);
            })
            .fail(function(jqXHR){
                console.log('error');
            })
            .always(function(){
                progressBar(100);
                $('.progress').fadeOut(1000);
            });

    });

});