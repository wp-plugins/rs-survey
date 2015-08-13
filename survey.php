<?php
/*
Plugin Name: Rs Survey
Description: Create Surveys and see results submitted by users very easy very useful
Version:     1.0
Author:      RichestSoft

*/

function myplugin_activate() {

  $my_post = array(
  'post_title'    => 'Survey',
  'post_type'     => 'page',
  'post_content'  => '[rs_survey]',
  'post_status'   => 'publish',
  'post_author'   => 1,
  'post_category' => array(8,39)
);

  // Insert the post into the database
   wp_insert_post( $my_post );
}

register_activation_hook(__FILE__, 'myplugin_activate' );

add_action( 'wp_enqueue_scripts', 'plugin_scripts' );
function plugin_scripts()
{
      wp_enqueue_style( 'bootstrapCss',  plugins_url( '/css/bootstrap.min.css', __FILE__ ));
	  wp_enqueue_style( 'bootstrap-themeCss',  plugins_url( '/css/bootstrap-theme.min.css', __FILE__ ));
	  wp_enqueue_style( 'customCss',  plugins_url( '/css/custom.css', __FILE__ ));
	  wp_enqueue_script( 'bootstrapJs',  plugins_url( '/js/bootstrap.min.js', __FILE__ ),array('jquery') );
      wp_enqueue_script( 'customJs',  plugins_url( '/js/custom.js', __FILE__ ) );
}




function generate_survey()
{       ob_start();
	include(plugin_dir_path( __FILE__ ).'/start.php');		$content = ob_get_clean();		return $content;
	
	
}
add_shortcode( 'rs_survey', 'generate_survey' );

function survey_settings_options()
{

	add_menu_page( 'RS Survey Settngs', 'RS Survey', 'manage_options','survey-settings', 'rs_survey_settings');
    add_submenu_page( 'survey-settings', 'Add Survey', 'Add Survey','manage_options','add-survey', 'rs_add_survey');
    add_submenu_page( 'survey-settings', 'Settings', 'Settings','manage_options','settings', 'rs_survey_pdf_settings');
    //add_submenu_page('survey-settings', 'Results', 'Results', 'manage_options', 'results','rs_survey_result' );
}

function rs_survey_settings()
{
    include(plugin_dir_path( __FILE__ ).'/rs_settings.php');
}

function rs_add_survey()
{
    include(plugin_dir_path( __FILE__ ).'/add-survey.php');
}

function rs_survey_pdf_settings()
{
    include(plugin_dir_path( __FILE__ ).'/settings.php');
}

// function rs_survey_result()
// {
//     include(plugin_dir_path( __FILE__ ).'/results.php');
// }


add_action( 'admin_menu', 'survey_settings_options' );

function delete_quest()
{
	
	$index = $_POST['title_id'];
	$survey = get_option('survey_quest');
	unset($survey[$index]);
	$survey1 = array_values($survey);
	update_option('survey_quest', $survey1);
	exit();
	
}
add_action('wp_ajax_delete_quest','delete_quest');

function delete_question()
{
    
    $title_id = $_POST['delt'];
    $q_id = $_POST['question_id'];
    $survey = get_option('survey_quest');
    unset($survey[$title_id]['q'][$q_id]);
    unset($survey[$title_id]['c'][$q_id]);
    $survey1 = array_values($survey);
    update_option('survey_quest', $survey1);
    exit();
    
}

add_action('wp_ajax_delete_question','delete_question');

function delete_options()
{
    $survey = get_option('survey_quest');
    $opt_id = $_POST['opt_id'];
    $title_id = $_POST['title_id']; 
    $ques_id = $_POST['ques_id'];
    unset($survey[$title_id]['c'][$ques_id][$opt_id]);
    $survey1 = array_values($survey);
    update_option('survey_quest', $survey1);
    exit();
    
}

add_action('wp_ajax_delete_options','delete_options');

function all_questions()
{
    $survey = get_option('survey_quest');
    $title_id = $_POST['title_id'];
    $survey_q = $survey[$title_id];
    include('take_survey.php');
    exit();
    
}

add_action('wp_ajax_all_questions','all_questions');

// function delete_survey_a()
// {
//     $survey_taken = get_option('survey_taken');
//     $t_id = $_POST['title_id'];
//     $s_id = $_POST['q_id'];
//     unset($survey_taken[$t_id]);
//     $survey_re = array_values($survey_taken);
//     update_option('survey_taken', $survey_re);
//     exit();
    
// }

//add_action('wp_ajax_delete_survey_a','delete_survey_a');

/******pagination code start******/
function kriesi_pagination($pages = '', $range = 2)
{  
    //global $paged;
    $paged = $_REQUEST['paged'];
     $showitems = ($range * 2)+1;  

     
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}
/***********pagination code end***********/

