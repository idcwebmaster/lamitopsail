<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$alt = 1;
$attributes = $product->get_attributes();

if ( empty( $attributes ) && ( ! $product->enable_dimensions_display() || ( ! $product->has_dimensions() && ! $product->has_weight() ) ) ) return;
?>
<div class="shop_attributes">

	<?php if ( $product->enable_dimensions_display() ) : ?>

		<?php if ( $product->has_weight() ) : ?>

			<div class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>  clearfix">
				<div class="fl"><?php _e( 'Weight', 'woocommerce' ) ?></div>
				<div class="product_weight fr"><?php echo $product->get_weight() . ' ' . esc_attr( get_option('woocommerce_weight_unit') ); ?></div>
			</div>

		<?php endif; ?>

		<?php if ( $product->has_dimensions() ) : ?>

			<div class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>  clearfix">
				<div class="fl"><?php _e( 'Dimensions', 'woocommerce' ) ?></div>
				<div class="product_dimensions fr"><?php echo $product->get_dimensions(); ?></div>
			</div>

		<?php endif; ?>

	<?php endif; ?>

	<?php foreach ( $attributes as $attribute ) :

		if ( empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) )
			continue;
		?>

		<div class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>  clearfix">
			<div class="fl"><?php echo $woocommerce->attribute_label( $attribute['name'] ); ?></div>
			<div class="fr"><?php
				if ( $attribute['is_taxonomy'] ) {

					$values = woocommerce_get_product_terms( $product->id, $attribute['name'], 'names' );
					echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

				} else {

					// Convert pipes to commas and display values
					$values = array_map( 'trim', explode( '|', $attribute['value'] ) );
					echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

				}
			?></div>
		</div>

	<?php endforeach; ?>

</div>