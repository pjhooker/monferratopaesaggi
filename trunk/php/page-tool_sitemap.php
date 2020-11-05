<?php

// Include the wp-load'er
include('../wp-load.php');

?>
<?php
/*
 * Template Name: Crea SITEMAP
 */
?>
<?php


//crea JSON
$myFile = "../sitemapnew.xml";
$fh = fopen($myFile, 'w') or die("can't open file");


$stringData = '<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

';
fwrite($fh, $stringData);

//POI
$count_poi=0;
$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 52, post_status => 'publish'));
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();

    $plink=get_permalink();
    $postid = get_the_ID();
    

    $tipo = get_field('field_53524fd43715d');
    if ($tipo=='blue'){}
    else if ($tipo=='parcheggio'){}
    else if ($tipo=='info'){}
    else if ($tipo=='fontana'){}
    else if ($tipo=='wc'){}
    else {
        $count_poi++;
        $stringData = '<url>
          <loc>'.$plink.'</loc>
          <changefreq>weekly</changefreq>
        </url>
        ';
        fwrite($fh, $stringData);
    }

endwhile;
// Reset Post Data
wp_reset_postdata();
//POI END

//TRATTA
$count_tratta=0;
$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 69, post_status => 'publish'));
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();

    $plink=get_permalink();
    $postid = get_the_ID();
    

        $count_tratta++;
        $stringData = '<url>
          <loc>'.$plink.'</loc>
          <changefreq>weekly</changefreq>
        </url>
        ';
        fwrite($fh, $stringData);


endwhile;
// Reset Post Data
wp_reset_postdata();
//TRATTA END

//PAGE
$count_page=0;
$the_query = new WP_Query(array('posts_per_page' => -1, 'post_type' => 'page', post_status => 'publish'));
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();



    $plink=get_permalink();
    $postid = get_the_ID();
    $inserisci = get_field('inserisci');
    if ($inserisci==0){}
    else{
        $count_page++;
        $stringData = '<url>
          <loc>'.$plink.'</loc>
          <changefreq>weekly</changefreq>
        </url>
        ';
        fwrite($fh, $stringData);
    }

endwhile;
// Reset Post Data
wp_reset_postdata();
//PAGE END

//PORTFOLIO
$count_portfolio=0;
$the_query = new WP_Query(array('posts_per_page' => -1, 'post_type' => 'portfolio', post_status => 'publish'));
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();



    $plink=get_permalink();
    $postid = get_the_ID();

        $count_portfolio++;
        $stringData = '<url>
          <loc>'.$plink.'</loc>
          <changefreq>weekly</changefreq>
        </url>
        ';
        fwrite($fh, $stringData);

    
endwhile;
// Reset Post Data
wp_reset_postdata();
//PORTFOLIO END

$stringData = '</urlset>';
fwrite($fh, $stringData);
fclose($fh);
?>
<!-- Custom styles for this template -->
<link href="http://getbootstrap.com/examples/blog/blog.css" rel="stylesheet">
<!-- EXTRA START -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                Sitemap creata con <?php echo $count_poi; ?> articoli, <?php echo $count_page; ?> pagine, <?php echo $count_portfolio; ?> comuni, <?php echo $count_tratta;?> tratte
                </div>
                <div class="panel-body">    
                </div>
            </div>
        </div>
    </div> 
