/* ==========================================================
 * QuickAdmin v1.3.3
 * common.js
 * 
 * http://www.mosaicpro.biz
 * Copyright MosaicPro
 *
 * Built exclusively for sale @Envato Marketplaces
 * ========================================================== */ 

/* Utility functions */


function randNum()
{
	return (Math.floor( Math.random()* (1+40-20) ) ) + 20;
}

function PDFTarget(target)
{
	var doc = $('html').clone();
	var target = $(target).clone();
	var form = $('#PDFTargetForm');
	if (!form.length) {
		$('body').append('<form id="PDFTargetForm"></form>');
		form = $('#PDFTargetForm');
	}
	
	form.attr('action', basePath + 'ajax.php?section=pdf');
	form.attr('method', 'POST');
	form.append('<input type="hidden" name="target" value="" />');
	
	target.find('.hidden-print').remove();
	doc.find('body').html(target);
	var html = doc.html();
	
	form.find('input').val(html);
	form.submit();
}

function beautify(source)
{
	var output,
		opts = {};

    /*
    opts.indent_size = $('#tabsize').val();
    opts.indent_char = opts.indent_size == 1 ? '\t' : ' ';
    opts.max_preserve_newlines = $('#max-preserve-newlines').val();
    opts.preserve_newlines = opts.max_preserve_newlines !== -1;
    opts.keep_array_indentation = $('#keep-array-indentation').prop('checked');
    opts.break_chained_methods = $('#break-chained-methods').prop('checked');
    opts.indent_scripts = $('#indent-scripts').val();
    opts.brace_style = $('#brace-style').val();
    opts.space_before_conditional = $('#space-before-conditional').prop('checked');
    opts.unescape_strings = $('#unescape-strings').prop('checked');
    opts.wrap_line_length = $('#wrap-line-length').val();
    opts.space_after_anon_function = true;
    */
	
	opts.preserve_newlines = false;

	output = html_beautify(source, opts);
    return output;
}

function mt_rand (min, max) 
{
	var argc = arguments.length;
	if (argc === 0) {
		min = 0;
		max = 2147483647;
	}
	else if (argc === 1) {
		throw new Error('Warning: mt_rand() expects exactly 2 parameters, 1 given');
	}
	else {
		min = parseInt(min, 10);
		max = parseInt(max, 10);
	}
	return Math.floor(Math.random() * (max - min + 1)) + min;
}

function scrollTo(id)
{
	if ($(id).length)
		$('html,body').animate({scrollTop: $(id).offset().top},'slow');
}

function toggleMenuHidden()
{
	$('.container-fluid:first').toggleClass('menu-hidden');
	$('#menu').toggleClass('hidden-phone', function()
	{
		if ($('.container-fluid:first').is('.menu-hidden'))
		{
			if (typeof resetResizableMenu != 'undefined') 
				resetResizableMenu(true);
		}
		else 
		{
			removeMenuHiddenPhone();
			
			if (typeof lastResizableMenuPosition != 'undefined') 
				lastResizableMenuPosition();
		}
		
		if (typeof $.cookie != 'undefined')
			$.cookie('menuHidden', $('.container-fluid:first').is('.menu-hidden'));
	});
	
	if (typeof masonryGallery != 'undefined') 
		masonryGallery();	
}

function removeMenuHiddenPhone()
{
	if (!$('.container-fluid:first').is('.menu-hidden') && $('#menu').is('.hidden-phone'))
		$('#menu').removeClass('hidden-phone');
}

function genSparklines()
{
	if ($('.sparkline').length)
	{
		$.each($('#content .sparkline'), function(k,v)
		{
			var size = { w: 150, h: 28 };
			if ($(this).parent().is('.widget-stats'))
				size = { w: 150, h: 35 }
			
			var color = primaryColor;
			if ($(this).is('.danger')) color = dangerColor;
			if ($(this).is('.success')) color = successColor;
			if ($(this).is('.warning')) color = warningColor;
			if ($(this).is('.inverse')) color = inverseColor;
			
			var data = [[1, 3+randNum()], [2, 5+randNum()], [3, 8+randNum()], [4, 11+randNum()],[5, 14+randNum()],[6, 17+randNum()],[7, 20+randNum()], [8, 15+randNum()], [9, 18+randNum()], [10, 22+randNum()]];
		 	$(v).sparkline(data, 
			{ 
				type: 'bar',
				width: size.w,
				height: size.h,
				stackedBarColor: ["#dadada", color],
				lineWidth: 2
			});
		});
		$.each($('#menu .sparkline'), function(k,v)
		{
			var size = { w: 150, h: 20 };
			if ($(this).parent().is('.widget-stats-3'))
				size = { w: 150, h: 35 }
			
			var color = primaryColor;
			if ($(this).is('.danger')) color = dangerColor;
			if ($(this).is('.success')) color = successColor;
			if ($(this).is('.warning')) color = warningColor;
			if ($(this).is('.inverse')) color = inverseColor;
			
			var data = [[1, 3+randNum()], [2, 5+randNum()], [3, 8+randNum()], [4, 11+randNum()],[5, 14+randNum()],[6, 17+randNum()],[7, 20+randNum()], [8, 15+randNum()], [9, 18+randNum()], [10, 22+randNum()]];
		 	$(v).sparkline(data, 
			{ 
				type: 'bar',
				width: size.w,
				height: size.h,
				stackedBarColor: ["#dadada", color],
				lineWidth: 2
			});
		});
	}
}

function genEasyPie()
{
	if ($('.easy-pie').length && $.fn.easyPieChart)
	{
		$.each($('.easy-pie'), function(k,v)
		{	
			var color = primaryColor;
			if ($(this).is('.danger')) color = dangerColor;
			if ($(this).is('.success')) color = successColor;
			if ($(this).is('.warning')) color = warningColor;
			if ($(this).is('.inverse')) color = inverseColor;
			
			$(v).easyPieChart({
				barColor: color,
				animate: ($('html').is('.ie') ? false : 3000),
                lineWidth: 4,
                size: 50
			});
		});
	}
}


function JQSliderCreate()
{
	$(this)
		.removeClass('ui-corner-all ui-widget-content')
		.wrap('<span class="ui-slider-wrap"></span>')
		.find('.ui-slider-handle')
		.removeClass('ui-corner-all ui-state-default');
}

$(function(){
	$('#menu .collapse').on('show', function(e)
	{
		e.stopPropagation();
		$(this).parents('.hasSubmenu:first').addClass('active');
	})
	.on('hidden', function(e){
		e.stopPropagation();
		$(this).parents('.hasSubmenu:first').removeClass('active');
	});
	
	$('.navbar.main .btn-navbar').click(function()
	{
		$('.floatThead-container').width('100%');
		var disabled = typeof toggleMenuButtonWhileTourOpen != 'undefined' ? toggleMenuButtonWhileTourOpen(true) : false;
		if (!disabled)
			toggleMenuHidden();
	});
	
	$('.navbar.main .toggle-navbar').click(function()
	{
		var that = $(this);
		
		if ($('.navbar.main .wrapper').is(':hidden'))
		{
			$(this).slideUp(20, function(){
				$('.navbar.main .wrapper').show();
				$('.navbar.main').animate({ height: 34 }, 200, function(){
					$('.navbar.main').toggleClass('navbar-hidden');
					that.slideDown();
				});
			});
		}
		else
		{
			$(this).slideUp(20, function(){
				$('.navbar.main').animate({ height: 0 }, 200, function(){
					$('.navbar.main .wrapper').hide();
					$('.navbar.main').toggleClass('navbar-hidden');
					that.slideDown();
				});
			});
		}
	});
	
	$('.submenu').hover(function()
	{
        $(this).children('ul').removeClass('submenu-hide').addClass('submenu-show');
    }, function()
    {
    	$(this).children('ul').removeClass('.submenu-show').addClass('submenu-hide');
    })
    .find("a:first").append(" &raquo; ");
	
	$('body').tooltip({ selector: '[data-toggle="tooltip"]' });
	
	$('[data-toggle="popover"]').popover();
	
	$('[data-toggle*="pdf"]').on('click', function(e){
		e.preventDefault();
		PDFTarget($(this).attr('data-target'));
	});
	
	if ($('[data-toggle="prettyPhoto"]').length) 
		$('[data-toggle="prettyPhoto"]').prettyPhoto();
	
	$('[data-toggle*="btn-loading"]').click(function () {
        var btn = $(this);
        btn.button('loading');
        setTimeout(function () {
        	btn.button('reset')
        }, 3000);
    });
	$('[data-toggle*="button-loading"]').click(function () {
        var btn = $(this);
        btn.button('loading');
    });
	
	if ($('[data-toggle="typeahead"]').length)
		$('[data-toggle="typeahead"]').typeahead({
			source: ["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"],
			items: 4
		});
	
	$('[data-toggle="print"]').click(function(e)
	{
		e.preventDefault();
		window.print();
	});
	
	//$('.carousel').carousel();
	
	$('[data-toggle*="gridalicious"]').each(function(){
		var $that = $(this);
		$(this).gridalicious({
			gutter: $that.attr('data-gridalicious-gutter') || 13, 
			width: $that.attr('data-gridalicious-width') ? parseInt($that.attr('data-gridalicious-width')) : 200,
			animate: true,
			selector: '.widget'
		}).removeClass('hide');
	});
	
	$('.widget[data-toggle="collapse-widget"] .widget-body')
		.on('show', function(){
			$(this).parents('.widget:first').attr('data-collapse-closed', "false");
		})
		.on('shown', function(){
			setTimeout(function(){ $(window).resize(); }, 500);
		})
		.on('hidden', function(){
			$(this).parents('.widget:first').attr('data-collapse-closed', "true");
		});
	
	$('.widget[data-toggle="collapse-widget"]').each(function()
	{
		$(this).find('.widget-head').append('<span class="collapse-toggle"></span>');
		
		$(this).find('.widget-body').addClass('collapse');
		
		if ($(this).attr('data-collapse-closed') !== "true")
			$(this).find('.widget-body').addClass('in');
		
		$(this).find('.collapse-toggle').on('click', function(){
			$(this).parents('.widget:first').find('.widget-body').collapse('toggle');
		});
	});
	
	//genSparklines();
	
	//genEasyPie();
	
	/*if ($('.prettyprint').length)
		prettyPrint();*/
	
	
	$(window).resize();
	
	$('.btn-source-toggle').click(function(e){
		e.preventDefault();
		$('.code:not(.show)').toggleClass('hide');
	});
	
	$('[data-toggle="source-code"]').each(function(){
		var button = $('<span data-toggle="source-code-toggle" class="hidden-phone btn btn-toggle-code btn-mini btn-primary btn-icon glyphicons embed_close"><i></i> Source</span>');
		if ($(this).attr('data-placement') == 'outside') button.addClass('outside');
		$(this).append(button);
		$(this).css('overflow', 'visible');
	}).on('click', '[data-toggle="source-code-toggle"]', function(){
		var html = $(this).parent().clone();
			html.find('[data-toggle="source-code-toggle"]').remove();
			html = beautify(html.html());
			html = $('<pre class="prettyprint"></pre>').text(html);
		
		bootbox.alert(html);
		
		if ($('.prettyprint').length)
			prettyPrint();
	});
	
	
	$('[data-toggle="hide"]').click(function()
	{
		if ($(this).is('.bootboxTarget'))
			bootbox.alert($($(this).attr('data-target')).html());
		else {
			$($(this).attr('data-target')).toggleClass('hide');
			if ($(this).is('.scrollTarget') && !$($(this).attr('data-target')).is('.hide'))
				scrollTo($(this).attr('data-target'));
		}
	});
	
	$('#toggle-menu-position').on('change', function()
	{
		$('.container-fluid:first').toggleClass('menu-right');
		
		if ($(this).prop('checked')) 
			$('.container-fluid:first').removeClass('menu-left');
		else
			$('.container-fluid:first').addClass('menu-left');
		
		if (typeof $.cookie != 'undefined')
			$.cookie('rightMenu', $(this).prop('checked') ? $(this).prop('checked') : null);
		
		if (typeof resetResizableMenu != 'undefined' && typeof lastResizableMenuPosition != 'undefined')
		{
			resetResizableMenu(true);
			lastResizableMenuPosition();
		}
		removeMenuHiddenPhone();
	});
	
	if (typeof $.cookie != 'undefined' && $.cookie('rightMenu') && $('#toggle-menu-position').length)
	{
		$('#toggle-menu-position').prop('checked', true);
		$('.container-fluid:first').not('.menu-right').removeClass('menu-left').addClass('menu-right');
	}
	
	$('#toggle-layout').on('change', function()
	{
		if ($(this).prop('checked'))
		{
			$('.container-fluid:first').addClass('fixed');
		}
		else
			$('.container-fluid:first').removeClass('fixed');
		
		if (typeof $.cookie != 'undefined')
		{
			$.cookie('layoutFixed', $(this).prop('checked') ? $(this).prop('checked') : null);
			$.cookie('layoutFluid', $(this).prop('checked') ? null : $(this).prop('checked'));
		}
	});
	
	if (typeof $.cookie != 'undefined' && $.cookie('layoutFixed') && $('#toggle-layout').length)
	{
		$('#toggle-layout').prop('checked', true);
		$('.container-fluid:first').addClass('fixed');
	}
	else if (!$('.container-fluid:first').is('.fixed') || (typeof $.cookie != 'undefined' && $.cookie('layoutFluid')))
	{
		$('#toggle-layout').prop('checked', false);
		$('.container-fluid:first').removeClass('fixed');
	}
	
	if (typeof $.cookie != 'undefined' && $.cookie('menuHidden') && $.cookie('menuHidden') == 'true' || (!$('.container-fluid').is('.menu-hidden') && !$('#menu').is(':visible')))
		toggleMenuHidden();
	else if ($('#menu').is(':visible'))
	{
		removeMenuHiddenPhone();
		
		if (typeof lastResizableMenuPosition != 'undefined') 
			lastResizableMenuPosition();
	}
	
	// menu slim scroll max height
	/*setTimeout(function()
	{
		var menu_max_height = parseInt($('#menu .slim-scroll').attr('data-scroll-height'));
		var menu_real_max_height = parseInt($('#wrapper').height());
		$('#menu .slim-scroll').slimScroll({
			height: (menu_max_height < menu_real_max_height ? (menu_real_max_height - 40) : menu_max_height) + "px",
			allowPageScroll : true,
			railDraggable: ($.fn.draggable ? true : false)
	    });
		
		if (Modernizr.touch)
			return; 
		
		// fixes weird bug when page loads and mouse over the sidebar (can't scroll)
		$('#menu .slim-scroll').trigger('mouseenter').trigger('mouseleave');
	}, 200);*/
	
	/* Slim Scroll Widgets */
	/*$('.widget-scroll').each(function(){
		$(this).find('.widget-body > div').slimScroll({
			height: $(this).attr('data-scroll-height')
	    });
	});*/
	
	/* Other non-widget Slim Scroll areas */
	/*$('#content .slim-scroll').each(function(){
		var scrollSize = $(this).attr('data-scroll-size') ? $(this).attr('data-scroll-size') : "7px";
		$(this).slimScroll({
			height: $(this).attr('data-scroll-height'),
			allowPageScroll : false,
			railVisible: false,
			size: '0',
			railDraggable: ($.fn.draggable ? true : false)
	    });
	});*/

	/*if ($('textarea.wysihtml5').size() > 0)
		$('textarea.wysihtml5').wysihtml5();*/
	
	if ($('.selectpicker').length) $('.selectpicker').selectpicker();
	
	if ($('.toggle-button').length) $('.toggle-button').toggleButtons();
	
	if ($('.uniformjs').length) $('.uniformjs').find("select, input, button, textarea").uniform();
	
	if ($('#colorpicker').length) $('#colorpicker').farbtastic('#colorpickerColor');
	
	if ($('#datepicker').length) $("#datepicker").datepicker({ showOtherMonths:true });
	if ($('#datepicker-inline').length) $('#datepicker-inline').datepicker({ inline: true, showOtherMonths:true });
	
	if ($('#dateRangeFrom').length && $('#dateRangeTo').length)
	{
		$( "#dateRangeFrom" ).datepicker({
			defaultDate: "+1w",
			changeMonth: false,
			numberOfMonths: 2,
			onClose: function( selectedDate ) {
				$( "#dateRangeTo" ).datepicker( "option", "minDate", selectedDate );
			}
		}).datepicker( "option", "maxDate", $('#dateRangeTo').val() );

		$( "#dateRangeTo" ).datepicker({
			defaultDate: "+1w",
			changeMonth: false,
			numberOfMonths: 2,
			onClose: function( selectedDate ) {
				$( "#dateRangeFrom" ).datepicker( "option", "maxDate", selectedDate );
			}
		}).datepicker( "option", "minDate", $('#dateRangeFrom').val() );
	}
	
	$('.checkboxs thead :checkbox').change(function(){
		if ($(this).is(':checked'))
		{
			$('.checkboxs tbody :checkbox').prop('checked', true).parent().addClass('checked');
			$('.checkboxs tbody tr.selectable').addClass('selected');
			$('.checkboxs_actions').show();
		}
		else
		{
			$('.checkboxs tbody :checkbox').prop('checked', false).parent().removeClass('checked');
			$('.checkboxs tbody tr.selectable').removeClass('selected');
			$('.checkboxs_actions').hide();
		}
	});
	
	$('.checkboxs tbody').on('click', 'tr.selectable', function(e){
		var c = $(this).find(':checkbox');
		var s = $(e.srcElement);
		
		if (e.srcElement.nodeName == 'INPUT')
		{
			if (c.is(':checked'))
				$(this).addClass('selected');
			else
				$(this).removeClass('selected');
		}
		else if (e.srcElement.nodeName != 'TD' && e.srcElement.nodeName != 'TR' && e.srcElement.nodeName != 'DIV')
		{
			return true;
		}
		else
		{
			if (c.is(':checked'))
			{
				c.prop('checked', false).parent().removeClass('checked');
				$(this).removeClass('selected');
			}
			else
			{
				c.prop('checked', true).parent().addClass('checked');
				$(this).addClass('selected');
			}
		}
		if ($('.checkboxs tr.selectable :checked').size() == $('.checkboxs tr.selectable :checkbox').size())
			$('.checkboxs thead :checkbox').prop('checked', true).parent().addClass('checked');
		else
			$('.checkboxs thead :checkbox').prop('checked', false).parent().removeClass('checked');

		if ($('.checkboxs tr.selectable :checked').size() >= 1)
			$('.checkboxs_actions').show();
		else
			$('.checkboxs_actions').hide();
	});
	
	if ($('.checkboxs tbody :checked').size() == $('.checkboxs tbody :checkbox').size() && $('.checkboxs tbody :checked').length)
		$('.checkboxs thead :checkbox').prop('checked', true).parent().addClass('checked');
	
	if ($('.checkboxs tbody :checked').length)
		$('.checkboxs_actions').show();
	
	$('.radioboxs tbody tr.selectable').click(function(e){
		var c = $(this).find(':radio');
		if (e.srcElement.nodeName == 'INPUT')
		{
			if (c.is(':checked'))
				$(this).addClass('selected');
			else
				$(this).removeClass('selected');
		}
		else if (e.srcElement.nodeName != 'TD' && e.srcElement.nodeName != 'TR')
		{
			return true;
		}
		else
		{
			if (c.is(':checked'))
			{
				c.attr('checked', false);
				$(this).removeClass('selected');				
			}
			else
			{
				c.attr('checked', true);
				$('.radioboxs tbody tr.selectable').removeClass('selected');
				$(this).addClass('selected');
			}
		}
	});
	
	/*if ($( ".js-table-sortable" ).length){	
		$( ".js-table-sortable" ).sortable(
		{
			placeholder: "ui-state-highlight",
			items: "tbody tr",
			handle: ".js-sortable-handle",
			forcePlaceholderSize: true,
			helper: function(e, ui) 
			{
				ui.children().each(function() {
					$(this).width($(this).width());
				});
				return ui;
			},
			start: function(event, ui) 
			{
				if (typeof mainYScroller != 'undefined') mainYScroller.disable();
				ui.placeholder.html('<td colspan="' + $(this).find('tbody tr:first td').size() + '">&nbsp;</td>');
			},
		    stop: function() { if (typeof mainYScroller != 'undefined') mainYScroller.enable(); }
		});
	}*/
        
});


//smsdn scripts ---------------------------- start from here--------------------------------------------------
$(document).ready(function() {
    $('.main-left').css({ height: $(window).innerHeight()-50 });    // .main-right - section commented
    $(window).resize(function(){
      $('.main-left').css({ height: $(window).innerHeight()-50 });
    });
    
});




+function ($) { "use strict";

  var Button = function (element, options) {
    this.$element = $(element)
    this.options  = $.extend({}, Button.DEFAULTS, options)
  }

  Button.DEFAULTS = {
    loadingText: 'loading...'
  }

  Button.prototype.setState = function (state) {
    var d    = 'disabled'
    var $el  = this.$element
    var val  = $el.is('input') ? 'val' : 'html'
    var data = $el.data()

    state = state + 'Text'

    if (!data.resetText) $el.data('resetText', $el[val]())

    $el[val](data[state] || this.options[state])

    setTimeout(function () {
      state == 'loadingText' ?
        $el.addClass(d).attr(d, d) :
        $el.removeClass(d).removeAttr(d);
    }, 0)
  }

  Button.prototype.toggle = function () {
    var $parent = this.$element.closest('[data-toggle="buttons"]')

    if ($parent.length) {
      var $input = this.$element.find('input')
        .prop('checked', !this.$element.hasClass('active'))
        .trigger('change')
      if ($input.prop('type') === 'radio') $parent.find('.active').removeClass('active')
    }

    this.$element.toggleClass('active')
  }


  // BUTTON PLUGIN DEFINITION
  // ========================

  var old = $.fn.button

  $.fn.button = function (option) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.button')
      var options = typeof option == 'object' && option

      if (!data) $this.data('bs.button', (data = new Button(this, options)))

      if (option == 'toggle') data.toggle()
      else if (option) data.setState(option)
    })
  }

  $.fn.button.Constructor = Button


  // BUTTON NO CONFLICT
  // ==================

  $.fn.button.noConflict = function () {
    $.fn.button = old
    return this
  }


  // BUTTON DATA-API
  // ===============

  $(document).on('click.bs.button.data-api', '[data-toggle^=button]', function (e) {
    var $btn = $(e.target)
    if (!$btn.hasClass('btn')) $btn = $btn.closest('.btn')
    $btn.button('toggle')
    e.preventDefault()
  })

}(window.jQuery);

// on click function for button set
  $(document).on('click', ".btn-group.leave-type .btn", function(e) {
    $(this).parents('.btn-group.leave-type').find('.btn').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
});