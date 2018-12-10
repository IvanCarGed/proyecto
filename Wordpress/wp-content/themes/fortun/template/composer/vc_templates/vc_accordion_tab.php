<?php
$output = $title = $collapsed = '';

extract(shortcode_atts(array(
	'title' => esc_html__( 'Section', 'fortun'),
	'active' => '',
), $atts));
global $acc_id;

if( $active != 'in' ){
	$collapsed = 'collapsed';
}
$acc_link = preg_replace('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', '', $title);
$acc_link = str_replace(' ', '-', strtolower($acc_link));
$output .= "\n\t\t\t" . '<div class="panel">';
    $output .= "\n\t\t\t\t" . '<a class="panel-title h6 '.$collapsed.'" data-toggle="collapse" data-parent="#'.$acc_id.'" href="#'.$acc_link.'-'.$acc_id.'">'.$title.'</a>';
    $output .= "\n\t\t\t\t" . '<div id="'.$acc_link.'-'.$acc_id.'" class="panel-body collapse '.$active.'">';
        $output .= ($content=='' || $content==' ') ? esc_html__( 'Empty section. Edit page to add content here.', 'fortun' ) : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div>';
    $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";

echo  $output;