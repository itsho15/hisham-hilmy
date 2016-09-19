<?php

class LoopByCategory extends WP_Widget {
    
    function __construct() {
        

        $widget_ops = array(
			'classname'   => __('Prolearner_loop_by_category','prolearner'),
			'description' => __('Loop Posts By Category','prolearner'),

			);

		parent::__construct('Prolearner_loop','prolearner Loop' , $widget_ops);
    }
    
    public function form( $instance ) {
        
        $title   			= "";
        $singleCat 			= "";
        $multiCat 			= "";
        $posts_per_page 	= "";
        $postType           = "";
        $terms  = get_terms('category','orderby=count&hide_empty=1');
        $sortlist = array(
        	'none',
			'author',
			'title',
			'name',
			'date', 
			'modified', 
			'rand',
			'comment_count', 
			'menu_order',
        );
        $sort              = "";
        $order 			   = "";
        
        if ( !empty( $instance[ 'multi_category' ] ) ) {
        	$multiCat   = $instance[ 'multi_category' ];
        }

        if ( !empty( $instance[ 'title' ] ) ) {
        	$title   = $instance[ 'title' ];
        }
        if ( !empty( $instance[ 'single_category' ] ) ) {
        	$singleCat   = $instance[ 'single_category' ];
        }
        if ( !empty( $instance[ 'post_page_number' ] ) ) {
        	$posts_per_page   = $instance[ 'post_page_number' ];
        }
        if ( !empty( $instance[ 'postType' ] ) ) {
        	$postType   = $instance[ 'postType' ];
        }
        if ( !empty( $instance[ 'sort' ] ) ) {
        	$sort   = $instance[ 'sort' ];
        }
        if ( !empty( $instance[ 'order' ] ) ) {
        	$order   = $instance[ 'order' ];
        }


       
		 /*
		 ==========================
		  Get Categories
		 ==========================

		 */
		
        
?>
		<div class="widget-box">
			<?php /* ========================== Title ========================== */ ?>

		    <label class="widget-head" for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title :', 'prolearner' ); ?></label> 
		    <input 
		           class="widefat" 
		           id="<?php echo $this->get_field_id( 'title' ); ?>" 
		           name="<?php echo $this->get_field_name( 'title' ); ?>" 
		           type="text" 
		           value="<?php echo esc_attr( $title ); ?>"
		           />

            <?php /* ========================== Single Category ========================== */ ?>

		    <label class="widget-head" for="<?php echo $this->get_field_id( 'single_category' ); ?>"><?php _e( 'Single Categories:', 'prolearner' ); ?></label> 
           
            
		    <select name="<?php echo $this->get_field_name( 'single_category' ); ?>">
		       <option value="" > All Categories </option>
		      <?php foreach ($terms as $term ) :?>

		        <option  

		        value="<?php echo $term->term_id ?>" 
		        <?php if( $term->term_id == esc_attr( $singleCat )  ) echo "selected"; ?> > 
		        <?php echo $term->name ?>
		        	
		        </option>
		          
		      <?php endforeach; ?>

		    </select></br>
		    <small>A single category filter. If you want to filter multiple categories, use the 'Multiple categories filter' and leave this to default</small> 

		     <?php /* ========================== Multi Category ========================== */ ?>
		    
            <label class="widget-head" for="<?php echo $this->get_field_id( 'multi_category' ); ?>"><?php _e( 'Multi Categories:', 'prolearner' ); ?></label> 
            <input 
		           class="widefat" 
		           id="<?php echo $this->get_field_id( 'multi_category' ); ?>" 
		           name="<?php echo $this->get_field_name( 'multi_category' ); ?>" 
		           type="text" 
		           value="<?php echo esc_attr( $multiCat ); ?>"
		           />
		    <small>
		   multiple categories by ID. Enter here the category IDs separated by commas (ex: 13,23,18). To exclude categories from this block add them with '-' (ex: -9, -10)
		     </small>

             <?php /* ========================== Post Per Page ========================== */ ?>

		    <label class="widget-head" for="<?php echo $this->get_field_id( 'post_page_number' ); ?>"><?php _e( 'Posts Per Page:', 'prolearner' ); ?></label> 
            <input 
		           class="widefat" 
		           id="<?php echo $this->get_field_id( 'post_page_number' ); ?>" 
		           name="<?php echo $this->get_field_name( 'post_page_number' ); ?>" 
		           type="number" 
		           value="<?php echo esc_attr( $posts_per_page ); ?>"
		           /> 
		            
		     <?php /* ========================== Post Types ========================== */ ?>
		    <label class="widget-head" for="<?php echo $this->get_field_id( 'postType' ); ?>"><?php _e( 'Post Type:', 'prolearner' ); ?></label> 
            <input 
		           class="widefat" 
		           id="<?php echo $this->get_field_id( 'postType' ); ?>" 
		           name="<?php echo $this->get_field_name( 'postType' ); ?>" 
		           type="text" 
		           value="<?php echo esc_attr( $postType ); ?>"
		           />
		    <small>
		    Filter by post types. Usage: post, page, event - Write 1 or more post types delimited by commas
		    </small>

            <?php /* ========================== DESC / ASC ========================== */ ?>

		    <label class="widget-head" for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order  :', 'prolearner' ); ?></label> 
           
            
		    <select name="<?php echo $this->get_field_name( 'order' ); ?>">
		        <option  

		        value="DESC" 
		        <?php if( "DESC" == esc_attr( $order )  ) echo "selected"; ?> > 
		        <?php echo "Descending" ?>
		        	
		        </option>

		        <option  

		        value="ASC" 
		        <?php if( "ASC" == esc_attr( $order )  ) echo "selected"; ?> > 
		        <?php echo "Ascending" ?>
	
		        </option>

		        
		          
		    </select></br>
		    <small>Designates the ascending or descending order of the 'orderby' parameter. Defaults to 'DESC'. An array can be used for multiple order/orderby sets.
'ASC' - ascending order from lowest to highest values (1, 2, 3; a, b, c).
'DESC' - descending order from highest to lowest values (3, 2, 1; c, b, a). Default is (Descending) </small> 

            <?php /* ========================== Sorting ========================== */ ?>

		    <label class="widget-head" for="<?php echo $this->get_field_id( 'sort' ); ?>"><?php _e( 'Sort By :', 'prolearner' ); ?></label> 
           
            
		    <select name="<?php echo $this->get_field_name( 'sort' ); ?>">
		       
		      <?php foreach ($sortlist as $sortest ) :?>

		        <option  

		        value="<?php echo $sortest ?>" 
		        <?php if( $sortest == esc_attr( $sort )  ) echo "selected"; ?> > 
		        <?php echo $sortest ?>
		        	
		        </option>
		          
		      <?php endforeach; ?>

		    </select></br>
		    <small>sort the posts.</small>                    
   
		</div><!-- .widget-box -->  
<?php  
   
    }
    
    public function widget( $args, $instance) {
        
        $titleFrontend     = apply_filters( 'widget_title',$instance['title'] );
        $multi_category    = apply_filters( 'widget_Multi_category', $instance['multi_category']  );
        $single_category   = apply_filters( 'widget_single_category', $instance['single_category']  );
        $post_page_num     = apply_filters( 'widget_page_category', $instance['post_page_number']  );
        $post_type     	   = apply_filters( 'widget_post_Type', $instance['postType']  );
        $sorting     	   = apply_filters( 'widget_sorting', $instance['sort']  );
        $order       	   = apply_filters( 'widget_order', $instance['order']  );
       

        // Get Data into array with explode function
        $include_category   = explode(',', $multi_category);

        $exclude_category   = explode('-', $multi_category);
        // include Post Types
        $include_postType   = explode(',', $post_type);

        if (!empty($instance)) {
            $output  = "";    
            $output .= '<div class="img-block">';
        
            $output .= (!empty($titleFrontend) ? $titleFrontend : '');

            $output .= '</div>'; 
            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			$args = array(
			            
			    
			    //Choose ^ 'any' or from below, since 'any' cannot be in an array
			    
			    
			    'post_status' => array(
			      'publish' 
			      ),
			    
			    //Order & Orderby Parameters
			    'order'               => $order,
			    'orderby'             => $sorting,
			    
			        //Taxonomy Parameters
	            'posts_per_page' => $post_page_num,
	            'post_type'      => $include_postType,

	            'paged' => $paged,
	            'category' => 80,
	            'category__in'   =>$single_category ,
	            'include_children' =>0,
	            'cat'   => $include_category,
			    'category__not_in' => $exclude_category,
			    'cache_results'          => true,
			    'update_post_term_cache' => true,
			    'update_post_meta_cache' => true,   

		    );
			        
			$query = new WP_Query( $args ); 

			if ( $query->have_posts() ) :

				while ( $query->have_posts() ) : $query->the_post();

                    the_title( '<h2>', '</h2>', true );
                    the_excerpt();
                    the_category( );

                    
					
				endwhile;

			endif;
   
        }
    
    }
        
    public function update( $new_instance, $old_instance ) {
        $output = array();
        $output['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        $output['multi_category'] = ( ! empty( $new_instance['multi_category'] ) ) ? strip_tags( $new_instance['multi_category'] ) : '';

        $output['single_category'] = ( ! empty( $new_instance['single_category'] ) ) ? strip_tags( $new_instance['single_category'] ) : '';

        $output['post_page_number'] = ( ! empty( $new_instance['post_page_number'] ) ) ? strip_tags( $new_instance['post_page_number'] ) : '';

        $output['postType'] = ( ! empty( $new_instance['postType'] ) ) ? strip_tags( $new_instance['postType'] ) : '';

        $output['sort'] = ( ! empty( $new_instance['sort'] ) ) ? strip_tags( $new_instance['sort'] ) : '';
        $output['order'] = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';

        return $output;
        }
    } 
    
    function LoadLoopByCategory() {
        register_widget( 'LoopByCategory' );
    }
add_action( 'widgets_init', 'LoadLoopByCategory' );