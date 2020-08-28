<?php 

    require_once __DIR__ . '/../vendor/autoload.php';
    
    $app = new Silex\Application();
    $app['debug'] = true;
    
 
    
    $app['rotas'] = $app->share(function (){
      return $array = array
       (
           1 => array('titulo'=> 'linux', 'post'=>'Sistema operacional open sorce desenvolvido com ajuda da comunidade.'),
           2 => array('titulo'=> 'mac',   'post'=>'Sistema operacional desenvolvido pela Apple.'),
           3 => array('titulo'=> 'Windows', 'post'=>'Sistema operacional desenvolvido pela Microsoft.')
       ); 
    });
    
    $blogPosts = $app['rotas'];
    
    $app->get('/blog', function () use ($blogPosts){
       
        $imprimir = '';
        
        foreach ($blogPosts as $post)
        {
            $imprimir .= $post['titulo'];
            $imprimir .= '<br />';

        }
        
        return $imprimir;
        
    });
    
    $app->get('/blog/{id}', function (Silex\Application $app, $id) use ($blogPosts){
        if(!isset($blogPosts[$id]))
        {
           $app->abort(404, "Post inexistente,");
        }
        
        $post = $blogPosts[$id];
        
        return "<h3>" . $post['titulo'] . "</h3>" .
                "<p>" . $post['post'] . "</p>";
    });
    
    $app->run();


