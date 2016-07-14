<?php
/*
Template Name: Event Style 2 (UPCOMING)
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
   <div class="ev1page clearfix">
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
    $ev_venue       = get_post_meta($post->ID, 'event_venue', true);
    $custom         = get_post_custom($post->ID);
    $event_ticket   = $custom["event_ticket"][0];
    $image_id       = get_post_thumbnail_id();
    $ev_text        = get_post_meta($post->ID, "ev_text", true);
    $cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
    $cover          = wp_get_attachment_image_src($image_id, 'event-style2');
    $no_cover       = get_template_directory_uri();
	$event_allday   = get_post_meta($post->ID, "event_allday", true, true);
    echo '
         <div class="home-width">
            <div class="ev2page-col">       
               <div class="ev2page-data">
                  <div class="ev2page-day">' . $pretty_date_d . '</div>
                  <div class="ev2page-month">' . $pretty_date_M . '</div>
                  <div class="ev2page-year">' . $pretty_date_yy . '</div>
               </div><!-- end .ev2page-data -->                
               <div class="ev2page-cover">';
    echo ' 
                  <div class="wz-wrap wz-hover">';
    if ($image_id) {
        echo '
                     <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
    } else {
        echo '
                     <img src="' . $no_cover . '/images/no-cover/event-2arc.png" alt="no image" />';
    }
    echo '	
                     <div class="he-view">
                        <div class="bg a1" data-animate="fadeIn">
                           <a href="' . get_permalink() . '" class="ev2page-link a2" data-animate="zoomIn"></a>
                           <a href="' . $cover_large[0] . '" class="ev2page-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>						
						</div>
                     </div>	
                  </div>		
               </div><!-- end .ev2page-cover -->
       
               <h2 class="ev2page-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
               <div class="ev2page-info">';					  
	if ($event_allday == 'yes') {            
            echo '
                  <div class="ev2page-hour">All Day</div>';
    } elseif ($tstart != null) {
            echo '
                  <div class="ev2page-hour">' . $tstart . '';
            if ($tend != null) {
                echo ' - ';
            }
            echo '' . $tend . '</div>';
    }
	if ($ev_venue != null) {	
		echo '	
                  <div class="ev2page-venue">' . $ev_venue . '</div>';  
	}	
    echo '
               </div><!-- end .ev2page-info -->';
    echo 
               '<p>' . the_excerpt_max(165) . '</p>';  
if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
    if ($ev_text) { 
        echo '
               <div class="ev2page-tickets"><a href="' . $event_ticket . '" target="_blank">' . $ev_text . '</a></div>';      
    } else {      
        if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
            echo '
               <div class="ev2page-cancel">Sold Out</div>';
        } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
            echo '
               <div class="ev2page-cancel">Canceled</div>';
        } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
            echo '
               <div class="ev2page-cancel">Free Entry</div>';
        } else {
            echo '
               <div class="ev2page-tickets"><a href="' . $event_ticket . '" >Buy Tickets</a></div>';
        }
    }
}
    echo '      
               <div class="ev2page-week">' . $pretty_date_w . '</div>
            </div><!-- end .ev2page-col -->
         </div><!-- end .home-width -->';
		 
	endwhile;

else :
echo '<h4>Sorry, no events coming up.</h4>';
endif;
echo '
   </div><!-- end .ev1page clearfix -->
   <div class="ev3page-past clearfix">
      <div class="title-head"><h1>Past Events</h1></div>';
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
    $tstart         = get_post_meta($post->ID, 'event_tstart', true);
    $tend           = get_post_meta($post->ID, 'event_tend', true);
    $ev_venue       = get_post_meta($post->ID, 'event_venue', true);
    $custom         = get_post_custom($post->ID);
    $event_ticket   = $custom["event_ticket"][0];
    $image_id       = get_post_thumbnail_id();
    $ev_text        = get_post_meta($post->ID, "ev_text", true);
    $cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
    $cover          = wp_get_attachment_image_src($image_id, 'event-style2');
    $no_cover       = get_template_directory_uri();
	$event_allday   = get_post_meta($post->ID, "event_allday", true, true);
    echo '
         <div class="home-width">
            <div class="ev2page-col">       
               <div class="ev2page-data">
                  <div class="ev2page-day">' . $pretty_date_d . '</div>
                  <div class="ev2page-month">' . $pretty_date_M . '</div>
                  <div class="ev2page-year">' . $pretty_date_yy . '</div>
               </div><!-- end .ev2page-data -->                
               <div class="ev2page-cover">';
    echo ' 
                  <div class="wz-wrap wz-hover">';
    if ($image_id) {
        echo '
                     <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
    } else {
        echo '
                     <img src="' . $no_cover . '/images/no-cover/event-2arc.png" alt="no image" />';
    }
    echo '	
                     <div class="he-view">
                        <div class="bg a1" data-animate="fadeIn">
                           <a href="' . get_permalink() . '" class="ev2page-link a2" data-animate="zoomIn"></a>
                           <a href="' . $cover_large[0] . '" class="ev2page-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>						
						</div>
                     </div>	
                  </div>		
               </div><!-- end .ev2page-cover -->
       
               <h2 class="ev2page-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
               <div class="ev2page-info">';					  
	if ($event_allday == 'yes') {            
            echo '
                  <div class="ev2page-hour">All Day</div>';
    } elseif ($tstart != null) {
            echo '
                  <div class="ev2page-hour">' . $tstart . '';
            if ($tend != null) {
                echo ' - ';
            }
            echo '' . $tend . '</div>';
    }
	if ($ev_venue != null) {	
		echo '	
                  <div class="ev2page-venue">' . $ev_venue . '</div>';  
	}	
    echo '
               </div><!-- end .ev2page-info -->';
    echo 
               '<p>' . the_excerpt_max(165) . '</p>';  
if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
    if ($ev_text) { 
        echo '
               <div class="ev2page-tickets"><a href="' . $event_ticket . '" target="_blank">' . $ev_text . '</a></div>';      
    } else {      
        if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
            echo '
               <div class="ev2page-cancel">Sold Out</div>';
        } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
            echo '
               <div class="ev2page-cancel">Canceled</div>';
        } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
            echo '
               <div class="ev2page-cancel">Free Entry</div>';
        } else {
            echo '
               <div class="ev2page-tickets"><a href="' . $event_ticket . '" >Buy Tickets</a></div>';
        }
    }
}
    echo '      
               <div class="ev2page-week">' . $pretty_date_w . '</div>
            </div><!-- end .ev2page-col -->
         </div><!-- end .home-width -->';
		 
	endwhile;

else :
echo '<h4>Sorry, no events past.</h4>';
endif;
echo '
      </div><!-- end .ev3page-past clearfix -->
   </div><!-- end .col -->';

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