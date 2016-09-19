This Widget Class to Filter Posts by Categories , Post types , Post-per-page 

Just include it in Functions.php ,
To Design The Layout in front end 
just make your markup 

in widget function 
			if ( $query->have_posts() ) :

				while ( $query->have_posts() ) : $query->the_post();

                    the_title( '<h2>', '</h2>', true );
                    the_excerpt();
                    the_category( );

                    
					
				endwhile;

			endif;
inside the loop			
i hope that be useful

