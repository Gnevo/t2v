
        $(document).ready(function () {
            $("#datepicker").datepicker();
            $('#datepicker').datepicker('setDate', '2014-12-25');
            $("#settings_date_form").submit(function (event) {
                if ($('#last_date').val() == '') {
                    event.preventDefault();
                }
            });
        });
		
		
		  $(document).ready(function () {
            $("#datepicker-2").datepicker();
            $('#datepicker-2').datepicker('setDate', '2014-12-25');
            $("#settings_date_form").submit(function (event) {
                if ($('#last_date').val() == '') {
                    event.preventDefault();
                }
            });
        });
		
		 $(document).ready(function () {
            $("#datepicker-3").datepicker();
            $('#datepicker-3').datepicker('setDate', '2014-12-25');
            $("#settings_date_form").submit(function (event) {
                if ($('#last_date').val() == '') {
                    event.preventDefault();
                }
            });
        });
		
		$(document).ready(function () {
            $("#datepicker-4").datepicker();
            $('#datepicker-4').datepicker('setDate', '2014-12-25');
            $("#settings_date_form").submit(function (event) {
                if ($('#last_date').val() == '') {
                    event.preventDefault();
                }
            });
        });




$(document).ready(function(){
	 $(".sidebar-right").hide();
	  $('.main-center').css('width','100%');
	$(".footer-sidebar-contents").hide();
	

		$(".footer-btn").click(function (){
  $(".footer-sidebar-contents").toggle("fast");
  	});
	

	$("#right-sidebar-button").click(function (){
  $(".sidebar-right").toggle("fast");
  	});
	
	


/*
jQuery(document).ready(function($) {
    var clickState = 0;
    var cssForState = [{
            'width': '70%'
        },{
            'width': '80%'
        }];
   
    var advanceToNextClickState = function() {
        clickState++;
        if (clickState >= cssForState.length)
            clickState = 0;
    }
    
    $('.left-collapse-menu').click(function (e) {
        console.log("Received click while clickState = " + clickState);
        advanceToNextClickState();
        $('.main-center').animate(cssForState[clickState]);
    });    
});
	
jQuery(document).ready(function($) {
    var clickState = 0;
    var cssForState = [{
            'width': '70%'
        },{
            'width': '89%'
        }];
   
    var advanceToNextClickState = function() {
        clickState++;
        if (clickState >= cssForState.length)
            clickState = 0;
    }
    
    $('#right-sidebar-button').click(function (e) {
        console.log("Received click while clickState = " + clickState);
        advanceToNextClickState();
        $('.main-center').animate(cssForState[clickState]);
    });    
});
*/
});	



$('.footable').footable();



<!--add item-->

$( "#add-new-item-inputs" ).hide();
	$( "#add-new-item" ).click(function() {
$( "#add-new-item-inputs" ).toggle();
});
$("#add-new-item").click(function() {
    $('html, body').animate({
        scrollTop: parseInt($("#add-new-item-inputs").offset().top)
    }, 2000);
});


   
	
	

$( "#table-info" ).hide();
	$( "#table-one" ).click(function() {
$( "#table-info" ).toggle();
});

$( ".close" ).click(function() {
$( "#table-info,#add-new-item-inputs" ).fadeOut();
});

/*$("#table-one").click(function() {
    $('html, body').animate({
        scrollTop: parseInt($("#table-info").offset().top)
    }, 2000);
});*/





/*ADD NEW SLOT*/
$( "#add-new-slot-section" ).hide();
	$("#add-new-slot" ).click(function() {
$( "#add-new-slot-section" ).toggle();
});

$( ".close" ).click(function() {
$( "#add-new-slot-section" ).fadeOut();
});

/*$("#add-new-slot").click(function() {
    $('html, body').animate({
        scrollTop: parseInt($("#add-new-slot-section").offset().top)
    }, 2000);
});*/

$("#slot-time-set" ).click(function() {
alert("test");
});





<!--main section width set-->

$(document).ready(function(){
	$(".main-left").css('width', '50%');
	/*$(".main-right").css('width', '5%');*/
$(".main-right").css('display', 'block');
	
$(".slot").click(function() {
 	$(".main-left").css('width', '50%');
	$(".main-right").css('width', '47%');
	$(".main-right").css('display', 'block');
	
 $('html, body').animate({
        scrollTop: parseInt($(".main-right").offset().top)
    }, 2000);

});
	
	/*$(".main-right-collapse-out").click(function() {
 	$(".main-left").css('width', '92%');
	$(".main-right").css('width', '5%');
	});*/
	
	
	$(".main-right-collapse-close").click(function() {
 	$(".main-left").css('width', '99%');
	$(".main-right").css('display', 'none');
	
	 $('html, body').animate({
        scrollTop: parseInt($(".main-left").offset().top)
    }, 2000);
	});
	

	});
		




<!--slot hover-->

$( ".slot" ).mouseover(function() {
$(".slot-hover-popup").css('display','block');
});

$( ".slot" ).mouseout(function() {
$(".slot-hover-popup").css('display','none');
});
















<!--slot right click-->

(function ($, window) {

    $.fn.contextMenu = function (settings) {

        return this.each(function () {

            // Open context menu
            $(this).on("contextmenu", function (e) {
				
				$(".dropdown-menu").css('margin-top','-80px');
                //open menu
                $(settings.menuSelector)
                    .data("invokedOn", $(e.target))
                    .show()
                    .css({
                        position: "absolute",
                        left: getLeftLocation(e),
                        top: getTopLocation(e)
                    })
                    .off('click')
                    .on('click', function (e) {
                        $(this).hide();
                
                        var $invokedOn = $(this).data("invokedOn");
                        var $selectedMenu = $(e.target);
                        
                        settings.menuSelected.call(this, $invokedOn, $selectedMenu);
                });
                
                return false;
            });

            //make sure menu closes on any click
            $(document).click(function () {
                $(settings.menuSelector).hide();
            });
        });

        function getLeftLocation(e) {
            var mouseWidth = e.pageX;
            var pageWidth = $(window).width();
            var menuWidth = $(settings.menuSelector).width();
            
            // opening menu would pass the side of the page
            if (mouseWidth + menuWidth > pageWidth &&
                menuWidth < mouseWidth) {
                return mouseWidth - menuWidth;
            } 
            return mouseWidth;
        }        
        
        function getTopLocation(e) {
            var mouseHeight = e.pageY;
            var pageHeight = $(window).height();
            var menuHeight = $(settings.menuSelector).height();

            // opening menu would pass the bottom of the page
            if (mouseHeight + menuHeight > pageHeight &&
                menuHeight < mouseHeight) {
                return mouseHeight - menuHeight;
            } 
            return mouseHeight;
        }

    };
})(jQuery, window);

$("#myTable").contextMenu({
    menuSelector: "#contextMenu",
    menuSelected: function (invokedOn, selectedMenu) {
        var msg = "You selected the menu item '" + selectedMenu.text() +
            "' on the value '" + invokedOn.text() + "'";
     
    }
});





