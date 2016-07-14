<?php get_header(); ?>

<div id="content">

<?php
global $post;
$location      = str_replace(array(
    strtolower(get_bloginfo('url'))
), '', strtolower(get_permalink()));
$page_layout   = sidebar_layout();
$slidertype = of_get_option('slider_type');
if (strlen($location) > 2) {
    switch ($page_layout) {
        case "layout-sidebar-left":
            echo '	
	<div class="col-right clearfix">			
		<div class="title-page"><h1>' . get_the_title() . '</h1></div>			
			<div class="content-page">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
			</div><!-- end .content-left -->
	</div>';
            echo '
	<div class="sidebar-left">';
            wz_setSection('zone-sidebar');
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
            echo '
	</div><!-- end .sidebar-left -->';
            echo '';
            break;
			
       case "layout-sidebar-right":
            echo '
	<div class="col-left clearfix">				
		<div class="title-page"><h1>' . get_the_title() . '</h1></div>
			<div class="content-page">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
		</div><!-- end .content-right -->
	</div>';
            echo '
	<div class="sidebar-right">';
            wz_setSection('zone-sidebar');
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
            echo '
	</div><!-- end .sidebar-right -->';
            break;		
        case "layout-full":
            echo '
			<div class="title-page"><h1>' . get_the_title() . '</h1></div>
	<div class="content-page-full clearfix">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
	</div><!-- end .single-page-col -->';
            break;
    }
} else {
 
     switch ($page_layout) {
        case "layout-sidebar-left":

switch ($slidertype) {
	case "slider_large":
if (of_get_option('slider_active', '1') == '1') {		
		echo ' '. get_template_part( 'slider' ) . '';	
}
break;
}

echo '
	<div class="col-right-home clearfix">';
switch ($slidertype) {
			case "slider_small":
if (of_get_option('slider_active', '1') == '1') {		
		echo ' '. get_template_part( 'slider' ) . '';	
}
			break;
}	
            if (have_posts())
                while (have_posts()):
                    the_post(); 
                    echo the_content(); 
                endwhile;
            echo '
	</div><!-- end .col-right-home clearfix -->';	           
            echo '
	<div class="sidebar-left">';
            wz_setSection('zone-sidebar');
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
            echo '
	</div><!-- end .sidebar-left -->';
            break;	
			case "layout-sidebar-right":


switch ($slidertype) {
	case "slider_large":
if (of_get_option('slider_active', '1') == '1') {		
		echo ' '. get_template_part( 'slider' ) . '';	
}
break;
}		
         
echo '
<div class="col-left-home clearfix">'; echo '<!-- comentario  elena aqui termina page-->';
	
		
    
switch ($slidertype) {
	case "slider_small":
if (of_get_option('slider_active', '1') == '1') {		
		echo ' '. get_template_part( 'slider' ) . '';	
}
	break;
}		
?>
        
   <div class="col-left-home clearfix">
            <div class="title-home">
                <h3>Noticias Recientes</h3>
            </div>
            
             <div class="home-shr clearfix">
            <div class="home-width">
          
<?php
   $args = array('showposts' => '2',
    'post_type' => 'post'

    );
   $category_posts = new WP_Query($args);
 
   

      if($category_posts->have_posts()) :
      while($category_posts->have_posts()) :
         $category_posts->the_post(); ?>
            <!-- post -->            
      <?php  $image_id = get_post_thumbnail_id($post->ID);
        $cover       = wp_get_attachment_image_src($image_id, 'blog-preview');
        $cover_large = wp_get_attachment_image_src($image_id, 'photo-large');

         ?>

                              <div class="bl1shr-col">
                                <div class="bl1shr-cover">
                                <div class="wz-wrap wz-hover">

                               <?php  echo '<img src="'.$cover[0]. ' " alt=" '. get_the_title(). '" />' ?>
                                <div class="he-view">
                                <div class="bg a0" data-animate="fadeIn">
                                     <a href="<?php the_permalink();?>" class="bl1shr-link a2" data-animate="zoomIn"></a>
                                 <?php  echo ' <a href="'.$cover_large[0]. ' " class="bl1shr-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a> ' ?>  
                                </div>
                                </div>
                                </div>
                                </div>
                                <!-- end .blog-home-cover -->
                                <h2 class="bl1shr-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                                <div class="bl1shr-text">

                                 <p><?php the_excerpt(); ?></p>
                                 
                                </div>
                                <div class="bl1shr-info">
                                <p class="bl1shr-user"><?php the_author(); ?></p>
                                <p class="bl1shr-date"><?php the_date();?></p>
                                <p class="bl1shr-comment"><a href="<?php get_comments_link();?>"><?php comments_number( 'No Comments', '1 Comment', '% Comments' );?></a></p>

                              </div>
                                <!-- end .bl1shr-info -->

                                </div>
                                <!-- end .bl1shr-col -->

                                
                               
                                </div>

<?php endwhile; ?>
            <!-- post navigation -->
            <?php else: ?>
            <!-- no posts found -->
            <?php endif; ?>

        <?php   wp_reset_query(); ?>





               
            
<!-- termina noticias recientes -->

<div class="title-home2">
    <h3>Audios Recientes</h3>
</div>
<div class="home-shr clearfix">
    <div class="adshr-col">
        <div class="home-width">


<?php

$query     = array(
    'post_type' => 'audio',
    'showposts' => '3',
   
    'taxonomy' => 'audios',
   
);
$wp_query  = new WP_Query($query); ?>

<?php if($wp_query->have_posts()) :
      while($wp_query->have_posts()) :
         $wp_query->the_post(); ?>
            <!-- post -->            

<?php 
   $title       = get_the_title();
   
    $image_id    = get_post_thumbnail_id();
    $cover       = wp_get_attachment_image_src($image_id, 'audio-style2');
    $cover_large = wp_get_attachment_image_src($image_id, 'photo-large');
    $custom      = get_post_custom($post->ID);
    $genre       = $custom["audio_genre"][0];
     ?>

            <div class="adshr-fix wz-last">
                <div class="adshr-cover">
                    <div class="wz-wrap wz-hover">
                       <?php echo '
                  <img src="' . $cover[0] . '" alt="' . get_the_title() . '" width="212" height="230"  />'; ?>

                            
                            <div class="he-view">
                            <div class="bg a0" data-animate="fadeIn">
                             <?php echo'
                                <a href="' . get_permalink() . '" class="adpage2-link a2" data-animate="zoomIn"></a>'; ?>
                                                           
                                   
                                                         <!--  <a href="http://localhost/voicemarketingmx/wp-content/uploads/2016/02/logo_cinepolis.jpg" class="adshr-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>-->


                                </div>
                                </div>
                    </div>
                 </div>
                <!-- end .adshr-cover -->
                                <div class="adshr-info">
                               <?php echo'
                                <div class="adshr-title">'.$title.'</div>' ?>
                               <?php echo'
                                <div class="adshr-des">'.$genre.'</div>' ?>
                                </div>
                                &nbsp;

            </div>
            <!-- end .adshr-fix wz-last -->

                           
                                     
<?php endwhile; ?>
            <!-- post navigation -->
            <?php else: ?>
            <!-- no posts found -->
            <?php endif; ?>

        <?php   wp_reset_query(); ?>



  </div>
     <!-- end .adshr-col -->



</div>

</div>
  <!-- end .home-width -->

     </div>
     <!-- end .home-shr clearfix -->


                         
<?php    
	  echo '
    </div>';
            echo '
    <div class="sidebar-right">';
            wz_setSection('zone-sidebar');
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
            echo '
    </div><!-- end .sidebar-right -->';

            break;
        case "layout-full":     
switch ($slidertype) {
    case "slider_large":
if (of_get_option('slider_active', '1') == '1') {       
        echo ' '. get_template_part( 'slider' ) . '';   
}
    break;
}   
            echo '
    <div class="content-page-full clearfix">';
            if (have_posts())
                while (have_posts()):
                    the_post(); 
                    echo the_content();
                endwhile;
            echo '
    </div><!-- end .content-home-right -->';
    }
}
?>



</div>


<?php get_footer(); ?>