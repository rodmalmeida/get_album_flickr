<?php 
		
		$albumId = get_field("id_galeria");

		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
				),
			);

		$urlJson = 'https://api.flickr.com/services/rest/?&method=flickr.photosets.getPhotos&api_key=13e2d5b17ed7e1e56a39b82876c4b5f2&photoset_id='.$albumId.'&extras=description&format=json&jsoncallback=?';

		$conteudo = file_get_contents($urlJson, false, stream_context_create($arrContextOptions));	
		$data = str_replace( 'jsonFlickrApi(', '', $conteudo );
					$data = substr( $data, 0, strlen( $data ) - 1 ); //strip out last paren
					$dados = json_decode($data, TRUE); 

		$fotos = $dados['photoset']['photo'];
			//$photof = $dados->photoset->photo; //navega pelos elementos do array, imprimindo cada empregado 

 ?>

 <h1 class="center"><?php echo($dados['photoset']['title']) ?></h1>

 <span class="voltar-site"><a href="javascript:history.go(-1)">Voltar ao site</a></span>

<p class="prev-next center">
	<a href="#" class="cycle-prev"><span>&laquo; Anterior</span></a> &nbsp;&nbsp; |&nbsp;&nbsp; <a href="#" class="cycle-next"><span>Próxima &raquo;</span></a>
</p>

 <div id="galeriaPrincipal">
 	<div id="cycle-1" class="cycle-slideshow" data-cycle-slides="> a" data-cycle-timeout="0">
	   <?php //string json (array contendo 3 elementos) 
	   foreach ( $fotos as $f ) 
	   { 	
	   	$fotoUrl = 'http://farm'.$f['farm'].'.static.flickr.com/'.$f['server'].'/'.$f['id'].'_'.$f['secret'].'_b.jpg';
	   	echo '<a href="'.$fotoUrl.'" class="light-gallery">';
	   	echo '<img data-aload="'.$fotoUrl.'">';
	   	echo '</a>';
	   }
	   ?>


	</div> <!-- Cycle Slideshow -->
</div>
<!-- /#galeriaPrincipal -->

<div id="cycle-2" class="cycle-slideshow" data-cycle-slides="> div" data-cycle-timeout="0" data-cycle-prev=".cycle-prev" data-cycle-next=".cycle-next" data-cycle-caption=".custom-caption" data-cycle-caption-template="Foto {{slideNum}} de {{slideCount}}" data-cycle-fx="carousel" data-cycle-carousel-visible="15" data-cycle-carousel-fluid=true data-allow-wrap="false" style="height: 100px;" >
        <?php 
        foreach ( $fotos as $p ) 
			{ 	


				$fotoUrlp = 'http://farm'.$p['farm'].'.static.flickr.com/'.$p['server'].'/'.$p['id'].'_'.$p['secret'].'_b.jpg';

				echo '<div class="pager">	<img data-aload="'.$fotoUrlp.'"></div>';


			}
         ?>
    </div>

<div id="cycle-3" class="cycle-slideshow cycle-3" data-cycle-slides="> div"
data-cycle-timeout="0">

	<?php 
	foreach ( $fotos as $c ) 
	{ 	
		echo '<div class="infos"> <h3>'.$c['title'].'</h3> <p>'.nl2br($c['description']['_content']).'</p> </div>';
	}
	?>
	
</div>
<!-- /.cycle-3 -->
