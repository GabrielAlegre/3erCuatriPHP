<?php
/*Aplicación No 27 (Registro BD) - Alumno: Gabriel Alegre
Archivo: registro.php
método:POST
Recibe los datos del usuario( nombre,apellido, clave,mail,localidad )por POST ,
crear un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
guardando los datos la base de datos
retorna si se pudo agregar o no.*/
date_default_timezone_set('America/Argentina/Buenos_Aires');
include_once "./AccesoDatos.php";
class Usuario
{
    private $nombreUser;
    private $apellidoUser;
    private $password;
    private $mailUser;
    private $localidadUser;
    private $id;
    private $fechaDeRegistro;

    public function __construct($nombre, $apellido, $clave, $mail, $localidad, $id=0)
    {
        $this->nombreUser=$nombre;
        $this->apellidoUser=$apellido;
        $this->password=$clave;
        $this->mailUser=$mail;
        $this->localidadUser=$localidad;
        $this->id=$id;
        $this->fechaDeRegistro=date('Y/m/d H:i:s');
    }

    public function mostrarDatosDelUsuario($objetoAccesoDato)
    {
        
        return "\nDatos del Usuario:
        Nombre: {$this->nombreUser}
        Apellido: {$this->apellidoUser}
        Clave: {$this->password}
        Mail: {$this->mailUser}
        Localidad: {$this->localidadUser}
        Id: {$objetoAccesoDato->RetornarUltimoId()}
        Fecha de registro: {$this->fechaDeRegistro}\n";
    }   

    public function agregarUsuarioALaBaseDeDatos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RealizarConsulta(
        "INSERT INTO usuarios (NOMBRE, APELLIDO, CLAVE, MAIL, LOCALIDAD, FECHA_DE_REGISTRO)
         VALUES('$this->nombreUser','$this->apellidoUser','$this->password', '$this->mailUser', '$this->localidadUser', '$this->fechaDeRegistro')");;    
        
        echo $consulta->execute() != FALSE ? "Se pudo agregar correctamente al siguiente usuario en la base de datos".$this->mostrarDatosDelUsuario($objetoAccesoDato) : "No se pudo agregar al usuario en la base de datos";
    }
    public static function TraerTodoLosUsuariosDeLaBaseDeDatos()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RealizarConsulta("SELECT * FROM usuarios");
			$consulta->execute();			
            var_dump($consulta);
			//return $consulta->fetchAll(PDO::FETCH_CLASS, "cd");		
	}

}

?>