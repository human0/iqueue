$(function() {
	//console.log("counters added: ");
	console.log("hover nothing");
	$('#home .home-nav').addClass("active");
	$('#profile .profile-nav').addClass("active");
	$('#about .about-nav').addClass("active");
	$('#signup .signup-nav').addClass("active");
	//console.log("find me find me find me");
	
	//-----------------Ready----------------//
	$(document).ready(function(){
		$('img').addClass('img-responsive');	
		
		if ( $('.notification-modal-ready').length > 0){
     		$('#notice-modal').modal({show:true, keyboard:true,});
   		};
	});
	
	
	//-----------toggle comment form---------------
	$('.reply').click(function(){
		$(this).siblings('.comment').toggle();
		$(this).toggle();
	});
	
	//--------------------show modal-------------
	if ( $('.task-modal-ready').length > 0){
		   $('#task-modal').modal({show:true, keyboard:true,});
		   console.log("find me find me find me");
		};
	$('.task-modal-triger').on('click', function(){
		   $('#task-modal').modal({show:true, keyboard:true,});
		   console.log("find me find me find me");
		});

	if ( $('.gadget-modal-ready').length > 0){
		   $('#gadget-modal').modal({show:true, keyboard:true,});
		   console.log("find me find me find me");
		};
	$('.gadget-modal-triger').on('click', function(){
		   $('gadget-tmodal').modal({show:true, keyboard:true,});
		   console.log("find me find me find me");
		});

	if ($('.login-modal-ready').length > 0){
		$('#login-modal').modal({show:true, keyboard:true,});
		console.log("find me find me find me");
	};
	$('.login-modal-triger').on('click', function(){
		$('#login-modal').modal({show:true, keyboard:true,});
		console.log("find me find me find me");
	});

	if ( $('.message-modal-ready').length > 0){
		   $('#message-modal').modal({show:true, keyboard:true,});
		   console.log("find me find me find me");
		};
	$('.message-modal-triger').on('click', function(){
		   $('#message-modal').modal({show:true, keyboard:true,});
		   console.log("find me find me find me");
		});
	

	
/*------------tooltip-----------------------------
	$("[data-toggle='tooltip']").tooltip({animation:!0});
*/
/*------------------------pop overs------------------
$(function () {
  $('[data-toggle="popover"]').popover()
})
$('body').on('click', function (e) {
    $('[data-toggle="popover"]').each(function () {
        //the 'is' for buttons that trigger popups
        //the 'has' for icons within a button that triggers a popup
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
});

$.fn.popover.Constructor.DEFAULTS.trigger = 'click';   // Set the default trigger to hover
$.fn.popover.Constructor.DEFAULTS.placement = 'auto'; // Set the default placement to right
$.fn.popover.Constructor.DEFAULTS.html = true; 
$.fn.popover.Constructor.DEFAULTS.delay = '2000';  
$.fn.popover.Constructor.DEFAULTS.template = '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>';
console.log($.fn.popover.Constructor.DEFAULTS);
*/
/*---------------fullscreen-----------------
$('.fs-button').on('click', function(){  
        var elem = document.getElementById('fullscreen');  
        if(document.webkitFullscreenElement) {  
            document.webkitCancelFullScreen();  
        }  
        else {  
            elem.webkitRequestFullScreen();  
        };  
    });  
*/	
	
//---------on hover for popups and drop down----//

//------scroll up and curosel scroll... and nav scrolls------//	
/*
 $(window).scroll(function() {
// 100 = The point you would like to fade the nav in.
	var scroll = $(window).scrollTop();
	var opacity = 1.0 - scroll/1000;
	//$('#myCarousel').css("opacity", opacity);
	$('#myCarousel').css({ top: scroll/1.5, "opacity": opacity});
// try using background image and then scroll ul down by absolute and e.g. top = scroll-scroll/1000 
});


$('.scroll').on('click', function(s){	
	var $class = "null";
	$class=($(this).hasClass("clients"))?".clients":($(this).hasClass("users"))?".users":".developers";
	if($class!="null"){
		$('.members .tab-pane').removeClass("active");	
		$('.members .tab-pane'+$class).addClass("active");
		$('.members ul.nav-tabs li').removeClass("active");
		$('.members ul.nav-tabs li'+$class).addClass("active");
		}
	s.preventDefault()
    $('html, body').animate({
      scrollTop : $(this.hash).offset().top -60
    }, 1500);
	
}); 
*/	
	/*--------------------FORMDETAILS------------------*/
	$('#new-usertype').change(function(){
		$('#new-agent').hide(0,0,null);
		$('#new-client').hide(0,0,null);
		
		$('#new-agent .required').prop('required', false);
		$('#new-client .required').prop('required', false);
		$('#new-admin .required').prop('required', false);
		
		if($('#new-usertype option:selected').val() == "client")
		{
			$('#new-client').show(0,0,null);
			$('#new-client .required').prop('required', true);
		}
		if($('#new-usertype option:selected').val() == "agent")
		{
			$('#new-agent').show(0,0,null);
			$('#new-agent .required').prop('required', true);
		}
		if($('#new-usertype option:selected').val() == "admin")
		{
			$('#new-admin').show(0,0,null);
			$('#new-admin .required').prop('required', true);
		}	
	});
	/*------------------------CREATE TASK-------------------*/
	$('#create-taskandupdateclient .weight').change(function(){
		var $weight = $(this);
		var $points = $('#create-taskandupdateclient .points');
		var $funds = $('#create-taskandupdateclient .funds');
		$points.val($weight.val());
		if ($weight.val() > $funds.val())
		{
			$weight.val($funds.val());	
		}
		if ($weight.val() < 0)
		{
			$weight.val(0);	
		}
	});

	/*-----------------------SELECT FORM-------------------------*/
	$('.selectform select').change( function(){
		var $sel = $(this);
		var $parent = $sel.parent('.selectform');
		if( !$sel.val() ) 
			$parent.children('button').attr('disabled','disabled');
		else $parent.children('button').removeAttr('disabled');
		
		
		if( $parent.find('option:selected').text().indexOf("active") >= 0 )
			$parent.find('.activate').attr('disabled','disabled');
		if( $parent.find('option:selected').text().indexOf("pending") >= 0 )
			$parent.find('.deactivate').attr('disabled','disabled');
		$parent.find('.details').prop("checked", true)
		//$('.selectform button').removeAttr('disabled');
	});
});