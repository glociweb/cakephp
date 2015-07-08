$(document).ready(function()
{
	
	if($('#flowchartcode').val()=='')
	{
		var button = document.getElementById("sharebutton");
		button.disabled = true;
	}
	$(document).on('change','#RegistrationForm_user_type',function()
	{
		
		$('.departmentlist').show();
		
	});
	
	$(document).on('click','#sharechart',function()
	{
		
	$('.response').remove();
	$(this).text('sharing...');
	var button = document.getElementById("sharechart");
	button.disabled = true;
	var url = base_url + '/createflowchart/Shareflowchart';
    var emails = $('#shared_emails').val();
    var chartcode = $('#flowchartcode').val();
    $.ajax({
        url: url,
        type: 'POST',
        datatype: 'json',
        data: {
            'chartcode': chartcode,
            'emails': emails
        },
        success: function(data) {
			$('#shared_emails').val('');
			$("#sharechart").text('Start Sharing');
			var button = document.getElementById("sharechart");
			button.disabled = false;
            var data = jQuery.parseJSON(data);
            if (data.status == "success") {
               
               $('#chartimageadmin').append('<p style="max-width:100%;color:green" class"response">shared successfuly to entered emails</p>');
            } else if(data.status=='error') 
            {
                $('#chartimageadmin').append('<p style="max-width:100%;color:red" class"response">email sending failed to following emails '+data.emails+'</p>');
            }
            //$(update).html(data);
        },

        error: function(data) {
            alert("There may an error on uploading. Try again later");
        },

    });

	});
	
	$(document).on('click','#shareorgchart',function()
	{
	$('.response').remove();
	$(this).text('sharing...');
	var button = document.getElementById("shareorgchart");
	button.disabled = true;
	var url = base_url + '/createflowchart/shareorgchart';
    var emails = $('#shared_emails').val();
    var chartcode = $('#flowchartcode').val();
    $.ajax({
        url: url,
        type: 'POST',
        datatype: 'json',
        data: {
            'chartcode': chartcode,
            'emails': emails
        },
        success: function(data) {
			$('#shared_emails').val('');
			$("#shareorgchart").text('Start Sharing');
			var button = document.getElementById("shareorgchart");
			button.disabled = false;
            var data = jQuery.parseJSON(data);
            if (data.status == "success") {
               
               $('#chartimageadmin').append('<p style="max-width:100%;color:green" class"response">shared successfuly to entered emails</p>');
            } else if(data.status=='error') 
            {
                $('#chartimageadmin').append('<p style="max-width:100%;color:red" class"response">email sending failed to following emails '+data.emails+'</p>');
            }
            //$(update).html(data);
        },

        error: function(data) {
            alert("There may an error on uploading. Try again later");
        },

    });

	});
});

$(document).on('click','#closecharts',function()
	{
		$(this).parents('#floating-left').css('margin-left','-300px');
		$('.container-fluid > .content').css('display','flex');
		$('.sidebar.left').css('width','0px');
		$('.container-fluid > .content').css('margin','6px');
		$("canvas").load();
		$('#expandcharts').show();
	});
	$(document).on('click','#expandcharts',function()
	{
		$('#expandcharts').hide();
		$( "canvas").load();
		$('#floating-left').css('margin-left','0px');
		$('.container-fluid > .content').removeAttr( 'style' );
		
	});
$(document).ready(function(){
	tinymce.init({
    selector: ".richtext",
    theme: "modern",
    height : 500,
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ],
    setup: function(editor) {
             editor.on( 'change', function( args ) { 
				 var button = document.getElementById("SaveButton");
			if (button) button.disabled = false; } );
	}
  
});
function unloadPage(){ 
    var button = document.getElementById("SaveButton");
	if(button.disabled == false)
	{
        return "You have unsaved changes on this page. Do you want to leave this page and discard your changes or stay on this page?";
    }
}
window.onbeforeunload = unloadPage;
	});
