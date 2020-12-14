<?
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


?>

	<div class="wrapper" id="wrapper-productcat">

        <div class="container">
            <div class="row">
            <h1>
            <?php
                foreach((get_the_category()) as $category) { 
                echo $category->cat_name . ' '; 
            } 
            ?>
            </h1>
            <?php
           
            wp_reset_postdata();
            ?>
            </div> <!-- row -->
        </div>  <!-- container -->
	</div>  <!-- wrapper-productcat -->
<?php

?>