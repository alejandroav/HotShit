<!DOCTYPE html>
 <html>
  <head>	
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		
   <meta charset="utf-8"/>

   <title> HotShit </title>
   <script src="js/jquery-2.1.4.min">
   </script>
		
   <script src="js/materialize.min.js"></script>
		
   <link rel="stylesheet" href="css/materialize.min.css"/>
	
   <style>
     div.video1{padding:20px;}
     div.video2{float:left;margin-left:100px;}
   </style>

  </head>

  <body style="background-color:#FBFBFB">

  <?php
    function Video(){
        echo "<ul>";
      for ($x = 0; $x <= 9; $x++) {
        echo "<il><div class='video1'>
      <img src='http://static.elobservador.com.uy/adjuntos/184/imagenes/000/298/0000298815.png' alt='Usuario'  width='310px' height='206px'>
    </div>
    <div class='video2'>
      <p><b> Titulo muy largo </b></p>
    </div></il>";
     }
     echo "</ul>";
   }
  



 ?>

   <nav>
    <div class="nav-wrapper" style="background-color:#FBFF93">
      <a href="#" class="brand-logo" style="color:black;margin-left:15px">WeZee</a>
	<ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><div class="chip">
            <img src="https://image.freepik.com/iconos-gratis/silueta-usuario-masculino_318-35708.jpg" alt="Contact Person">HotShit
          </div></li>
          <li><div style="margin-right:335px"></div>
          </div></li>
       </ul>	
  </nav>
 

  <div>
   <center>
    <div style="padding:10px"></div>
    <a href="#" class="waves-effect waves-light btn" style="background-color:#AEAEAE"><i class="material-icons left">Subir Video</i></a>
    <div style="padding:10px"></div>
   </center>
  </div>


  <div class="z-depth-2" style="padding:20px;float:left;border:1px solid black">
   <div style="border:1px solid black">
   <img src="https://image.freepik.com/iconos-gratis/perfil-de-usuario-con-el-nino-pequeno-corazon_318-41313.png" alt="Usuario"  width=130 height=130>
   </div>
   <div style="padding:10px">
   </div>
   <div style="background-color:#F9FE6F;padding:10px">
     <center><p style="font-size:120%"><b>Estadisticas</b></p></center>
     <div class="divider"></div>
     <p>100 <span style="color:green">Me gustas</span></p>
     <p>100 <span style="color:green">Reproducciones</span></p>
   </div>
  </div>
  

  <div style="float:left; padding:15px"></div> 
 

  <div class="z-depth-2" style="border:1px solid black; float:left;"><?php Video() ?></div>


  <div style="float:left; padding:15px"></div>  


  <div class="z-depth-2" style="border:1px solid black; float:left;"><?php Video() ?></div>


  <div style="float:left; padding:15px"></div> 


  <div class="z-depth-2" style="border:1px solid black; float:left;"><?php Video() ?></div>



  </body>
 </html>
