<div class="container">
    <div class="row">
        <div class="box" style="border-radius:10 px;">
            <div class="col-lg-12">
            <hr>
			<h2 class="intro-text text-center"><strong> Anillos </strong></h2>
			<hr>
            </div><br></br>
        </div>
    </div>
</div>
<div class="container pb-6 pt-6">
    <?php
    
        require_once "accionPagina.php";
        

        if(!isset($_GET['page'])){
            $pagina=1;
        }else{
            $pagina=(int) $_GET['page'];
            if($pagina<=1){
                $pagina=1;
            }
        }

        $categoria_id = (isset($_GET['category_id'])) ? $_GET['category_id'] : 0;

        $pagina=limpiar_cadena($pagina);
        $url="tienda3.php?vista=ring&page="; 
        $registros=6;
        $busqueda="";

        //Paginador producto 
        require_once "php/anillo.php";
    ?>
    <script> src = "..\..\bootstrap\js\min.js" </script>   
</div>