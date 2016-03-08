<?php
/**
 * Add settings meta box after General Setting in Get Facebook Likes plugin
 *
 * @author Tan Nguyen <tan@binaty.org>
 */
class Facebook_Analytics_Settings
{
	/**
	 * Register default setting and add setting meta box
	 */
	public function __construct()
	{
		// Render setting meta box after General Settings
		add_action( 'gfl_after_general_settings', array( $this, 'render' ) );

		// Register default settings
		add_filter( 'gfl_default_settings', array( $this, 'default_settings' ) );
	}

	/**
	 * Default settings for Facebook Analytics
	 * 
	 * @param  Array $settings
	 * 
	 * @return Array
	 */
	public function default_settings( $settings )
	{
		$settings['fa_actions'] 			= array( 'like', 'unlike', 'comment' );
		$settings['google_analytics_id'] 	= '';

		return $settings;
	}

	/**
	 * Settings Meta Box
	 * 
	 * @return void
	 */
	public function render()
	{
		$defaults = gfl_default_settings();
		?>
		<div class="postbox">
	    	<div class="handlediv" title="Click to toggle"> <br></div>
	      	<h3 class="hndle ui-sortable-handle"><span class="dashicons dashicons-admin-plugins"></span> <?php _e( 'Facebook Analytics', 'facebook-analytics' ); ?></h3>
	      	<div class="inside">
				<table class="form-table">

            		<tr valign="top">
            			<th><?php _e( 'Actions', 'facebook-analytics' ); ?></th>
            			<td>
            				<?php foreach ( $defaults['fa_actions'] as $action ) : ?>
							<label>
            					<input type="checkbox" name="fa_actions[]" value="<?php echo $action ?>" <?php if ( in_array( $action, gfl_setting( 'fa_actions' ) ) ) echo 'checked'; ?>> <?php echo $action ?>
            				</label>
            				<?php endforeach; ?>
            				
							<p class="description"><?php _e( 'What actions to track with Google Analytics.', 'facebook-analytics' ); ?></p>
            			</td>
            		</tr>

            		<tr valign="top">
            			<th><?php _e( 'Google Analytics ID', 'facebook-analytics' ); ?></th>
            			<td>
            				<input type="text" id="google_analytics_id" name="google_analytics_id" placeholder="UA-XXXXXXXX-X" value="<?php echo gfl_setting('google_analytics_id'); ?>"><br>

							<p class="description"><?php _e( "This will add Google Analytics tracking code to your website. Leaves blank if you've already added.", 'facebook-analytics' ); ?></p>
            			</td>
            		</tr>

            	</table>
	      	</div>
	    </div>
		<?php
	}
}

new Facebook_Analytics_Settings;