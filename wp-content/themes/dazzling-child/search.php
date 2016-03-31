<?php
 /**
 *
 * @package dazzling
 * @subpackage dazzling-child
 */

get_header(); ?>
		<section id="primary" class="content-area col-sm-12 col-md-12 col-lg-12 espacamento-busca">
			<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="">
					<h1 class="page-title titulo-busca"><?php printf( __( 'Resultado da busca por: %s', 'dazzling' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

                                    <?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>


			<?php else : ?>
                        <div class="espacamento-busca-erro">
				<?php get_template_part( 'content', 'none' ); ?>
                        </div>
			<?php endif; ?>

			</main><!-- #main -->
		</section><!-- #primary -->


<?php get_footer(); ?>
