<?php
/**
 * Archive Page template file.
 *
 * @package Wordpress-Land
 */

get_header();

?>
	<div id="primary">
		<main id="main" class="site-main my-5" role="main">
			<div class="container">

				<header class="page-header">
					<?php
					if ( ! empty( single_term_title( '', false ) ) ) {
						printf(
							'<h1 class="page-title">%s</h1>',
							single_term_title( '', false )
						);
					}

					if ( ! empty( get_the_archive_description() ) ) {
						the_archive_description( '<div class="archive-description">', '</div>' );
					}
					?>
				</header><!-- .page-header -->
				<div class="site-content">

				</div>
			</div>
		</main>
	</div>

<?php

get_footer();

