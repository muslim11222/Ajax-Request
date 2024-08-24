<?php

/**
 * Plugin name: Ajax Request plugin
 * Description: This is a ajax request plugin
 */

 class ar_ajax_request {
     public function __construct() {
          add_action('init', array($this, 'init'));
     }

     public function init() {
          add_action('admin_enqueue_scripts', array($this, 'load_scripts'));                                       //scripts loaded successfully
          add_action('admin_menu', array($this, 'admin_menu'));                                                   // menu loaded successfully
          add_action('wp_ajax_academy_ajax_get_posts', array($this, 'academy_ajax_get_posts_ajax'));              // AJAX POST successfully
          // add_action('wp_ajax_nopriv_academy_ajax_get_posts', array($this, 'academy_ajax_get_posts_ajax'));   //ata diye front thek request pathano jbe user sarai 
     }

// manu page add
     public function admin_menu() {
          add_menu_page(
               'ajax_admin',
               'ajax_request',
               'manage_options',
               'academy_wp_plugin_ajax',
               array($this, 'academy_wp_plugin_ajax_callback')
          );
     }

     public function academy_wp_plugin_ajax_callback() {
          echo '<div class="plugin_ajax_callback"></div>';
     }


     
     
     // script load
     public function load_scripts($hook) {
          $ajax_path = plugin_dir_url(__FILE__);
          $js_path = $ajax_path. "js/";
           
         if ( 'toplevel_page_academy_wp_plugin_ajax' == $hook) {                       // sudhu admin panele script show korbe
          wp_enqueue_script('ajax_script', $js_path. "script.js" , [], '1.0',  true);

          wp_localize_script('ajax_script', 'academyAjax', array(        /// atar kaj holo php theke js kono data pathanor wp_ script
               'ajax_url' => admin_url('admin-ajax.php'),
               'ajax_nonce' => wp_create_nonce('academy')      // Nonce part academy ta onno name dileo hobe 
          ));
         }
     }





     // ajax hook call

     public function academy_ajax_get_posts_ajax() {

          check_ajax_referer('academy');       //Nonce part

        $posts = get_posts(array(                        // joto post/post ase sob show korbe ... jekhane amr menus page make korci 
          'post_type' => 'page',
        ));
        wp_send_json($posts);        
        
     }
 }
 new ar_ajax_request();