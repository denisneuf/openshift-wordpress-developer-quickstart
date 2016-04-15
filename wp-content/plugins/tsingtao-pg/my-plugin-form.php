<div class="wrap">
        <h2>Todo List Options</h2>
        <p><?php echo plugin_dir_url( __FILE__ ) ?></p>
        <p><?php echo plugin_basename(__FILE__) ?></p>
        <p><?php echo plugin_dir_path( __FILE__ ); ?></p>
    

        
        <form method="post" action="options.php">
			<?php settings_fields( 'my-settings-group' ); ?>
			<?php do_settings_sections( 'my-plugin' ); ?>
            <?php submit_button(); ?>
        </form>
    </div>