This Widget Class For Wordpress to Filter Posts by Categories , Post types , Post-per-page 

Just include it in Functions.php ,
To Design The Layout in front end 
just make your markup 

in widget function ,
			
	$args = array(
	     
	    'post_status' => array(
	      'publish' 
	      ),
		    
	    //Order & Orderby Parameters
	    'order'               => $order,
	    'orderby'             => $sorting,
	    
	    
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
inside the loop			
i hope that be useful

