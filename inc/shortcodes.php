<?php

// FULL PAGE TEMPLATES
// Shortcode for template  pages
add_shortcode('sn_template_page', 'sn_template_page');
// Test page
// add_shortcode('sn_test', 'sn_test');
// Login
// add_shortcode('sn_login', 'sn_login');
// Login
// add_shortcode('sn_lost_password', 'sn_lost_password');
// Expired Membership
// add_shortcode('sn_expired_membership', 'sn_expired_membership');
// add_shortcode('sn_permission_problems', 'sn_permission_problems');
// Dashboard
// add_shortcode('sn_dashboard', 'sn_dashboard');
// Video Library
// add_shortcode('sn_video_library', 'sn_video_library');
// Video Playlist
// add_shortcode('sn_video_playlist', 'sn_video_playlist');
// Study Guides
// add_shortcode('sn_study_guides', 'sn_study_guides');
// Settings
// add_shortcode('sn_settings', 'sn_settings');
// Help
// add_shortcode('sn_help', 'sn_help');
// add_shortcode('sn_help_email', 'sn_help_email');
// add_shortcode('sn_help_text', 'sn_help_text');
// add_shortcode('sn_help_call', 'sn_help_call');
// Quiz Banks
// add_shortcode('sn_quiz_banks', 'sn_quiz_banks');
// NCLEX
// add_shortcode('sn_nclex', 'sn_nclex');
// Quiz Performance Review
// add_shortcode('sn_performance_review', 'sn_performance_review');
// add_shortcode('sn_quiz_performance_review', 'sn_quiz_performance_review');
// add_shortcode('sn_performance_review_nclex', 'sn_performance_review_nclex');

// Quiz Builder
// add_shortcode('sn_quiz_builder', 'sn_quiz_builder');
// add_shortcode('sn_nclex_builder', 'sn_nclex_builder');
// Quiz Questions
// add_shortcode('sn_quiz_questions', 'sn_quiz_questions');
// add_shortcode('sn_nclex_questions', 'sn_nclex_questions');
// Quiz Results
// add_shortcode('sn_quiz_results', 'sn_quiz_results');
// add_shortcode('sn_nclex_results', 'sn_nclex_results');
// Search
add_shortcode('sn_search_library', 'sn_search_library');
//Create phone verification shortcode to build page
add_shortcode('sn_phone_verification','sn_phone_verification');
//Create phone verification shortcode to build page
add_shortcode('sn_phone_verification_new','sn_phone_verification_new');
//Create phone confirmation shortcode to build page
add_shortcode('sn_phone_confirmation','sn_phone_confirmation');
//Create complimentary library page
add_shortcode('sn_complimentary_library', 'sn_complimentary_library');

//ADMIN PAGES
add_shortcode('sn_admin_pages', 'sn_admin_pages');
add_shortcode('sn_admin_import_data', 'sn_admin_import_data');
//Create admin video library page
add_shortcode('sn_admin_video_library','sn_admin_video_library');
//Create admin video statistics page
add_shortcode('sn_admin_video_statistics', 'sn_admin_video_statistics');

function sn_search_library() {
	ob_start();
	include get_stylesheet_directory() . '/templates/search.php';
	return ob_get_clean();
}

function sn_admin_pages() {
	ob_start();
	include get_stylesheet_directory() . '/templates/admin/admin-pages.php';
	return ob_get_clean();
}

function sn_admin_import_data() {
	ob_start();
	include get_stylesheet_directory() . '/templates/admin/import-data.php';
	return ob_get_clean();
}

function sn_test() {
	ob_start();
	include get_stylesheet_directory() . '/templates/test.php';
	return ob_get_clean();
}


function sn_login() {
	ob_start();
	include get_stylesheet_directory() . '/templates/login.php';
	return ob_get_clean();
}

function sn_expired_membership() {
	ob_start();
	include get_stylesheet_directory() . '/templates/expired-membership.php';
	return ob_get_clean();
}

function sn_permission_problems() {
	ob_start();
	include get_stylesheet_directory() . '/templates/permission-problems.php';
	return ob_get_clean();
}

function sn_lost_password() {
	ob_start();
	include get_stylesheet_directory() . '/templates/lost-password.php';
	return ob_get_clean();
}


function sn_dashboard() {
	ob_start();
	include get_stylesheet_directory() . '/templates/dashboard.php';
	return ob_get_clean();
}

// function sn_quiz_banks() {
// 	ob_start();
// 	include get_stylesheet_directory() . '/templates/quiz-banks.php';
// 	return ob_get_clean();
// }

function sn_nclex() {
	ob_start();
	include get_stylesheet_directory() . '/templates/nclex-prep.php';
	return ob_get_clean();
}

function sn_performance_review() {
	ob_start();
	include get_stylesheet_directory() . '/templates/performance-review.php';
	return ob_get_clean();
}

function sn_quiz_performance_review() {
	ob_start();
	include get_stylesheet_directory() . '/templates/quiz-performance-review.php';
	return ob_get_clean();
}

function sn_performance_review_nclex() {
	ob_start();
	include get_stylesheet_directory() . '/templates/nclex-performance-review.php';
	return ob_get_clean();
}

function sn_quiz_builder() {
	ob_start();
	include get_stylesheet_directory() . '/templates/quiz-builder.php';
	return ob_get_clean();
}

function sn_nclex_builder() {
	ob_start();
	include get_stylesheet_directory() . '/templates/nclex-builder.php';
	return ob_get_clean();
}


function sn_quiz_questions() {
	ob_start();
	include get_stylesheet_directory() . '/templates/quiz-questions.php';
	return ob_get_clean();
}

function sn_quiz_results() {
	ob_start();
	include get_stylesheet_directory() . '/templates/quiz-results.php';
	return ob_get_clean();
}

function sn_nclex_results() {
	ob_start();
	include get_stylesheet_directory() . '/templates/nclex-results.php';
	return ob_get_clean();
}

function sn_nclex_questions() {
	ob_start();
	include get_stylesheet_directory() . '/templates/nclex-questions.php';
	return ob_get_clean();
}

function sn_video_library() {
	ob_start();
	include get_stylesheet_directory() . '/templates/video-library.php';
	return ob_get_clean();
}

function sn_video_playlist() {
	ob_start();
	include get_stylesheet_directory() . '/templates/video-playlist.php';
	return ob_get_clean();
}

function sn_study_guides() {
	ob_start();
	include get_stylesheet_directory() . '/templates/study-guides.php';
	return ob_get_clean();
}

function sn_settings() {
	ob_start();
	include get_stylesheet_directory() . '/templates/settings.php';
	return ob_get_clean();
}

function sn_help() {
	ob_start();
	include get_stylesheet_directory() . '/templates/help.php';
	return ob_get_clean();
}

function sn_help_email() {
	ob_start();
	include get_stylesheet_directory() . '/templates/help-email.php';
	return ob_get_clean();
}

function sn_help_text() {
	ob_start();
	include get_stylesheet_directory() . '/templates/help-text.php';
	return ob_get_clean();
}

function sn_help_call() {
	ob_start();
	include get_stylesheet_directory() . '/templates/help-call.php';
	return ob_get_clean();
}


/**
  * Create page template for phone verification
**/
function sn_phone_verification() {
    ob_start();
    include get_stylesheet_directory() . '/templates/phone-verification.php';
    return ob_get_clean();
}

/**
  * New phone verification
**/
function sn_phone_verification_new() {
    ob_start();
    include get_stylesheet_directory() . '/templates/phone-verification-new.php';
    return ob_get_clean();
}

/**
  * Create page template for phone verification
**/
function sn_phone_confirmation() {
    ob_start();
    include get_stylesheet_directory() . '/templates/phone-confirmation.php';
    return ob_get_clean();
}

/**
  * Create page template for admin video library
**/
function sn_admin_video_library() {
    ob_start();
    include get_stylesheet_directory() . '/templates/admin/sn-admin-video-library.php';
    return ob_get_clean();
}

/**
  * Create page template for admin video statistics
**/
function sn_admin_video_statistics() {
    ob_start();
    include get_stylesheet_directory() . '/templates/admin/sn-admin-video-statistics.php';
    return ob_get_clean();
}


/**
  * Create page template for admin video library
**/
function sn_complimentary_library() {
    ob_start();
    include get_stylesheet_directory() . '/templates/sn-complimentary-library.php';
    return ob_get_clean();
}


/** New Shortcode for templates
 *  Usage: [sn_template_page slug="quiz-banks"]
**/
function sn_template_page($atts = [], $content = null, $tag = '') {
	// normalize attribute keys, lowercase
	$atts = array_change_key_case((array)$atts, CASE_LOWER);

	ob_start();
	include get_stylesheet_directory() . '/templates/' . $atts["slug"] .'.php';
	return ob_get_clean();

}
