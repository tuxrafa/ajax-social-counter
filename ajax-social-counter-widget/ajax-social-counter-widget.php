<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
/*
Plugin Name: Ajax Social Counter Widget
Description: Ajax Social Counter Widget for English Live
*/

// Register and load the widget
function wpb_load_widget() {
  register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

// Creating the widget
class wpb_widget extends WP_Widget {

  function __construct() {
    parent::__construct(

      // Base ID of your widget
      'wpb_widget',

      // Widget name will appear in UI
      __('Ajax Social Counter Widget', 'wpb_widget_domain'),

      // Widget description
      array( 'description' => __( 'Ajax Social Counter Widget for English Live', 'wpb_widget_domain' ), )
    );
  }

  // Creating widget front-end

  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );

    $fb_token = apply_filters( 'widget_title', $instance['fb_token'] );
    $tw_token = apply_filters( 'widget_title', $instance['tw_token'] );
    $tw_secret = apply_filters( 'widget_title', $instance['tw_secret'] );
    $in_token = apply_filters( 'widget_title', $instance['in_token'] );
    $yt_token = apply_filters( 'widget_title', $instance['yt_token'] );
    $gp_token = apply_filters( 'widget_title', $instance['gp_token'] );

    $fb_profile = apply_filters( 'widget_title', $instance['fb_profile'] );
    $tw_profile = apply_filters( 'widget_title', $instance['tw_profile'] );
    $in_profile = apply_filters( 'widget_title', $instance['in_profile'] );
    $yt_profile = apply_filters( 'widget_title', $instance['yt_profile'] );
    $gp_profile = apply_filters( 'widget_title', $instance['gp_profile'] );

    $fb_link = apply_filters( 'widget_title', $instance['fb_link'] );
    $tw_link = apply_filters( 'widget_title', $instance['tw_link'] );
    $in_link = apply_filters( 'widget_title', $instance['in_link'] );
    $yt_link = apply_filters( 'widget_title', $instance['yt_link'] );
    $gp_link = apply_filters( 'widget_title', $instance['gp_link'] );
    // before and after widget arguments are defined by themes
    echo $args['before_widget'];
    if ( ! empty( $title ) )
      echo $args['before_title'] . $title . $args['after_title'];

    $twitter_count = $this->getTwitter($tw_profile, $tw_token, $tw_secret);
    ?>
<link rel='stylesheet' id='font-awesome-css'  href='https://www.englishlivebrasil.com.br/testes-blog/wp-content/plugins/magee-shortcodes/assets/font-awesome/css/font-awesome.css?ver=4.4.0' type='text/css' media='' />
    <div id="ascw-social-counters" class="apsc-icons-wrapper">
      <div class="apsc-each-profile">
        <a class="apsc-facebook-icon clearfix" href="<?php echo $fb_link; ?>" target="_blank">
          <div class="apsc-inner-block">
            <span class="social-icon"><i class="fa fa-facebook apsc-facebook"></i><span class="media-name">Facebook</span></span>
            <span id="ascw-facebook" class="apsc-count"></span><span class="apsc-media-type"> fans</span>
          </div>
        </a>
      </div>

      <div class="apsc-each-profile">
        <a class="apsc-twitter-icon clearfix" href="<?php echo $tw_link; ?>" target="_blank">
          <div class="apsc-inner-block">
            <span class="social-icon"><i class="fa fa-twitter apsc-twitter"></i><span class="media-name">Twitter</span></span>
            <span id="ascw-twitter" class="apsc-count"><?php echo number_format($twitter_count, 0, ',', '.'); ?></span><span class="apsc-media-type"> followers</span>
          </div>
        </a>
      </div>

      <div class="apsc-each-profile">
        <a class="apsc-instagram-icon clearfix" href="<?php echo $in_link; ?>" target="_blank">
          <div class="apsc-inner-block">
            <span class="social-icon"><i class="fa fa-instagram apsc-facebook"></i><span class="media-name">Instagram</span></span>
            <span id="ascw-instagram" class="apsc-count"></span><span class="apsc-media-type"> followers</span>
          </div>
        </a>
      </div>

      <div class="apsc-each-profile">
        <a class="apsc-youtube-icon clearfix" href="<?php echo $yt_link; ?>" target="_blank">
          <div class="apsc-inner-block">
            <span class="social-icon"><i class="fa fa-youtube-play apsc-youtube"></i><span class="media-name">Youtube</span></span>
            <span id="ascw-youtube" class="apsc-count"></span><span class="apsc-media-type"> subscribers</span>
          </div>
        </a>
      </div>

      <div class="apsc-each-profile">
        <a class="apsc-google-plus-icon clearfix" href="<?php echo $gp_link; ?>" target="_blank">
          <div class="apsc-inner-block">
            <span class="social-icon"><i class="fa fa-google-plus apsc-google-plus"></i><span class="media-name">Google+</span></span>
            <span id="ascw-google-plus" class="apsc-count"></span><span class="apsc-media-type"> followers</span>
          </div>
        </a>
      </div>

    </div>
    <script>
    	 try {
    	 jQuery.ajax({
    	     url: "https://graph.facebook.com/v2.7/<?php echo $fb_profile; ?>?fields=fan_count&access_token=<?php echo $fb_token; ?>",
    	   }).done(function(data) {
    	    jQuery("#ascw-facebook").text(data['fan_count'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
    	   });
    		 } catch (e) {
    			 console.log("Error Facebook:");
    			 console.log(e);
    		 }

    	 try {
    	 jQuery.ajax({
    	     url: "https://www.instagram.com/<?php echo $in_profile; ?>/?__a=1&",
    	   }).done(function(data) {
    	     jQuery("#ascw-instagram").text(data['user']['followed_by']['count'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
    	   });
    		 } catch (e) {
    			 console.log("Error Instagram:");
    			 console.log(e);
    		 }

        try {
        jQuery.ajax({
            url: "https://www.googleapis.com/plus/v1/people/<?php echo $gp_profile; ?>?key=<?php echo $gp_token; ?>",
          }).done(function(data) {
            jQuery("#ascw-google-plus").text(data['circledByCount'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
          });
        } catch (e) {
          console.log("Error Google Plus:");
          console.log(e);
        }
          try {
          jQuery.ajax({
            url: "https://www.googleapis.com/youtube/v3/channels?part=statistics&id=<?php echo $yt_profile; ?>&key=<?php echo $yt_token; ?>",
              }).done(function(data) {
                jQuery("#ascw-youtube").text(data["items"][0]['statistics']['subscriberCount'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
              });
            } catch (e) {
              console.log("Error Youtube:");
              console.log(e);
          }
         </script>
    <?php
    echo $args['after_widget'];
  }

  // Widget Backend
  public function form( $instance ) {

    $title = (isset( $instance['title'])) ? $instance['title'] : __('Título', 'wpb_widget_domain');

    $fb_token = (isset( $instance['fb_token'])) ? $instance['fb_token'] : __('Token do Facebook', 'wpb_widget_domain');
    $tw_token = (isset( $instance['tw_token'])) ? $instance['tw_token'] : __('Token do Twitter', 'wpb_widget_domain');
    $tw_secret = (isset( $instance['tw_secret'])) ? $instance['tw_secret'] : __('Secret do Twitter', 'wpb_widget_domain');
    $in_token = (isset( $instance['in_token'])) ? $instance['in_token'] : __('Token do Instagram', 'wpb_widget_domain');
    $yt_token = (isset( $instance['yt_token'])) ? $instance['yt_token'] : __('Token do Youtube', 'wpb_widget_domain');
    $gp_token = (isset( $instance['gp_token'])) ? $instance['gp_token'] : __('Token do Google Plus', 'wpb_widget_domain');

    $fb_profile = (isset( $instance['fb_profile'])) ? $instance['fb_profile'] : __('Profile ID do Facebook', 'wpb_widget_domain');
    $tw_profile = (isset( $instance['tw_profile'])) ? $instance['tw_profile'] : __('Profile ID do Twitter', 'wpb_widget_domain');
    $in_profile = (isset( $instance['in_profile'])) ? $instance['in_profile'] : __('Profile ID do Instagram', 'wpb_widget_domain');
    $yt_profile = (isset( $instance['yt_profile'])) ? $instance['yt_profile'] : __('Profile ID do Youtube', 'wpb_widget_domain');
    $gp_profile = (isset( $instance['gp_profile'])) ? $instance['gp_profile'] : __('Profile ID do Google Plus', 'wpb_widget_domain');

    $fb_link = (isset( $instance['fb_link'])) ? $instance['fb_link'] : __('Link do Facebook', 'wpb_widget_domain');
    $tw_link = (isset( $instance['tw_link'])) ? $instance['tw_link'] : __('Link do Twitter', 'wpb_widget_domain');
    $in_link = (isset( $instance['in_link'])) ? $instance['in_link'] : __('Link do Instagram', 'wpb_widget_domain');
    $yt_link = (isset( $instance['yt_link'])) ? $instance['yt_link'] : __('Link do Youtube', 'wpb_widget_domain');
    $gp_link = (isset( $instance['gp_link'])) ? $instance['gp_link'] : __('Link do Google Plus', 'wpb_widget_domain');
    // Widget admin form
    ?>
    <style>
    ul.tabs {
      padding: 0 !important;
    }
    .tabs li {
      float: left;
      width: 33%;
      list-style: none;
    }
    .tabs a {
      display: block;
      text-align: center;
      text-decoration: none;
      text-transform: uppercase;
      color: #888;
      padding: 20px 0;
      border-bottom: 2px solid #888;
      background: #f7f7f7;
    }
    .tabs a:hover,
    .tabs a.active {
      background: #ddd;
    }
    .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }

    </style>

    <div class="tab-wrapper">
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
      <br/><br/>
    <ul class="tabs clearfix" data-tabgroup="first-tab-group">
      <li><a href="#tabToken" class="active">Tokens</a></li>
      <li><a href="#tabProfile">Profile IDs</a></li>
      <li><a href="#tabLink">Links</a></li>
    </ul>
    <section id="first-tab-group" class="tabgroup">
      <div id="tabToken">
        <h2>Tokens</h2>
        <p>
            <label for="<?php echo $this->get_field_id( 'fb_token' ); ?>"><?php _e( 'Facebook:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'fb_token' ); ?>" name="<?php echo $this->get_field_name( 'fb_token' ); ?>" type="text" value="<?php echo esc_attr( $fb_token ); ?>" />
            <br/><br/>
            <label for="<?php echo $this->get_field_id( 'tw_token' ); ?>"><?php _e( 'Twitter Key:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'tw_token' ); ?>" name="<?php echo $this->get_field_name( 'tw_token' ); ?>" type="text" value="<?php echo esc_attr( $tw_token ); ?>" />
            <label for="<?php echo $this->get_field_id( 'tw_secret' ); ?>"><?php _e( 'Twitter Secret:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'tw_secret' ); ?>" name="<?php echo $this->get_field_name( 'tw_secret' ); ?>" type="text" value="<?php echo esc_attr( $tw_secret ); ?>" />
            <br/><br/>
            <label for="<?php echo $this->get_field_id( 'in_token' ); ?>"><?php _e( 'Instagram:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'in_token' ); ?>" name="<?php echo $this->get_field_name( 'in_token' ); ?>" type="text" value="<?php echo esc_attr( $in_token ); ?>" />
            <br/><br/>
            <label for="<?php echo $this->get_field_id( 'yt_token' ); ?>"><?php _e( 'Youtube:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'yt_token' ); ?>" name="<?php echo $this->get_field_name( 'yt_token' ); ?>" type="text" value="<?php echo esc_attr( $yt_token ); ?>" />
            <br/><br/>
            <label for="<?php echo $this->get_field_id( 'gp_token' ); ?>"><?php _e( 'Google Plus:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'gp_token' ); ?>" name="<?php echo $this->get_field_name( 'gp_token' ); ?>" type="text" value="<?php echo esc_attr( $gp_token ); ?>" />

        </p>
      </div>
      <div id="tabProfile">
        <h2>Profile IDs</h2>
        <p>
            <label for="<?php echo $this->get_field_id( 'fb_profile' ); ?>"><?php _e( 'Facebook:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'fb_profile' ); ?>" name="<?php echo $this->get_field_name( 'fb_profile' ); ?>" type="text" value="<?php echo esc_attr( $fb_profile ); ?>" />
            <br/><br/>
            <label for="<?php echo $this->get_field_id( 'tw_profile' ); ?>"><?php _e( 'Twitter:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'tw_profile' ); ?>" name="<?php echo $this->get_field_name( 'tw_profile' ); ?>" type="text" value="<?php echo esc_attr( $tw_profile ); ?>" />
            <br/><br/>
            <label for="<?php echo $this->get_field_id( 'in_profile' ); ?>"><?php _e( 'Instagram:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'in_profile' ); ?>" name="<?php echo $this->get_field_name( 'in_profile' ); ?>" type="text" value="<?php echo esc_attr( $in_profile ); ?>" />
            <br/><br/>
            <label for="<?php echo $this->get_field_id( 'yt_profile' ); ?>"><?php _e( 'Youtube:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'yt_profile' ); ?>" name="<?php echo $this->get_field_name( 'yt_profile' ); ?>" type="text" value="<?php echo esc_attr( $yt_profile ); ?>" />
            <br/><br/>
            <label for="<?php echo $this->get_field_id( 'gp_profile' ); ?>"><?php _e( 'Google Plus:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'gp_profile' ); ?>" name="<?php echo $this->get_field_name( 'gp_profile' ); ?>" type="text" value="<?php echo esc_attr( $gp_profile ); ?>" />

        </p>
      </div>
      <div id="tabLink">
        <h2>Links</h2>
        <p>
            <label for="<?php echo $this->get_field_id( 'fb_link' ); ?>"><?php _e( 'Facebook:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'fb_link' ); ?>" name="<?php echo $this->get_field_name( 'fb_link' ); ?>" type="text" value="<?php echo esc_attr( $fb_link ); ?>" />
            <br/><br/>
            <label for="<?php echo $this->get_field_id( 'tw_link' ); ?>"><?php _e( 'Twitter:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'tw_link' ); ?>" name="<?php echo $this->get_field_name( 'tw_link' ); ?>" type="text" value="<?php echo esc_attr( $tw_link ); ?>" />
            <br/><br/>
            <label for="<?php echo $this->get_field_id( 'in_link' ); ?>"><?php _e( 'Instagram:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'in_link' ); ?>" name="<?php echo $this->get_field_name( 'in_link' ); ?>" type="text" value="<?php echo esc_attr( $in_link ); ?>" />
            <br/><br/>
            <label for="<?php echo $this->get_field_id( 'yt_link' ); ?>"><?php _e( 'Youtube:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'yt_link' ); ?>" name="<?php echo $this->get_field_name( 'yt_link' ); ?>" type="text" value="<?php echo esc_attr( $yt_link ); ?>" />
            <br/><br/>
            <label for="<?php echo $this->get_field_id( 'gp_link' ); ?>"><?php _e( 'Google Plus:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'gp_link' ); ?>" name="<?php echo $this->get_field_name( 'gp_link' ); ?>" type="text" value="<?php echo esc_attr( $gp_link ); ?>" />

        </p>
      </div>
    </section>
    </div>

    <script>

    var target;
    jQuery('.tabgroup > div').hide();
    jQuery('.tabgroup > div:first-of-type').show();

    jQuery('.tabs a').click(function(e){
      e.preventDefault();
        var jQuerythis = jQuery(this),
            tabgroup = '#'+jQuery(this).parents('.tabs').data('tabgroup'),
            others = jQuery(this).closest('li').siblings().children('a'),
            target = jQuery(this).attr('href');
        others.removeClass('active');
        jQuery(this).addClass('active');
        jQuery(this).parents('.tab-wrapper').find("#first-tab-group").children('div').css('display', 'none');
        jQuery(this).parents('.tab-wrapper').find("#first-tab-group "+target).css('display', 'block');
        console.log(jQuery(this).parents('.tab-wrapper').find("#first-tab-group "+target));


    });

    </script>

    <?php
  }

  // Updating widget replacing old instances with new
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    $instance['fb_token'] = ( ! empty( $new_instance['fb_token'] ) ) ? strip_tags( $new_instance['fb_token'] ) : '';
    $instance['tw_token'] = ( ! empty( $new_instance['tw_token'] ) ) ? strip_tags( $new_instance['tw_token'] ) : '';
    $instance['tw_secret'] = ( ! empty( $new_instance['tw_secret'] ) ) ? strip_tags( $new_instance['tw_secret'] ) : '';
    $instance['in_token'] = ( ! empty( $new_instance['in_token'] ) ) ? strip_tags( $new_instance['in_token'] ) : '';
    $instance['yt_token'] = ( ! empty( $new_instance['yt_token'] ) ) ? strip_tags( $new_instance['yt_token'] ) : '';
    $instance['gp_token'] = ( ! empty( $new_instance['gp_token'] ) ) ? strip_tags( $new_instance['gp_token'] ) : '';

    $instance['fb_profile'] = ( ! empty( $new_instance['fb_profile'] ) ) ? strip_tags( $new_instance['fb_profile'] ) : '';
    $instance['tw_profile'] = ( ! empty( $new_instance['tw_profile'] ) ) ? strip_tags( $new_instance['tw_profile'] ) : '';
    $instance['in_profile'] = ( ! empty( $new_instance['in_profile'] ) ) ? strip_tags( $new_instance['in_profile'] ) : '';
    $instance['yt_profile'] = ( ! empty( $new_instance['yt_profile'] ) ) ? strip_tags( $new_instance['yt_profile'] ) : '';
    $instance['gp_profile'] = ( ! empty( $new_instance['gp_profile'] ) ) ? strip_tags( $new_instance['gp_profile'] ) : '';

    $instance['fb_link'] = ( ! empty( $new_instance['fb_link'] ) ) ? strip_tags( $new_instance['fb_link'] ) : '';
    $instance['tw_link'] = ( ! empty( $new_instance['tw_link'] ) ) ? strip_tags( $new_instance['tw_link'] ) : '';
    $instance['in_link'] = ( ! empty( $new_instance['in_link'] ) ) ? strip_tags( $new_instance['in_link'] ) : '';
    $instance['yt_link'] = ( ! empty( $new_instance['yt_link'] ) ) ? strip_tags( $new_instance['yt_link'] ) : '';
    $instance['gp_link'] = ( ! empty( $new_instance['gp_link'] ) ) ? strip_tags( $new_instance['gp_link'] ) : '';
    return $instance;
  }

  public function getTwitter($twitter_user, $encoded_consumer_key, $encoded_consumer_secret) {

        // Encode token
        $bearer_token = $encoded_consumer_key . ':' . $encoded_consumer_secret;
        $base64_consumer_key = base64_encode($bearer_token);

        $url = "https://api.twitter.com/oauth2/token";

        // Set headers
        $headers = array(
                "POST /oauth2/token HTTP/1.1",
                "Host: api.twitter.com",
                "User-Agent: Twitter Application-only OAuth App",
                "Authorization: Basic " . $base64_consumer_key,
                "Content-Type: application/x-www-form-urlencoded;charset=UTF-8",
                "Content-Length: 29"
        );

        // Request access_token
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $header = curl_setopt($ch, CURLOPT_HEADER, 1);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $response = curl_exec ($ch);
        curl_close($ch);
        $output = explode("\n", $response);

        $bearer_token = '';
        foreach($output as $line) {
            if ($line !== false) {
                $bearer_token = $line;
            }
        }

        $bearer_token = json_decode($bearer_token);
        if (is_null($bearer_token)) {
          return 0;
        } else {
          $bearer_token = $bearer_token->{'access_token'};
          // Do the API request
          $url = "https://api.twitter.com/1.1/users/show.json";
          $formed_url = '?screen_name='.$twitter_user;
          $headers = array(
                  "Host: api.twitter.com",
                  "User-Agent: Twitter Application-only OAuth App",
                  "Authorization: Bearer " . $bearer_token,
          );
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url . $formed_url);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($ch);
          curl_close($ch);
  				$response = json_decode($response);
          return $response->followers_count;
        }
  }
}
