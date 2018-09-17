<?php

class WPBakeryShortCode_VC_mad_tables1 extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'table_type' => 'table_type_1',
			'columns' => 1,
			'rows' => 1,
			'data' => 'none',
			'custom_data' => 'none',
		), $atts, 'vc_mad_tables1');

		return $this->html();
	}

	public function stringData($colsVal, $rowsVal, $data) {
		$stringData = array();
		$counter = 0;

		for ($i = 0; $i < $rowsVal; $i++) {
			$stringData[$i] = array();
			for ($j = 0; $j < $colsVal; $j++) {
				$stringData[$i][$j] = $data[$counter];
				$counter ++;
			}
		}
		return $stringData;
	}

	public function html() {

		$output = $title = $data = $custom_data = $rows = $columns = $table_type = '';

		extract($this->atts);

		$data = explode('||', $custom_data);


	
		$output .= '<div class="custom-table section_3">';

			$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'section_title_medium' ) );

			$output .= '<table class="'. $table_type .'">';

				
			if($table_type == 'table_type_1') {
				
				for ($i = 0; $i < $rows; $i++) {
					if($i == 0) {
						$in_table1='<th>';
						$in_table2='</th>';
						
						$output .= '<tr class="f_size_large">';
					} else {
						$in_table1='<td>';
						$in_table2='</td>';
						
						$output .= '<tr>';
					}
					

						for ($j = 0; $j < $columns; $j++) {
							$stringData = $this->stringData($columns, $rows, $data);
							if (isset($stringData) && is_array($stringData) && $stringData != '') {
								$value = $stringData[$i][$j];
							}
							$output .= $in_table1.''. do_shortcode($value) .''.$in_table2;
						}

					$output .= '</tr>';
				}
				
			} else {
				
				for ($i = 0; $i < $rows; $i++) {
					$output .= '<tr>';

						for ($j = 0; $j < $columns; $j++) {
							$stringData = $this->stringData($columns, $rows, $data);
							if (isset($stringData) && is_array($stringData) && $stringData != '') {
								$value = $stringData[$i][$j];
							}
							
							if($j == 0) {
								$in_table1='<th>';
								$in_table2='</th>';
							} else {
								$in_table1='<td>';
								$in_table2='</td>';
							}
							
							
							$output .= $in_table1.''. do_shortcode($value) .''.$in_table2;
						}

					$output .= '</tr>';
				}
				
			}
			
			
			$output .= '</table>';

		$output .= '</div>';

		
		
		
		
		return $output;
	}
}