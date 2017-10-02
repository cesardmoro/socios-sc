# Somos Cerveceros - Portal de socios
Portal de socios de Somos Cerveceros. 
Desde el mismo los usuarios pueden inscribirse a capacitaciones, eventos, sorteos y mas.


Manual creación de usuarios:
http://somoscerveceros.com/socios/manual


# Aporte al desarrollo:
Modalidad de aporte Fork & Push Request. Cualquier aporte o corrección de bug es aceptada

El framework utilizado es <a href="https://codeigniter.com/">CodeIgniter</a> + <a href="https://www.grocerycrud.com/">Grocery CRUD</a>.

# Requerimientos:

PHP 5.3+ 
MySQL 5.5+

# Instalación:
  * Hacer clone del sitio. 
  * Crear base de datos
  * Importar el archivo: /db/estructura-db.zip
  * Modificar archivos de configuracion
	  * config.php : base_url
	  * database.php : datos conexion a la db
	  * email.php : datos smtp
	  
Nota:
  se recomindan agregar valores a la tabla llx_adherent donde estarian registrados los socios.
  
 

# Contacto:

Contacto: cesar.d.moro@gmail.com

# Funcionalidades:
 * Terminadas:
 	* Couta al dia (Para bares y cualquiera) - http://somoscerveceros.com/socios/cuota
	* Registro de Socios - http://somoscerveceros.com/socios/login
	* Creación de eventos
	* Inscripción de socios a eventos con notificaciones via email:
		* Al inscribirse.
		* Al cancelar inscripción.
		* Al pasar de lista de espera a cupo libre.
	* Inscripción de no socios a eventos
		* Al intentar inscribirse con email de confirmación.
		* Al confirmar la inscripción.
		* Al cancelar inscripción.
		* Al pasar de lista de espera a cupo libre.
	* Administración de lista de espera

		
	
		
 
 * En proceso:
 	* Testing
 * Posibles:
 	* Inscripciones Festival
 	* Biblioteca interna de datos
	* Link a wiki
	* Integración con bom 
	* Concursos
	* Ayuda al socio
	* Pago de couta

	
