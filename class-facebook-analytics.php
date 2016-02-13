<?php
/**
 * Facebook Analytics main class.
 * 
 * @author Tan Nguyen <tan@binaty.org>
 * 
 * @package Get Facebook Like
 * @subpackage Facebook Analytics
 */
class Facebook_Analytics
{
	public function __construct()
	{
		// Tell user to install Get Facebook Like script
		add_action( 'admin_notices', array( $this, 'admin_notices' ) );

		// Add Facebook Analytics and Google Analytics to site footer
		add_action( 'wp_footer', array( $this, 'facebook_analytic_scripts' ) );

		// Install dependencies
		add_action( 'tgmpa_register', array( $this, 'dependencies' ) );
	}

	/**
	 * Tell users install Get Facebook Likes
	 * 
	 * @return void
	 */
	public function dependencies()
	{
		$plugins = array(
			array(
				'name' => 'Get Facebook Likes',
				'slug' => 'get-facebook-likes',
				'required' => true,
				'force_activation' => true,
				'force_deactivation' => false
			)
		);

		$config = array(
			'id'           => 'fa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'fa-install-plugins', // Menu slug.
			'parent_slug'  => 'plugins.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => true,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
			'strings'      => array(
				'page_title'                      => __( 'Install Required Plugins', 'facebook-analytics' ),
				'menu_title'                      => __( 'Install Plugins', 'facebook-analytics' ),
				'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
		);

		tgmpa( $plugins, $config );
	}

	/**
	 * Tell users install Get Facebook Likes if it isn't installed
	 * 
	 * @return void
	 */
	public function admin_notices()
	{
		if ( class_exists( 'GFL_Main' ) )
			return;

		echo '<div class="error"><p>';
		_e( 'Facebook Analytics requires Get Facebook Like plugin to works. Please install and activate it.', 'facebook-analytics' );
		echo '</p></div>';
	}

	/**
	 * Print Google Analytics and Facebook Analytics
	 * 
	 * @return void
	 */
	public function facebook_analytic_scripts()
	{
		$google_analytics_id = gfl_setting( 'google_analytics_id' );

		$actions = gfl_setting('fa_actions');

		$matches = array(
			'like' 		=> 'edge.create',
			'unlike' 	=> 'edge.remove',
			'comment' 	=> 'comment.create'
		);
		?>
		<script>
			<?php 
			// Add Google Analytics script if id is provided
			if ( ! empty( $google_analytics_id ) ) : 
			?>

			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', '<?php echo $google_analytics_id ?>', 'auto');
			ga('send', 'pageview');
			<?php endif; ?>

			<?php foreach ( $actions as $action ) : ?>
			GFL.subscribe('<?php echo $matches[$action] ?>', function(url) {
			  	ga('send', 'social', 'Facebook', '<?php echo $action ?>', url);
		    });
		    <?php endforeach; ?>
		</script>
		<?php
	}
}