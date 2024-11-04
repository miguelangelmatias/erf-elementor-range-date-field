<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Range_Date extends \ElementorPro\Modules\Forms\Fields\Field_Base {


	public $depended_scripts = array(
		'elementor-range-date',
	);

	public $depended_styles = array(
		'flatpickr',
	);


	public function get_type() {
		return 'range-date';
	}


	public function get_name() {
		return esc_html__( 'Rango de Fechas', 'elementor-form-range-date-field' );
	}

	public function render( $item, $item_index, $form ) {
		$form_id = $form->get_id();

		$form->add_render_attribute(
			'input' . $item_index,
			array(
				'class'       => 'elementor-field-textual elementor-field-range-date',
				'for'         => $form_id . $item_index,
				'placeholder' => $item['range-date-placeholder'],
			)
		);

		echo '<input ' . $form->get_render_attribute_string( 'input' . $item_index ) . '>';
		?>


		<?php
	}


	public function update_controls( $widget ) {
		$elementor = \ElementorPro\Plugin::elementor();

		$control_data = $elementor->controls_manager->get_control_from_stack( $widget->get_unique_name(), 'form_fields' );

		if ( is_wp_error( $control_data ) ) {
			return;
		}

		$field_controls = array(
			'range-date-placeholder' => array(
				'name'         => 'range-date-placeholder',
				'label'        => esc_html__( 'Date Placeholder', 'elementor-form-range-date-field' ),
				'type'         => \Elementor\Controls_Manager::TEXT,
				'default'      => '',
				'dynamic'      => array(
					'active' => true,
				),
				'condition'    => array(
					'field_type' => $this->get_type(),
				),
				'tab'          => 'content',
				'inner_tab'    => 'form_fields_content_tab',
				'tabs_wrapper' => 'form_fields_tabs',
			),
		);

		$control_data['fields'] = $this->inject_field_controls( $control_data['fields'], $field_controls );

		$widget->update_control( 'form_fields', $control_data );
	}


	public function __construct() {
		parent::__construct();
		add_action( 'elementor/preview/init', array( $this, 'editor_preview_footer' ) );
	}


	public function editor_preview_footer() {
		add_action( 'wp_footer', array( $this, 'content_template_script' ) );
	}


	public function content_template_script() {
		?>
		<script>
		jQuery( document ).ready( () => {

			elementor.hooks.addFilter(
				'elementor_pro/forms/content_template/field/<?php echo $this->get_type(); ?>',
				function ( inputField, item, i ) {
					const fieldId      = `form_field_${i}`;
					const fieldClass   = `elementor-field-textual elementor-field elementor-field-range-date ${item.css_classes}`;
					const placeholder  = item['range-date-placeholder'];

					return `<input id="${fieldId}" class="${fieldClass}" placeholder="${placeholder}">`;
				}, 10, 3
			);

		});
		</script>
		<?php
	}
}
