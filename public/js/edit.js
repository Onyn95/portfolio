 $(document).ready(function() {
    
        $('.black-hover').click(function(){
            var id ="";
            var id = $(this).parent().find('img').attr('value');
           
             
             console.log(id);
           $.ajax({
             
               url: "/admin/test",
               type: 'get',
               dataType:'json',
               data:{
                   id : id
                  
                    }
              
               }).done(function(data){
                   
                   console.log(data);
               }
               
               
           )
           .fail(function(datas){
                   
                   console.log(datas);
               })
               ;
            
          //  alert("jai clique");
        });
       
      
   

 });
