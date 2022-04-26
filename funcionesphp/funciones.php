
<?php


/*funciones de ayuda */

function clean($string){


    return htmlentities($string);

}

function redireccionar ($location){

    return header("Location: {$location}");

}

/*funcion para ver mensajes aunque redireccione paginas ya que la redireccion no te permite usar echo*/


function set_message ($message){

if(!empty($message))
{

    $_SESSION['message']=$message;
    } else {

    $message = "";
    }

}


function display_message(){

    if(isset($_SESSION['message'])){

        echo $_SESSION['message'];

        unset($_SESSION['message']);

    }
}



/***********************funciones de validación *****************/

function validation_errors($error_message){

    $error_message = <<<DELIMITER

    <div class='text-mini-registro'> $error_message 

    </div> 

    DELIMITER;

    return $error_message; 

}

/*validar si el email existe en la bbdd para usarlo en el registro de usuario*/

function existe_email($mail){
    $sql="SELECT Id_Usuario FROM usuarios WHERE mail='$mail'";
    $result = query($sql);

    if(row_count($result)==1) {

        return true;

    }else {

        return false;
    }
 }


/*Validar registro de usuario*/

function validar_registro_usuario()
{

    $errors = []; 

    if($_SERVER['REQUEST_METHOD']=="POST") {

    $nombre               = clean($_POST['nombre']);
    $apellidos            = clean($_POST['apellidos']);
    $mail                 = clean($_POST['mail']);
    $pass                 = clean($_POST['pass']);
    $passconfirmar        = clean($_POST['passconfirmar']);

       
   if($pass!== $passconfirmar)   {

        $errors[] ="Los passwords no coinciden";
    }


    if(existe_email($mail))

    {

        $errors[] ="Lo siento, este email está registrado";
    }



if(!empty($errors)) {

        foreach ($errors as $error) {

            echo validation_errors($error);

        } 

} else{

    if(registrar_usuario($nombre, $apellidos, $mail, $pass, $passconfirmar)){


        set_message("<p class='text-mini-registro'>Ya estás registrado! Inicia sesión para poder descargar tu libro</p>");

        redireccionar("inicio.php");

             }else {

                 set_message("<p class='text-mini-registro'>Algo ha fallado, por favor, vuelve a registrarte</p>");

                 redireccionar("inicio.php");


             }
        }

    }

}





/*Registrar Usuario*/

function registrar_usuario($nombre, $apellidos, $mail, $pass, $passconfirmar) {

    $nombre             = escape($nombre);
    $apellidos          = escape($apellidos);
    $mail               = escape($mail);
    $pass               = escape($pass);
    $passconfirmar      = escape($passconfirmar);


     if(existe_email($mail)){

        return false;


    }else {
       
        
        $sql="INSERT INTO usuarios(nombre, apellidos, mail, pass, Codigo_validacion, active)";     
        $sql.=" VALUES ('$nombre','$apellidos','$mail','$pass','1','1')";
        $result=query($sql);
        confirm($result);

    return true;
    
    }
}




/*validar el login del usuario */

function validar_login()
{

    $errors = []; 

    if($_SERVER['REQUEST_METHOD']=="POST") {


    
      $mail              = clean($_POST['mail']);
      $pass              = clean($_POST['pass']);



    if(empty($mail)) {

        $errors[] ="El email no puede estar vacío";
    }



    if(empty($pass)) {

        $errors[] ="El password no puede estar vacío";
    }
 
 
    if(!empty($errors)) {

        foreach ($errors as $error) {

           echo validation_errors($error);

                } 

            } else{


               if (inicio_usuario($mail,$pass)){

                redireccionar("libreria.php");

               }else{

                    
                     set_message("<p class='bg-success test-center'>tus credenciales no son válidas</p>"

                 );

               }

        }

    }
}
 
 /****************funciones para el inicio de usuario*******************************************/

 function inicio_usuario($mail,$pass){

    $sql    = "SELECT  
                    pass, 
                    Id_Usuario 
            FROM
                    usuarios 
            WHERE 
                    mail='".escape($mail)."'";

    $result = query($sql);

    if(row_count($result)==1){

        $row = fetch_array($result);

        $pass_bbdd = $row['pass'];

        if ($pass==$pass_bbdd){

            $_SESSION['mail'] = $mail;

            return true;

        } else {

        return false;

    }

        return true;

    } else

        return false;

    }


    /*funcion de login, primero compruebo si el usuario ha iniciado sesión*/



    function login_in(){

        if(isset($_SESSION['mail'])){


            return true;

        } else{


            return false;
        }

     }


      /*validar el login y si esta logado puede descargar un libro*/


    function validate_login_in(){

       if(login_in()==0) {

        echo "<p class='bg-success test-center'>Si quieres descargar un libro, regístrate o inicia sesión</p>";
                            
         } else{

        echo "<p class='bg-success test-center'>Bienvenido! Ya puedes descargar tu libro</p>";
         
         }

     }



/*funcion libreria, para */

function libreria(){

                 
$sql = "SELECT 
            Nombre_libro, 
            Id_libro 
        FROM 
            libros";

    $result=query($sql);
    confirm($result);

    while ($row = fetch_array($result)) {
    

    $titulo=$row['Nombre_libro'];
    $Idlibro=$row['Id_libro'];

    /*añado al link el idlibro para poder utilizarlo posteriormente para la descripcion del libro y que solo me aparezaca uno de ellos, el que id=id en la base de datos  */
   
    $href="<a href=descripcion.php?ref=".$Idlibro." title='Ver el libro completo'>$titulo</a></td>";

    echo "<ul>";

    if (login_in()) {

        echo "<div class=\"hijo\">
        <h6>$href</h6>
        <cite>$titulo.</cite>
        </div>";

    } else {

        echo "<div class=\"hijo\">
        <h6>$titulo.</h6>
        <cite>$titulo.</cite>
        </div>";

        }

    echo "</ul>";
        }

   }


/***************Función para la búsqueda de libro****************/

    
function busqueda_libro(){

     if(isset($_GET['enviar-autor'])) {

    $busqueda   = $_GET['Nombre_libro'];   
    $sql        = "SELECT * FROM libros WHERE Nombre_libro LIKE '%$busqueda%' OR autor LIKE '%$busqueda%' LIMIT 20; ";
    $result     = query($sql);
    confirm($result);

    /*comprobacion de que la búsqueda no está vacía*/

        if(empty($busqueda)) {

                echo "<p class='bg-success test-center'>Lá búsqueda no puede estar vacía, inserta el libro que quieres buscar</p>";

   /*si no hay resultados lo comuniquedmos */


        }else if (row_count($result)==0){

                echo "<p class='bg-success test-center'>Lo siento pero no hemos encontrado níngún resultado, por favor, haz la búsqueda con otros criterios</p>"; 

        }else{

            while ($row = fetch_array($result)) {
    

            $titulo     = $row['Nombre_libro'];
            $autor      = $row['Autor'];
            $Idlibro    = $row['Id_libro'];   
            $href       ="<a href=descripcion.php?ref=".$Idlibro.">$titulo - $autor</a></td>";

   
    echo "<ul>";

    /*Solo permito la descarga en el caso de que el usuario esté logado*/

    if (login_in()) {

        echo $href.'<hr>';

    } else {

         echo $titulo.'<hr>';

        }

    echo "</ul>";

            }

        }

    }


}



/**********funcion para la descripcion del libro *****************/

function descripcion_libro(){

    $id     = $_GET['ref'];
    $sql    = "SELECT 
                    ld.Nombre_libro, 
                    ld.Id_libro, 
                    ld.Pdf_descarga_libro, 
                    ld.Portada_libro_img, 
                    li.autor, 
                    li.sinopsis
            FROM 
                    libros_descripcion ld 
                    LEFT OUTER JOIN libros li ON ld.Id_libro=li.Id_libro 
            WHERE 
                    ld.Id_libro = '$id'";


    $result     =query($sql);
    confirm($result);
    
    while ($row = fetch_array($result)) {
    

            $titulo     =$row['Nombre_libro'];
            $Idlibro    =$row['Id_libro'];
            $pdf        =$row['Pdf_descarga_libro'];
            $img_portada=$row['Portada_libro_img'];
            $autor      =$row['autor'];
            $sinopsis   =$row['sinopsis'];
          
    echo "<ul>";

    if (login_in()) {


    echo "          <div class=\"main-contenedor\">
                <article>                    
                <img id=\"casa-de-munecas-img\" class=\"portadas-libros\" src=$img_portada width=\"210px\" height=\"310px\" alt=\"portada del libro Casa de Muñecas\">
                    <div class=\"descripcion-libros\">
                <h3>$titulo</h3>
                <cite>$titulo</cite>
                <p class=\"texto-descripcion-libro\">$sinopsis</p>
                <button type =\"submit\" id=\"boton-descarga\" name=\"boton-descarga\" class=\"texto-boton\"><a href=$pdf  download=\"\";>descargar</a></button>
                    </div>";
                

    } else {


       echo "error";

        }

    echo "</ul>";

    }


}



/*a Modo informativo y para poder registrar los libros mas solicitados inserto los datos de todos los libros que se han visto en la base de datos.

En un futuro se puede hacer un analisis de los libros mas populares y añadir una sección "libros populares"*/



function libros_visitados(){

    /*cojo el id de la referencia del libro que hemos consultadoo*/

        $id     = $_GET['ref'];

  /*compruebo que existe el libro el bbdd*/

    $sql        = "SELECT * FROM libros WHERE Id_libro = '$id'";
    $result     = query($sql);
    confirm($result);

    if(row_count($result)==1){

       /*Inserto los datos en la tabla*/

     $sql="INSERT INTO visitas_libros(Id_visita, Id_libro, Fecha_visita)";     
     $sql.=" VALUES ('','$id',now())";
     $result     =query($sql);
     confirm($result);
    

     return true;
       
            
        }else{


            return false;
        }

    }


/*validacion para recuperar_pass con envío de contraseñapor email*/

function recuperar_password() {

    if($_SERVER['REQUEST_METHOD']=="POST") {

        $mail               = $_POST['mail']; 
        $sql                = "SELECT pass FROM usuarios WHERE mail='".escape($mail)."'";
        $result             = query($sql);
        confirm ($result);

        $row                = fetch_array($result);
        $pass               = $row['pass']; 

              /*Parametros para la funcion de email*/                    

        $paracorreo         = $mail;
        $titulo             = "Recuperar contraseña";
        $mensaje            = "Hola, tu contraseña es la siguiente" .  $pass;
        $tucorreo           = "From: patimq@gmail.com";

            /*si tengo datos en la consilta envío email con la funcion mail*/

                if(row_count($result)==1)                     

                    mail( $paracorreo,$titulo,$mensaje,$tucorreo);
                    echo "comprueba tu correo para recuerpara tu contraseña";

                 }else {

                       echo "error";


                 }

           } 

          



