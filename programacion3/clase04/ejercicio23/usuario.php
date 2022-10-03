<?php
/*Aplicación No 20 (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior. */
date_default_timezone_set('America/Argentina/Buenos_Aires');
class Usuario
{
    private $nombreUser;
    private $password;
    private $mailUser;
    private $id;
    private $fechaDeRegistro;

    public function __construct($nombreUsuario="", $contra, $mailUsuario, $id=0)
    {
        $this->nombreUser=$nombreUsuario;
        $this->password=$contra;
        $this->mailUser=$mailUsuario;
        if($id!=0)
        {
            $this->id=$id;

        }
        else{

            $this->id=rand(1, 10000);
        }
        $this->fechaDeRegistro=date('d/m/Y H:i:s');
    }


    public function getIdUsuario()
    {
        return $this->id;
    }

    public static function usuarioFormatoCsv($unUsuario)
    {
        $arrayDePropiedades=[];
        foreach ($unUsuario as $propiedadesDelUsuario) {
            array_push($arrayDePropiedades, $propiedadesDelUsuario);
        }
        
        return implode(",", $arrayDePropiedades);
    }

    public function altaUsuario()
    {
        $retornoInformativo="ERROR. No se pudo dar de alta al usuario.";
        if($this!=NULL)
        {
            $archivo=fopen("usuarios.csv", "a");
        
            if(fwrite($archivo, Usuario::usuarioFormatoCsv($this).PHP_EOL)!=FALSE)
            {
                $retornoInformativo="Excelente. Se pudo dar de alta correctamente al usuario.";
            }
        
            fclose( $archivo);
        }

        return $retornoInformativo;
    }

    public static function leerUsuarios()
    {
        $arrayDeUsuarios=[];
        $archivo = fopen("usuarios.csv", "r");

        while(!feof($archivo))
        {
            $datosDelUsuario= fgets($archivo);
            if($datosDelUsuario!="")
            {
                $arrayDePropiedades=explode(",", $datosDelUsuario);
                $nombreUsuario=$arrayDePropiedades[0];
                $claveUsuario=$arrayDePropiedades[1];
                $mailUsuario=$arrayDePropiedades[2];
                $idUser=$arrayDePropiedades[3];
                
                array_push($arrayDeUsuarios, new Usuario($nombreUsuario, $claveUsuario, $mailUsuario, $idUser));
            }
        }
   
        fclose($archivo);

        return $arrayDeUsuarios;
    }

    public function verificarUsuarioSiExiste()
    {
        $usuarios=Usuario::leerUsuarios();
        $retornoInformativo="";


        foreach ($usuarios as $usuariosRegistrados) {

            if($this->mailUser == trim($usuariosRegistrados->mailUser) && $this->password == $usuariosRegistrados->password)
            {
                return $retornoInformativo="Verificado";
                
            }
            else if($this->mailUser == trim($usuariosRegistrados->mailUser) && $this->password != trim($usuariosRegistrados->password))
            {
                return "Error en los datos";
                
            }
            else if($this->mailUser != trim($usuariosRegistrados->mailUser))
            {
                $retornoInformativo="Usuario no registrado si no coincide el mail"; 
            }
        }


        return $retornoInformativo;
    }

    public function mostrarUsuario()
    {
        return "Datos del usuario:\nNombre: {$this->nombreUser}\nClave: {$this->password}\nMail: {$this->mailUser}\nId: {$this->id}\nFecha de registro: {$this->fechaDeRegistro}\n";
    }   
}
?>