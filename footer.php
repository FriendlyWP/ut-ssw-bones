			<footer class="footer" role="contentinfo">
			
				<div id="inner-footer" class="wrap clearfix">
					
					<div class="footer-content">
						<?php if( function_exists('the_field') ) {
						// NOTE THAT IF THIS FIELD IS SET TO RUN THE_CONTENT FILTER 
						// THE ALL-IN-ONE EVENT CALENDAR MAY REPEAT IN FOOTER
							$quick_links = get_field('quick_links', 'option');
							echo do_shortcode( html_entity_decode( $quick_links ) );
					} ?>
	                </div>	
					
					<!-- ORANGE TOWER & MENU BAR -->
					<div class="tower-logo">
						<span><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/library/images/footer_tower_statement.png" alt="What Starts Here Changes the World" /></span>
					</div>
				
				</div> <!-- end #inner-footer -->

				

				<div class="ut-footer">
					<div class="wrap clearfix">
						<?php if( function_exists('the_field') ) {
							the_field('ut_links', 'option');
						} ?>
					</div>
				</div>

<div class="hide">
<p>All PDF document downloads on this website require the <a href="http://get.adobe.com/reader/">Adobe Reader</a> or compatible software.</p>
<p>All Microsoft document downloads on this website require the <a href="http://office.microsoft.com/en-us/downloads/HA010449811033.aspx"> Microsoft Viewer</a> or compatible software.</p>
</div>
				
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->
		
		<!-- all js scripts are loaded in library/bones.php -->
		<?php wp_footer(); ?>

	</body>

</html> <!-- end page. what a ride! -->