<div class="wrap about-wrap qodef-welcome-page">
    <div class="qodef-welcome-page-heading">
        <div class="qodef-welcome-page-logo">
            <img src="<?php echo esc_url( TOUCHUP_INC_ROOT . '/welcome/assets/img/logo.png' ); ?>" alt="<?php esc_attr_e( 'Qode Logo', 'touchup' ); ?>"/>
        </div>
        <h1 class="qodef-welcome-page-title">
			<?php echo sprintf( esc_html__( 'Welcome to %s', 'touchup' ), $theme_name ); ?>
            <small><?php echo esc_html( $theme_version ) ?></small>
        </h1>
    </div>
    <div class="qodef-welcome-page-text">
		<?php echo sprintf( esc_html__( 'Thank you for installing %s - %s! Everything in %s is streamlined to make your website building experience as simple and fun as possible. We hope you love using it to make a spectacular website.', 'touchup' ),
			$theme_name,
			$theme_description,
			$theme_name
		); ?>
    </div>
    <div class="qodef-welcome-page-content">
        <div class="qodef-welcome-page-screenshot">
            <img src="<?php echo esc_url( $theme_screenshot ); ?>" alt="<?php esc_attr_e( 'Theme Screenshot', 'touchup' ); ?>"/>
        </div>
        <div class="qodef-welcome-page-links-holder">
            <div class="qodef-welcome-page-install-core">
                <p><?php esc_html_e( 'Please install and activate required plugins in order to gain access to all the theme functionalities and features.', 'touchup' ); ?></p>
                <a class="qodef-welcome-page-install-button" href="<?php echo add_query_arg( array( 'page' => 'install-required-plugins&plugin_status=install' ), esc_url( admin_url( 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Install Required Plugins', 'touchup' ); ?>
                </a>
            </div>

            <h3><?php esc_html_e( 'Useful Links:', 'touchup' ); ?></h3>
            <ul class="qodef-welcome-page-links">
                <li>
                    <a href="https://helpcenter.qodeinteractive.com" target="_blank"><?php esc_html_e( 'Help Center', 'touchup' ); ?></a>
                </li>
                <li>
                    <a href="http://touchup.qodeinteractive.com/documentation/" target="_blank"><?php esc_html_e( 'Theme Documentation', 'touchup' ); ?></a>
                </li>
                <li>
                    <a href="https://qodeinteractive.com/" target="_blank"><?php esc_html_e( 'All Our Themes', 'touchup' ); ?></a>
                </li>
                <li>
                    <a href="<?php echo add_query_arg( array( 'page' => 'install-required-plugins&plugin_status=install' ), esc_url( admin_url( 'themes.php' ) ) ); ?>"><?php esc_html_e( 'Install Required Plugins', 'touchup' ); ?></a>
                </li>
            </ul>
        </div>
    </div>
</div>