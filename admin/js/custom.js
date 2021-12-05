$( document ).ready(function() {
    showData();
});
function AddProduct(){
    var name=document.getElementById("product_name").value;
    var code=document.getElementById("product_code").value;
    var name_error="Category Type Name is Required";
    var code_error="Category Type Code is Required";
    if(name=='')
    {
        document.getElementById("name_err").innerHTML=name_error;
        document.getElementById("code_err").innerHTML=code_error;
    }
    else{    
        $.ajax({
            method:'POST',
            url:'index.php',
            data:{
                product_name:name,
                product_code:code
            },        
            success:function(data){ 
                showData();               
                if(data == 1)
                {                    
                    alert("This name or code already esists");                    
                }
                else{
                    window.location.href='index.php'; 
                    showData();                 
                }  
                     
            }
        });           
    }
}
  
function changeCode(){
    document.getElementById("name_err").style.display='none';
    document.getElementById("code_err").style.display='none';
    var year=new Date().getFullYear().toString().substr(-2);
    var product_name=document.getElementById("product_name").value;
    var name=product_name.toString().substr(0,2);
    document.getElementById("product_code").value=name + '-'+ year;
}

function showData(){
    $.ajax({
        method:'POST',
        url:'show.php',              
        success:function(data){ 
            $('#show_data').html(data);
            document.getElementById("data_show").style.display="bolck";    
        }
    }); 
}
 