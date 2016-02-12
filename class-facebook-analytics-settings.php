<?php

class Facebook_Analytics_Settings
{
	public function __construct()
	{
		add_action( 'gfl_after_general_settings', array( $this, 'settings' ) );

		add_filter( 'gfl_default_settings', array( $this, 'default_settings' ) );
	}

	public function default_settings( $settings )
	{
		$settings['enqueue_mode'] 			= 'inline';
		$settings['fa_actions'] 			= array('like', 'unlike', 'comment');
		$settings['google_analytics_id'] 	= '';

		return $settings;
	}

	public function settings()
	{
		$defaults = gfl_default_settings();
		?>
		<div class="postbox">
	    	<div class="handlediv" title="Click to toggle"> <br></div>
	      	<h3 class="hndle ui-sortable-handle"><span class="dashicons dashicons-admin-plugins"></span> <?php _e( 'Facebook Analytics', 'get-facebook-likes' ); ?></h3>
	      	<div class="inside">
				<table class="form-table">

            		<tr valign="top">
            			<th><?php _e( 'Actions', 'get-facebook-likes' ); ?></th>
            			<td>
            				<?php foreach ( $defaults['fa_actions'] as $action ) : ?>
							<label>
            					<input type="checkbox" name="fa_actions[]" value="<?php echo $action ?>" <?php if ( in_array( $action, gfl_setting( 'fa_actions' ) ) ) echo 'checked'; ?>> <?php echo $action ?>
            				</label>
            				<?php endforeach; ?>
            				
							<p class="description">What actions to track with Google Analytics.</p>
            			</td>
            		</tr>

            		<tr valign="top">
            			<th><?php _e( 'Script Mode', 'get-facebook-likes' ); ?></th>
            			<td>
            				<label>
            					<input type="radio" name="enqueue_mode" value="inline" <?php if ( gfl_setting( 'enqueue_mode' ) == 'inline' ) echo 'checked'; ?>> Inline
            				</label>
            				<label>
            					<input type="radio" name="enqueue_mode" value="external" <?php if ( gfl_setting( 'enqueue_mode' ) == 'external' ) echo 'checked'; ?>> External
            				</label>
							<p class="description">Where to include Facebook analytics script. Inline or external.</p>
            			</td>
            		</tr>


            		<tr valign="top">
            			<th><?php _e( 'Google Analytics ID', 'get-facebook-likes' ); ?></th>
            			<td>
            				<input type="text" id="google_analytics_id" name="google_analytics_id" placeholder="UA-XXXXXXXX-X" value="<?php echo gfl_setting('google_analytics_id'); ?>"><br>

							<p class="description">This will add Google Analytics Tracking Code to your website's footer. Leaves blank if you've already set.</p>
            			</td>
            		</tr>

            	</table>
	      	</div>
	    </div>
		<?php
	}
}

new Facebook_Analytics_Settings;