<?php
/**********************
* Controls the custom post type hooks
* @author David Rugendyke
* @author_uri http://www.ironcode.com.au
* @since 1.0.0
***********************/

class CustomPostTypesHooksController extends HookController
{
	
	private $post_type;
	/**********************
	* Constructor
	* @author David Rugendyke
	* @since 1.0.0
	***********************/
	protected function beforeAction() {
		
		parent::beforeAction();

		// Load the model
		KontrolModel::load('custom_post_types', $this->controllerName);		
		
		
	}
	
		
	/**********************
	* The controller will add any hooks it needs to here for the WP environment - is called everytime the app runs
	* @author David Rugendyke
	* @param: ob - Reference of $this
	* @since 1.0.0
	***********************/
	public function actionSetHooks()
	{

		// Set the custom post types
		add_action('init', array(&$this,'setPostTypes'));
		
		if(is_admin()) {
			// Metabox CSS
			add_action('admin_print_styles', array(&$this, 'loadCSS'));
			// No $_GET['post_type'] set on the posts page, so look for that file
			$post_type = ($GLOBALS['pagenow'] == 'edit.php' && !isset($_GET['post_type'])) ? 'post': ''; 
			// Enable our post type columns
			if((isset($_GET['post_type']) && !empty($_GET['post_type'])) || !empty($post_type)) {
				$this->post_type = !empty($_GET['post_type']) ? $_GET['post_type'] : $post_type;
				// Set the column titles
				add_filter("manage_".$this->post_type."_posts_columns", array(&$this, 'setPostTypesColumns'));
				// Now set the column data
				add_action("manage_".$this->post_type."_posts_custom_column",  array(&$this, 'setPostTypesColumnsData'), 10, 2); 
			}
		}
		
	}
	
	/**********************
	* The CSS for the cpt columns
	* @author David Rugendyke
	* @since 1.0.1
	***********************/
	public function loadCSS()
	{
		// Load our metabox CSS
		wp_register_style('kontrol-cpt-cols', $this->app_module_current_url.'/css/cpt-columns.css');
        wp_enqueue_style('kontrol-cpt-cols');
	}
	
	/**********************
	* Sets the custom post type
	* @author David Rugendyke
	* @param: ob - Reference of $this
	* @since 1.0.0
	***********************/
	public function setPostTypes()
	{
		
		KontrolModel::load('custom_post_types_taxonomies', $this->controllerName);	

		// Load up any saved active custom post types
		$cpts = new CustomPostTypesModel();
		$cpts->active = 1;
		$cpts->dont_sort = TRUE;
		$results = $cpts->select();
		
		if(is_array($results)) {
			foreach($results as $cpt) {
				$args = unserialize($cpt->arguments);
				
				// Make the menu icon relative to the current install
				if(isset($args['menu_icon']) && !empty($args['menu_icon'])) {
					$args['menu_icon'] = Kontrol_Tools::absolute_upload_path($args['menu_icon']);
				}
				
				// Load our attached native taxonomies
				$load = new CustomPostTypesTaxonomiesModel();
				$load->cpt_id = $cpt->id;
				$load->tax_type = 'native';
				$taxes = $load->select();
				if(is_array($taxes) && count($taxes) > 0) {
					$args['taxonomies'] = array();
					foreach($taxes as $tax) {
						$args['taxonomies'][] = $tax->tax_key;
					}
				}
				
				/*
				echo $cpt->cpt_key;
				echo '<pre>';
				print_r($args);
				echo '</pre>';
				*/
				
				// Create the post type now
				register_post_type($cpt->cpt_key, $args);
				
				
			}
		}	
		
	}
	
	/**********************
	* Sets the custom post type columns
	* @author David Rugendyke
	* @since 1.0.1
	***********************/
	public function setPostTypesColumns($columns)
	{
		
		// The checkbox is default for bulk actions
		$new_columns = array('cb'=>'<input type="checkbox">');
		
		// First see if we have saved columns for this one
		$cpts = new CustomPostTypesModel();
		$cpts->type_ignore = TRUE;
		$cpts->active = 1;
		$cpts->key = $this->post_type;
		$results = $cpts->select();
		
		if(is_array($results)) {
			foreach($results as $cpt) {
				// Get our new columns
				$cpt_columns = unserialize($cpt->columns);
				// Any one with default columns set will use those
				if(is_array($cpt_columns) && in_array('default', $cpt_columns)) {
					return $columns;
				}
				// Make sure we have a valid array
				if(is_array($cpt_columns) && count($cpt_columns) > 0) {
					// Format the column titles
					foreach($cpt_columns as $col) {
						// Some cols have appended values, remove those
						if(isset($col) && strpos($col, ':') !== FALSE) {
							$col_parts = explode(':', $col);
							$col_label = $col_parts[0];	
							$col_value = $col_parts[1];	
						}else{
							$col_label = $col;	
						}
						// If it's a taxonomy, get the proper name
						if($col_label == 'taxonomy') {
							$tax = get_taxonomy($col_value);
							$col_label = $tax->label;
						}
						// Now if it's a kontrol custom field, get the name of the field
						if($col_label == 'kontrol_cf') {
							// Make sure the model is loaded
							KontrolModel::load('custom_fields');
							// Now grab the field
							$sel = new CustomFieldsModel();
							$sel->field_key = trim($col_value);
							//$sel->active = 1;
							$sel->limit = 1;
							$field = $sel->select();
							
							if(!empty($field)) {
								$col_label = $field->name;	
							}else{
								$col_label = __('Kontrol Field Key Not Found','kontrolwp');	
							}
						}
						
						
						// Remove any other characters and add it to the cols list
						$new_columns[$col] = ucwords(str_replace(':','', str_replace('_', ' ', $col_label)));	
					}
					
					$columns = $new_columns;
				}
				
			}
		}
			
		return $columns;	
	}
	
	/**********************
	* Sets the custom post type columns data
	* @author David Rugendyke
	* @since 1.0.1
	***********************/
	public function setPostTypesColumnsData($column, $post_id)
	{
		
		$post = get_post($post_id);
		
		
		// Some cols have appended values, seperate those
		if(isset($column) && strpos($column, ':') !== FALSE) {
			$col_parts = explode(':', $column);
			$col_label = $col_parts[0];	
			$col_value = trim($col_parts[1]);
		}else{
			$col_label = $column;	
		}
		
		
		switch ($col_label) {
				// The excerpt
				case 'excerpt':
					echo !isset($post->post_excerpt) ? '--' : $post->post_excerpt;
				break;
				// Post date formatted
				case 'date':
					echo date($col_value, strtotime($post->post_date));
				break;
				// Post modified date formatted
				case 'modified':
					echo !empty($col_value) ? date($col_value, strtotime($post->post_modified)) : $post->post_modified;
				break;
				// Post Type
				case 'post_type':
					$pt = get_post_type_object($post->post_type);
					echo $pt->labels->name;
				break;
				// Permalink
				case 'permalink':
					echo '<a href="'.get_permalink($post_id).'" target="_blank">'.get_permalink($post_id).'</a>';
				break;
				// Status
				case 'status':
					echo ucwords($post->post_status);
				break;
				// Name
				case 'name':
					echo $post->post_name;
				break;
				// Parent Page
				case 'parent':
					echo empty($post->post_parent) ? '--' : '<a href="'.get_permalink($post->post_parent).'" target="_blank">'.get_the_title($post->post_parent).'</a>';
				break;
				// Menu Order
				case 'menu_order':
					echo !isset($post->menu_order) ? '--' : $post->menu_order;
				break;
				// Pingable?
				case 'ping_status':
					echo !isset($post->ping_status) ? '--' : ucwords($post->ping_status);
				break;
				// Pingable?
				case 'comment_status':
					echo !isset($post->comment_status) ? '--' : ucwords($post->comment_status);
				break;
				// Taxonomy
				case 'taxonomy':
					$terms = get_the_term_list( $post_id , $col_value , '' , ', ' , '' );
					if ( is_string( $terms ) ) {
						echo $terms;
					} else {
						echo '--';
					}
				break;
				// Kontrol Custom Field
				case 'kontrol_cf':
					// Make sure the model is loaded
					KontrolModel::load('custom_fields');
					// Now grab the field
					$sel = new CustomFieldsModel();
					$sel->field_key = $col_value;
					//$sel->active = 1;
					$sel->limit = 1;
					$field = $sel->select();
					$field->settings = unserialize($field->settings);
					
					if(!empty($field)) {
						// Get the field data
						$data = get_cf($col_value, $post_id);	
						// Output the data into the column now
						if($field->field_type != 'repeatable') {
							// If it's a date field and a timestamp, format it using the label display format
							if($field->field_type == 'date' && trim($field->settings['date_value_format']) == '%s') {
								$data = date(str_replace('%','',$field->settings['date_format']), $data);
							}
							// Format the data correctly
							$this->setPostTypesKontrolCF($data);
						}else{
							// If it's a repetable field, make a table of it's contents
							if(is_array($data) && count($data) > 0) {
								echo '<table width="100%" class="kontrol-repeatable"><thead><tr>';
								// Get the first row
								$header_row = $data[0];
								foreach($header_row as $field_key => $subdata) {
									  $sel = new CustomFieldsModel();
									  $sel->field_key = $field_key;
									  //$sel->active = 1;
									  $sel->limit = 1;
									  $sel->parent_id = $field->id;
									  $subfield = $sel->select();	
									  echo '<th>'.$subfield->name.'</th>';
								}
								echo '</tr></thead><tbody>';
								// Print the data now
								foreach($data as $rows) {
									echo '<tr>';
									// Print out the rows data now
									foreach($rows as $field_key => $subdata) {
										echo '<td>';
										$this->setPostTypesKontrolCF($subdata);
										echo '</td>';
									}
								   echo '</tr>';
								}
								echo '</tbody></table>';
							}
						}
						
					}else{
						// Kontrol Field Key Not Found	
					}
					
				break;
		}
	}
	
	/**********************
	* Formats the data from a Kontrol custom field to showing in a cpt column
	* @author David Rugendyke
	* @since 1.0.1
	***********************/
	public static function setPostTypesKontrolCF($data)
	{
			
			// Boolean?
			if(is_bool($data) === true) {
				echo $data == TRUE ? __('Yes'):__('No');
				return;
			}
			// Print it if it's a string
			if(!is_array($data)) {
				echo Kontrol_Tools::make_clickable_links($data);
				return;	
			}
			// Array? But not a repeatable?
			if(is_array($data)) {
				if(count($data) > 0) {
					foreach($data as $item) {
						// If it's an object, it's most likely a post object
						if(is_object($item) && isset($item->ID)) {
							echo '<div class="kontrol-col-field-line"><a href="'.get_permalink($item->ID).'" target="_blank">'.get_the_title($item->ID).'</a></div>';
						}
						// Not an array data set? print it
						if(!is_array($item) && !is_object($item)) {
							echo '<div class="kontrol-col-field-line">'.Kontrol_Tools::make_clickable_links($item).'</div>';
						}
					}
				}else{
					echo '--';
				}
			}
	}
	
}

?>