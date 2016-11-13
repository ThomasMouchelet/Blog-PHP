$(document).ready(function() {

$('#messages').hide();

    function showMessages(id,msg){
        $( "#"+id ).fadeIn( "slow", function() {
            $('#'+id).prepend(msg+'<br>');
            setTimeout(function(){
                $( "#"+id ).fadeOut( "slow", function() {
                });
            }, 2000);
        });
    }

    $(".delete").click(function () {

        $.ajax({ 
                url: 'delete_billet.php',
                data: "billet="+this.id,
                type: 'post',
                success : function(response, statut){
                    showMessages('messages','Message supprimé');
                }
         });
        $('tr#'+this.id).fadeOut('slow', function() {
           $('tr#'+this.id).remove();
        });  
    });

});