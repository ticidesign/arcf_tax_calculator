<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://mcsaatchi.com.au/
 * @since      1.0.0
 *
 * @package    Acrf_Tax_Calculator
 * @subpackage Acrf_Tax_Calculator/public/partials
 */
?>

<div class="tax-calculator">
	<div class="calculator-frame calculator-frame-1">
		<div class="calculator-title">
		 <?php echo $tax_data['title']; ?>		 	
		</div>
		<div class="calculator-text">
			<?php echo $tax_data['subtitle']; ?>
		</div>
		<div class="calculator-cta">
			<div class="calculator-dropdown calculator-income">
				<div class="dropdown-options">
					<div class="dropdown-option dropdown-value" data-value="0">Annual income</div>
					<?php $terms = get_terms("annual_income", array(
							'orderby' => 'slug',
							'order' => 'ASC',
						));
						if ( !empty( $terms ) && !is_wp_error( $terms ) ){
							foreach ( $terms as $term ) {
							?>
							<div class="dropdown-option" data-value="<?php echo $term->slug ?>"><?php echo $term->name ?></div>
							<?php
							}
						}

					wp_reset_query(); ?>
				</div>

				<div class="calculator-arrow">
					<svg width="12" height="12">
						<polyline points="0 3,6 11,12 3" style="fill:none;stroke:#2dcdd2;stroke-width:1" />
					</svg>
				</div>
			</div>

			<div class="calculator-dropdown calculator-donation">
				<div class="dropdown-options">
					<div class="dropdown-option dropdown-value" data-value="0">Your donation</div>
					<?php $terms = get_terms("your_donation", array(
							'order' => 'ASC',
						));

						usort( $terms, function($a, $b) {
							$ai = filter_var($a->name, FILTER_SANITIZE_NUMBER_INT);
							$bi = filter_var($b->name, FILTER_SANITIZE_NUMBER_INT);
							if ($ai == $bi) {
								return 0;
							}
							return ($ai < $bi) ? -1 : 1;
						});
						if ( !empty( $terms ) && !is_wp_error( $terms ) ){
							foreach ( $terms as $term ) {
							?>
							<div class="dropdown-option" data-value="<?php echo $term->slug ?>"><?php echo $term->name ?></div>
							<?php
							}
						}

					wp_reset_query(); ?>
				</div>

				<div class="calculator-arrow">
					<svg width="12" height="12">
						<polyline points="0 3,6 11,12 3" style="fill:none;stroke:#2dcdd2;stroke-width:1" />
					</svg>
				</div>
			</div>

			<div class="calculator-button calculator-calculate">
				<span>What you get back<span>
				<div class="calculator-arrow">
					<svg width="12" height="12">
						<polyline class="path" points="4 0,12 6,4 12" style="fill:none;stroke:#fff;stroke-width:1" />
					</svg>
				</div>
			</div>
		</div>
	</div>
	<div class="calculator-frame calculator-frame-2">

	<div class="calculator-cta calculator-cta-centred">
			<div class="calculator-button calculator-donate">
				<a href="https://acrf.com.au/donate/" style="color: #ffffff!important;">Donate now</a>
				<div class="calculator-arrow">
					<svg width="12" height="12">
						<polyline class="path" points="4 0,12 6,4 12" style="fill:none;stroke:#fff;stroke-width:1" />
					</svg>
				</div>
			</div>
			<div class="calculator-button calculator-button-inverse calculator-restart">
				<span>Recalculate</span>
				<div class="calculator-arrow">
					<svg width="12" height="12">
						<polyline class="path" points="4 0,12 6,4 12" style="fill:none;stroke:#2dcdd2;stroke-width:1" />
					</svg>
				</div>
			</div>
		</div>

		<?php $args = array(
				'post_type' => 'tax-calculator',
				'posts_per_page' => -1,
			);	

			$string = '';
			$string .= '<div class="tax_list">';
			$query = new WP_Query( $args );	
			if( $query->have_posts() ){
				while( $query->have_posts() ){
					$query->the_post();

					$donations = get_the_terms($post->ID, 'your_donation' );
					if ($donations && ! is_wp_error($donations)) :
						$donation_slugs_arr = array();
						foreach ($donations as $donation) {
							$donation_slugs_arr[] = $donation->slug;
						}
						$donations_slug_str = join( "", $donation_slugs_arr);
					endif;

					$incomes = get_the_terms($post->ID, 'annual_income' );
					if ($incomes && ! is_wp_error($dincomes)) :
						$income_slugs_arr = array();
						foreach ($incomes as $income) {
							$income_slugs_arr[] = $income->slug;
						}
						$incomes_slug_str = join( "", $income_slugs_arr);
					endif;

					$string .= '<div class="calculator-result calculator-result-' . $donations_slug_str . $incomes_slug_str .'">';
					$string .= '<div class="calculator-return">' . get_the_title() . '</div>';
					$string .= '<div class="calculator-quote">' . get_the_content() . '</div>';
					$string .= '</div>';
				}
			}
			$string .= '</div>';
			wp_reset_postdata();
			return $string;
		?>
		
	</div>
</div>