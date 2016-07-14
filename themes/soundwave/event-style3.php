<?php
/*
Template Name: Event Style 3 (UPCOMING)
*/
?>

<?php get_header(); ?>

<div id="content">

<?php
$page_layout = sidebar_layout();
switch ($page_layout) {
    case "layout-sidebar-left":
        echo '
   <div class="col-right-media">';
        break;
    case "layout-sidebar-right":
        echo '
   <div class="col-left-media">';
        break; 
    case "layout-full":
        echo '
   <div class="title-head"><h1>Please select left or right from  "Sidebar layout settings" of this page.</h1></div>';
        break;
}
echo '
      <div class="ev2page clearfix">
         <div class="title-head"><h1>Upcoming Events</h1></div>';
$term     = get_queried_object()->slug;
$query    = array(
    'post_type' => 'event',
    'orderby' => 'meta_value',
	'order' => 'asc',
	'posts_per_page' => 10,
	'meta_value' => strftime("%Y/%m/%d", time()- (60 * 60 * 24) ),
	'meta_key' => 'event_date_interval',
	'meta_compare' => '>',
    'taxonomy' => 'events',
	'term' => $term
);
$wp_query = new WP_Query($query);
$results = $wp_query->post_count;
if ($results != ''):
    while ($wp_query->have_posts()):
    $wp_query->the_post();
    global $post;
        setup_postdata($post);
        $results        = $wp_query->post_count;
        $data_event     = get_post_meta($post->ID, 'event_date_interval', true);
        $time           = strtotime($data_event);
        $pretty_date_yy = date('Y', $time);
        $pretty_date_d  = date('d', $time);
		require('includes/language.php');
        $tstart         = get_post_meta($post->ID, 'event_tstart', true);
        $tend           = get_post_meta($post->ID, 'event_tend', true);
        $ev_venue       = get_post_meta($post->ID, "event_venue", true);
        $custom         = get_post_custom($post->ID);
        $event_ticket   = $custom["event_ticket"][0];
        $image_id       = get_post_thumbnail_id();
        $cover          = wp_get_attachment_image_src($image_id, 'event-cover-arc');
        $ev_text        = get_post_meta($post->ID, "ev_text", true);
		$event_allday   = get_post_meta($post->ID, "event_allday", true, true);
        echo '
         <div class="ev3page">
            <div class="ev3page-data">
               <div class="ev3page-day">' . $pretty_date_d . ' ' . $pretty_date_M . '</div>
               <div class="ev3page-year">' . $pretty_date_yy . '</div>
            </div><!-- end .ev3page-data -->
            <div class="event-arc-text">';     
	if (get_post_meta($post->ID, 'event_disable', true) == 'no') {		
        if ($ev_text) { 
            echo '
               <div class="ev3page-tickets"><a href="' . $event_ticket . '" target="_blank">' . $ev_text . '</a></div>'; 
        } else {
            if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
                echo '
               <div class="ev3page-cancel">Sold Out</div>';  
            } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
                echo '
               <div class="ev3page-cancel">Canceled</div>';  
            } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
                echo '
               <div class="ev3page-cancel">Free Entry</div>';   
            } else {
                echo '
               <div class="ev3page-tickets"><a href="' . $event_ticket . '" >Buy Tickets</a></div>';
            }
        }  
	}
        echo '
               <h2 class="ev3page-title"><a href="' . get_permalink() . '">';    
        if (strlen($post->post_title) > 38) {
            echo substr(the_title($before = '', $after = '', FALSE), 0, 38) . '...';
        } else {
            the_title();
        }
        echo '</a></h2>
               <div class="ev3page-info">'; 
        if ($ev_venue != null) {  
            echo '
                  <div class="ev3page-venue">' . $ev_venue . '</div>';
        }
		if ($event_allday == 'yes') {            
            echo '
                 <div class="ev3page-hour">All Day</div>';
		} elseif ($tstart != null) {
            echo '
                  <div class="ev3page-hour">' . $tstart . '';
				if ($tend != null) {
                echo ' - ';
            }
            echo '' . $tend . '</div>';
		}
        echo '	  
               </div><!-- end .ev3page-info -->
               <div class="ev3page-week">' . $pretty_date_w . '</div>
            </div><!-- end .event-arc-text -->
         </div><!-- end .ev3page -->';
		 
	endwhile;

else :
echo '<h4>Sorry, no events coming up.</h4>';
endif;
echo '
      </div><!-- end .ev2page clearfix -->
      <div class="ev3page-past">
         <div class="title-head"><h1>Past Events</h1></div>';
// Build a custom query to get posts from future dates.
$query    = array(
    'post_type' => 'event',
    'orderby' => 'meta_value',
	'order' => 'desc',
	'posts_per_page' => 10,
	'meta_value' => strftime("%Y/%m/%d", time()- (60 * 60 * 24) ),
	'meta_key' => 'event_date_interval',
	'meta_compare' => '<',
    'taxonomy' => 'events',
	'term' => $term
);
$wp_query = new WP_Query($query);
$results = $wp_query->post_count;
if ($results != ''):
    while ($wp_query->have_posts()):
    $wp_query->the_post();
    global $post;
        setup_postdata($post);
        $results        = $wp_query->post_count;
        $data_event     = get_post_meta($post->ID, 'event_date_interval', true);
        $time           = strtotime($data_event);
        $pretty_date_yy = date('Y', $time);
        $pretty_date_d  = date('d', $time);
		require('includes/language.php');
        $ev_venue       = get_post_meta($post->ID, "event_venue", true);
        $tstart         = get_post_meta($post->ID, 'event_tstart', true);
        $tend           = get_post_meta($post->ID, 'event_tend', true);
        $venue          = get_post_meta($post->ID, 'event_venue', true);
        $custom         = get_post_custom($post->ID);
        $event_ticket   = $custom["event_ticket"][0];
        $image_id       = get_post_thumbnail_id();
        $cover          = wp_get_attachment_image_src($image_id, 'event-cover-arc');
		$ev_text        = get_post_meta($post->ID, "ev_text", true);
		$event_allday   = get_post_meta($post->ID, "event_allday", true, true);
        echo '
         <div class="ev3page">     
            <div class="ev3page-data">
               <div class="ev3page-day">' . $pretty_date_d . ' ' . $pretty_date_M . '</div>
               <div class="ev3page-year">' . $pretty_date_yy . '</div>
            </div><!-- end .ev3page-data -->                
            <div class="event-arc-text">';
	if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
        if ($ev_text) { 
            echo '
               <div class="ev3page-tickets"><a href="' . $event_ticket . '" target="_blank">' . $ev_text . '</a></div>'; 
        } else {
            if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
                echo '
               <div class="ev3page-cancel">Sold Out</div>';   
            } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
                echo '
               <div class="ev3page-cancel">Canceled</div>';  
            } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
                echo '
               <div class="ev3page-cancel">Free Entry</div>';
            } else {
                echo '
               <div class="ev3page-tickets"><a href="' . $event_ticket . '" >Buy Tickets</a></div>';
            }
        }
	}
        echo '
               <h2 class="ev3page-title"><a href="' . get_permalink() . '">';
        if (strlen($post->post_title) > 38) {
            echo substr(the_title($before = '', $after = '', FALSE), 0, 38) . '...';
        } else {
            the_title();
        }
        echo '</a></h2>
               <div class="ev3page-info">';     
        if ($ev_venue != null) {     
            echo '
                  <div class="ev3page-venue">' . $ev_venue . '</div>';
        }
		if ($event_allday == 'yes') {            
            echo '
                 <div class="ev3page-hour">All Day</div>';
		} elseif ($tstart != null) {
            echo '
                  <div class="ev3page-hour">' . $tstart . '';
				if ($tend != null) {
                echo ' - ';
            }
            echo '' . $tend . '</div>';
		}
        echo '	  
               </div><!-- end .ev3page-info -->';
        echo '
               <div class="ev3page-week">' . $pretty_date_w . '</div>
            </div><!-- end .event-arc-text -->
         </div><!-- end .ev3page -->';
		 
	endwhile;

else :
echo '<h4>Sorry, no events past.</h4>';
endif;

echo '
      </div><!-- end .ev3page-past -->
   </div><!-- end .col -->
	';
switch ($page_layout) {
    case "layout-sidebar-left":
        echo '
   <div class="sidebar-left">';
        wz_setSection('zone-sidebar');
        if (is_active_sidebar('sidebar-event-archive')) {
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-event-archive'));
        } else {
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        }
        echo '
   </div><!-- end .sidebar-left -->';
        break;
    case "layout-sidebar-right":
        echo '
   <div class="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (is_active_sidebar('sidebar-event-archive')) {
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-event-archive'));
        } else {
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        }
        echo '
   </div><!-- end .sidebar-right -->';
        break;     
}
?>

</div><!-- end #content -->

<?php get_footer(); ?>