 $(document).ready(function() {
    
        $('.black-hover').click(function(){
            var id ="";
            var id = $(this).parent().find('img').attr('value');
           
             
           //  console.log(id);
           $.ajax({
             
               url: "/admin/delet",
               type: 'get',
               //dataType:'json',
               data:{
                   id : id
                  
                    }
              
               }).done(function(data){
                   
                  // console.log(data);
                   location.reload();
               }
               
               
           )
           .fail(function(datas){
                   
                   console.log(datas);
               })
               ;
            
          //  alert("jai clique");
        });
       
      
   

 });
