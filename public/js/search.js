 $(document).ready(function() {
     
    
 
	$('#search').autocomplete({
            
            source : function(request, response) {
                 
                $.getJSON('/admin/search', {
                    term: request.term,
                  
                },response);
                
             
            },
           
            
          select : function(event, ui) {
			$(this).val(ui.item.label); 
                     
			return false;
                   
		}, 
         
                        
            
        });

       
       });