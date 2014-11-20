/*
Bones Scripts File
Author: Eddie Machado

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/

// as the page loads, call these scripts
jQuery(document).ready(function($) {

    
    $( "#showhidecal" ).click(function() {
      $( "#eventcalview" ).show();
    });


    //if($.browser.msie){ 
  /* $('input[placeholder]').each(function(){  
        
            var input = $(this);        
            
            $(input).val(input.attr('placeholder'));
                    
            $(input).focus(function(){
                 if (input.val() == input.attr('placeholder')) {
                     input.val('');
                 }
            });
            
            $(input).blur(function(){
                if (input.val() == '' || input.val() == input.attr('placeholder')) {
                    input.val(input.attr('placeholder'));
                }
            });
        }); */
    //};

    $('a').removeClass('category-external-events-school-events');

    width = $('body').innerWidth();
    if (width < 768) {  
        // Create the dropdown base
        $("<select />").appendTo("nav");
        
        // Create default option "Go to..."
        $("<option />", {
           "selected": "selected",
           "value"   : "",
           "text"    : "Navigate to..."
        }).appendTo("nav select");
        
        // Populate dropdown with menu items
        $(".top-nav > li > a").each(function() {
         var el = $(this);
         $("<option />", {
             "value"   : el.attr("href"),
             "text"    : el.text()
         }).appendTo("nav select");
        });

        // Populate dropdown with menu items
        $(".ancillary-nav > li > a").each(function() {
         var el = $(this);
         $("<option />", {
             "value"   : el.attr("href"),
             "text"    : el.text()
         }).appendTo("nav select");
        });


        
        $("nav select").change(function() {
          window.location = $(this).find("option:selected").val();
        });
   }

   function adjustStyle(width) {
             width = $('body').innerWidth();
             if (width >= 601) {
     
                $(".home-modules .module:first-of-type").each(function() {
                        var $left = $(this);
                        var $right = $left.next();
                        $left.height('auto');
                        $right.height('auto');
                        var maxHeight = Math.max($left.height(), $right.height());
                        $left.height(maxHeight);
                        $right.height(maxHeight);
                });
       }
    }
    
     $(function() {
            $(window).load(function() {
                adjustStyle($(this).width());
            });
            
            $(window).resize(function() {
                adjustStyle($(this).width());
            });
        });
      
    
    // add all your scripts here
    // ADD CLASS TO LINKS CONTAINING IMAGES
    $('a:has(img)').addClass('imglink');


    // Works only with plugin modification
                    $('#projectTable').bind('sortStart',function(e) { 
                        if( $(e.target).hasClass('header') ) {
                            $("#overlay").show();
                        }
                    }).bind('sortEnd',function(e) {
                        if( $(e.target).hasClass('header') ) {
                            $("#overlay").hide();
                        }
                    });
    
 
}); /* end of as page load scripts */


/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
    var doc = w.document;
    if( !doc.querySelector ){ return; }
    var meta = doc.querySelector( "meta[name=viewport]" ),
        initialContent = meta && meta.getAttribute( "content" ),
        disabledZoom = initialContent + ",maximum-scale=1",
        enabledZoom = initialContent + ",maximum-scale=10",
        enabled = true,
		x, y, z, aig;
    if( !meta ){ return; }
    function restoreZoom(){
        meta.setAttribute( "content", enabledZoom );
        enabled = true; }
    function disableZoom(){
        meta.setAttribute( "content", disabledZoom );
        enabled = false; }
    function checkTilt( e ){
		aig = e.accelerationIncludingGravity;
		x = Math.abs( aig.x );
		y = Math.abs( aig.y );
		z = Math.abs( aig.z );
		// If portrait orientation and in one of the danger zones
        if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
			if( enabled ){ disableZoom(); } }
		else if( !enabled ){ restoreZoom(); } }
	w.addEventListener( "orientationchange", restoreZoom, false );
	w.addEventListener( "devicemotion", checkTilt, false );
})( this );