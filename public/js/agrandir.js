 $(document).ready(function() {
        $('.card-img-top').click(function() {
            console.log($(this).css('width'));
            $(this).css('width', 'calc('+$(this).css('width') + ' + 100px)');
            
        });
        
    }); 