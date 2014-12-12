	
	/**
	 * This function includes all the load methods
	 * which is defined in ready function. This is 
	 * used to trigger methods in ready as well as in ajax function
	 */
	function setOnloadMethods(){

		/**
		 * Bootstrap ajax modal
		 */
		$('[data-toggle="modal"]').click(function(e){
			ajaxCall(e, this, 'link');
		});
		
		/**
		 * Modal close event
		 */
		$('#myModal').on('hidden.bs.modal', function () {
			
		});
		
		//Delete confirm
		$('.del').each(function(e){
			$(this).on("click", function(e){
		        if(!confirm('Do you want to delete?'))
		        {
		        	e.preventDefault();
		        }
			});
			
		});
                
		//show flash message
		if($('#msg_box').length > 0)
	    {
	    	showMsg(msgType);
	    }
	    
	    //set date picker in date field
	    var cal_options = {
			changeYear : true,
			changeMonth: true,
			yearRange: "1970:2030",
			dateFormat: "dd-mm-yy",
			maxDate: new Date,
			onClose: function(selectedDate, obj){
				switch(obj.id){
					case 'from_date':
						$( "#to_date" ).datepicker( "option", "minDate", selectedDate );
						break;
					case 'to_date':
						$( "#from_date" ).datepicker( "option", "maxDate", selectedDate );
						break;
				}
			}
		}

		$(".date").datepicker(cal_options);
		$(".date_btn").datepicker(cal_options);
		
		$('.date_btn').on('click', function(){
			switch(this.id){
				case 'from_cal':
					$( "#from_date" ).datepicker("show");
					break;
				case 'to_cal':
					$( "#to_date" ).datepicker("show");
					break;
			}
		});
		
		//tooltip
		$("[data-toggle='tooltip']").tooltip();
		
		//blockUI on ajax call
		//$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
		$.blockUI.defaults.css.border = "none";
		$.blockUI.defaults.css.padding = "3px";
		$.blockUI.defaults.css.height = "26px";
		$.blockUI.defaults.css.width = "40%";
		$.blockUI.defaults.css.left = "30%";
	}
	
	$(document).ready(function(){
		
		setOnloadMethods();
		
	});
	
	function clearForm(el) {
		var form = $(el).closest('form');
	    $(form).find(':input').each(function() {
	        switch(this.type) {
	            case 'password':
	            case 'select-multiple':
	            case 'select-one':
	            case 'text':
	            case 'textarea':
	                $(this).val('');
	                break;
	            case 'checkbox':
	            //case 'radio':
	                this.checked = false;
	        }
	    });
	}	
	
	function ajaxCall(e, el, type){
		e.preventDefault();
		
		//set based on link or submit button
		var url = (type == "link") ? $(el).attr('href') : el.url;
		var type = (type == "submit") ? "post" : "get";
		
		//send ajax request
		$.ajax({
	  		type: type,
		  	url: url,
		  	data: $("#myModal form").serialize(),
		  	success: function(data){
		  		setAjaxData(data); //set response data in modal
		  		//if no validation error close the modal
		  		if( type == "post" && $("#myModal .f_error").length == 0 )
		  		{
		  			closeModal();
		  			return;
		  		}
		  		
		  		//set even listener ajax modal window submit button
			    $("#myModal input[type='submit']").on('click', function(e){
		  			this.url = url;
		  			ajaxCall(e, this, 'submit');
		  		});
		  	}
		});
	}
	
	//Set ajax data in modal
	function setAjaxData(data)
	{
		var title 	= $(data).find(".page-header h3").text();
		var view 	= $(data).find("#content");
		
		view.find(".page-header").remove(); //remove page header; we already setting modal title
		
		$("#myModal .modal-title").text(title);
		$("#myModal .modal-body").html(view);
		
		$("#myModal").modal('show'); //show modal
	}
	
	//Show flash message based on type
	function showMsg(type)
	{
		var msgClass = "";
		switch(type)
		{
			case 'error':
				msgClass = 'alert-danger';
				break;
			case 'success':
				msgClass = 'alert-success';
				break;
			case 'info':
				msgClass = 'alert-info';
				break;
			case 'warning':
			default :
				msgClass = 'alert-warning';
				break;
		}
		
		var msgBox = $('#msg_box');
		var pos = ($('body').width() / 2) - ( msgBox.width() / 2);
	
		msgBox.addClass(msgClass).css('left',pos).show().fadeOut(5000);
	}
	
	//Close modal window
	function closeModal()
	{
		if( $("#myModal").length > 0)
		{
			$("#myModal").modal('hide');
		}
	}
	
			
			