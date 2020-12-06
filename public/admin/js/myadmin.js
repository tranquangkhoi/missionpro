/* del one */
$(document).ready(function(){
	$(".btn_del").click(function(){ 
	$("#del_userid").val($(this).data('id'));
		 $('#myModal').modal('show');
	});
});

/* del group */
$(document).ready(function(){
	$check_one = false;
	$(".group_del").click(function(){ 		
		$("input[type='checkbox']:checked").each( 
			function(){ 
			    if(this.checked == true){
					$check_one = true;
				}
			} 
		);
		if($check_one==true){
			$check_one = false;
			$('#myModal').modal('show');					
		}else{
			alert('Để xóa bạn hãy chọn một mục.');					
		}		
	});
});
 /*submit a form */
function frm_submit(fsm){
	$("#"+fsm).submit();		
}

/* check_all and uncheck_all -- CHECKBOX */
$(document).ready(function(){	
	$('.check_all').click(function(){     
		if($('.check_all').prop('checked')){
			$(':checkbox').prop('checked', true);
		}else{
			$(':checkbox').prop('checked', false);
		}		
	});
	
	$('.check_one').click(function(){     
		if($('.check_one').find(':checkbox').prop('checked', false)){
			$('.check_all').prop('checked',false);
		}		
	});
	
	$('.noEnterSubmit').keypress(function(e){
    	if ( e.which == 13 ) return false;   
	});
	
});
 /*submit a form - change action */
function frm_submit_action(fsm,action){
	$("#"+fsm).attr("action",action);
	$("#"+fsm).submit();		
}

//delete file image
$(document).ready(function(){
	$(".delete").click(function(e){
		var answer = confirm("Bạn chắc có muốn xóa không?");
		if(!answer){
			return false;
		}
		 
		e.preventDefault(); 
		var href = $(this).attr("href");
			
		$.ajax({
			type: "GET",
			url: href,
			success: function(response){
				if (response == "OK"){
					$("#deleteimg").html("");
					$("#image_old").val("");
				}else{
					alert('Error delete file');
					return false;
				}
			}
		});
		
	})
});

//delete file image of album
$(document).ready(function(){
	$(".delete_album").click(function(e){
		var answer = confirm("Bạn chắc có muốn xóa không?");
		if(!answer){
			return false;
		}
		 
		e.preventDefault(); 
		var href = $(this).attr("href");
		var div_id = $(this).parent().attr('id');
				
		$.ajax({
			type: "GET",
			url: href,
			success: function(response){
				if (response == "OK"){
					$('#'+div_id).remove();
					return false;										
				}else{
					alert('Error delete file');
					return false;
				}
			}
		});
		
	})
});

//for input file

/*
$(":file").filestyle({ 
    'buttonText': 'Open file',
	'classButton': 'btn btn-info',
	'icon': true,
	'classInput' : 'filestyle',
	'classIcon': 'glyphicon glyphicon-arrow-up'	
})
*/


// add input file
$(document).ready(function(){ 
    var counter = 1; 
    $("#addButton").click(function () { 
		var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter); 
		newTextBoxDiv.after().html('<div class="row container"><div class="form-inline">Thứ tự: <input type="text" class="form-control" style="width:50px; margin-right:10px;" name="image_order[]" id="image_order" value="'+counter+'"><input type="file" id="file'+counter+'" class="form-control" name="album_image[]"> <span style="cursor:pointer;" title="Xóa đi" class="glyphicon glyphicon-remove"></span></div>'); 
		newTextBoxDiv.appendTo("#group_album"); 		
		/*
		$("#file"+counter).filestyle({ 
			buttonText: 'Open file',
			classButton: 'btn-success',
			icon: true,
			classIcon: 'icon-arrow-up icon-white',
			classText: 'input-xlarge' 
		})
		*/
		counter++;				
     });
 
    
	 
	$("body").on("click",".glyphicon-remove", function(e){ //user click on remove text
        
                $(this).parent('div').remove(); //remove text box
                counter--; //decrement textbox
       
		return false;
		}) 

  });
  
 //format_number
 $(document).ready(function(){
	$('.price').focus( function() {
    	$(this).val( number_format( $(this).val(), 0, '.', ',' ) );
	})
	$('.price').keyup( function() {
    	$(this).val( number_format( $(this).val(), 0, '.', ',' ) );
	})	
 });
 
 //for ajax change select box get attri product
 $(document).ready(function(){
	$(".change_select").change(function(){			 			
		var href = $(".change_select").attr("mytag")+ $(".change_select option:selected").val();				
		$.ajax({
			type: "GET",
			url: href,
			success: function(response){				
				$('#atrr').html(response);
				return false;														
			}
		});
		
	})
});

$(document).ready(function() {
    $('.fancybox').fancybox();
});

 