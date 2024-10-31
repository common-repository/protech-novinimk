<?php
/**
 * Plugin Name: Protech Novini
 * Plugin URI: http://novini.mk
 * Description: Maecdonian news aggregator
 * Version: 1.0
 * Author: Protech
 * Author URI: http://protech.mk/
 *
 */
 add_action( 'widgets_init', 'novini_load_widgets' );

function novini_load_widgets() {
	register_widget( 'Novinimk' );
}

class Novinimk extends WP_Widget {

	function Novinimk() {
	
		$widget_ops = array( 'classname' => 'novinimk', 'description' => __('Maecdonian news aggregator', 'novinimk') );

		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'novini_mk' );

		$this->WP_Widget( 'novini_mk', __('Novini.mk news', 'novinimk'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$bgr= $instance['bgr'];
		$category = $instance['category'];
		$items = $instance['items'];
	
		echo $before_widget;
	
			echo $before_title . $title . $after_title;
			echo '<div id="novinimk_wrapper" style="background-color:'.$bgr.';"></div>';
			?>
            <script type="text/javascript" src="http://novini.mk/widgets/topnews.json?top=<?php echo $items.$category; ?>"></script>
	    <script type="text/javascript">
			 init_widget('novinimk_wrapper',600); 
            </script>
			<?
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['bgr'] = $new_instance['bgr'];
		$instance['category'] = $new_instance['category'];
		$instance['items'] = $new_instance['items'];
		return $instance;
	}

	function form( $instance ) {

		$defaults = array( 'title' => __('Актуелно', 'novinimk'), 'bgr' => '#ffffff', 'category' => 1, 'items' => 4 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'bgr' ); ?>"><?php _e('Позадинска боја:', 'novinimk'); ?></label>
			<input id="<?php echo $this->get_field_id( 'bgr' ); ?>" name="<?php echo $this->get_field_name( 'bgr' ); ?>" value="<?php echo $instance['bgr']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Наслов:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'items' ); ?>"><?php _e('Број на вести:', 'novinimk'); ?></label>
			<select id="<?php echo $this->get_field_id( 'items' ); ?>" name="<?php echo $this->get_field_name( 'items' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( '1' == $instance['items'] ) echo 'selected="selected"'; ?> value="1">1</option>
				<option <?php if ( '2' == $instance['items'] ) echo 'selected="selected"'; ?> value="2">2</option>
				<option <?php if ( '3' == $instance['items'] ) echo 'selected="selected"'; ?> value="3">3</option>
				<option <?php if ( '4' == $instance['items'] ) echo 'selected="selected"'; ?> value="4">4</option>
				<option <?php if ( '5' == $instance['items'] ) echo 'selected="selected"'; ?> value="5">5</option>
				<option <?php if ( '6' == $instance['items'] ) echo 'selected="selected"'; ?> value="6">6</option>
				<option <?php if ( '7' == $instance['items'] ) echo 'selected="selected"'; ?> value="7">7</option>
				<option <?php if ( '8' == $instance['items'] ) echo 'selected="selected"'; ?> value="8">8</option>
			</select>
		</p>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e('Категорија:', 'novinimk'); ?></label>
			<select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( '&mode=top' == $instance['category'] ) echo 'selected="selected"'; ?> value="&mode=top">Топ теми</option>
				<option <?php if ( '&mode=category&category=1' == $instance['category'] ) echo 'selected="selected"'; ?> value="&mode=category&category=1">Македонија</option>
				<option <?php if ( '&mode=category&category=3' == $instance['category'] ) echo 'selected="selected"'; ?> value="&mode=category&category=3">Балкан</option>
				<option <?php if ( '&mode=category&category=2' == $instance['category'] ) echo 'selected="selected"'; ?> value="&mode=category&category=2">Свет</option>
				<option <?php if ( '&mode=category&category=4' == $instance['category'] ) echo 'selected="selected"'; ?> value="&mode=category&category=4">Економија</option>
				<option <?php if ( '&mode=category&category=5' == $instance['category'] ) echo 'selected="selected"'; ?> value="&mode=category&category=5">Спорт</option>
				<option <?php if ( '&mode=category&category=6' == $instance['category'] ) echo 'selected="selected"'; ?> value="&mode=category&category=6">Хроника</option>
				<option <?php if ( '&mode=category&category=8' == $instance['category'] ) echo 'selected="selected"'; ?> value="&mode=category&category=8">Култура</option>
				<option <?php if ( '&mode=category&category=7' == $instance['category'] ) echo 'selected="selected"'; ?> value="&mode=category&category=7">Разно</option>
			</select>
		</p>
	<?php
	}
}

?>