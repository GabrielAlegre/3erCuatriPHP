<?php
/*Aplicación No 20 (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior. */ 

class Usuario
{
    private $nombreUser;
    private $password;
    private $mailUser;

    public function __construct($nombreUsuario, $contra, $mailUsuario)
    {
        $this->nombreUser=$nombreUsuario;
        $this->password=$contra;
        $this->mailUser=$mailUsuario;
    }

    public static function usuarioFormatoCsv($unUsuario)
    {
        $arrayDePropiedades=[];
        foreach ($unUsuario as $key) {
            array_push($arrayDePropiedades, $key);
        }
        
        return implode(",", $arrayDePropiedades);
    }

    public function altaUsuario()
    {
        $seAgregoCorrectamente=false;
        if($this!=NULL)
        {
            $archivo=fopen("usuarios.csv", "a");
        
            if(fwrite($archivo, Usuario::usuarioFormatoCsv($this).PHP_EOL)!=FALSE)
            {
                $seAgregoCorrectamente=true;
            }
        
            
            fclose( $archivo);
        }

        return $seAgregoCorrectamente;
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
                
                array_push($arrayDeUsuarios, new Usuario($nombreUsuario, $claveUsuario, $mailUsuario));
            }
        }
   
        fclose($archivo);

        return $arrayDeUsuarios;
    }

    public function mostrarUsuario()
    {
        return "Datos del usuario:\nNombre: {$this->nombreUser}\nClave: {$this->password}\nMail: {$this->mailUser}\n";
    }   
}
?>