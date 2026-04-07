# Laboratorio-2-Segundo-Computo-progra-4

# 1- ¿De qué forma manejaste el login de usuarios? Explica con tus palabras porque en tu
# página funciona de esa forma.
Para el acceso, diseñé un formulario donde el usuario ingresa sus credenciales.
Al enviarlo, PHP se encarga de recibir los datos y consultar la base de datos en MySQL 
para verificar si el usuario existe y si la clave coincide. Si todo está en orden, se crea una sesión activa. 
Elegí este método porque es la forma más segura de procesar la información en el servidor; así, el navegador
solo guarda un identificador temporal (la sesión) y no los datos sensibles, permitiendo que el usuario se mueva
por la web sin tener que loguearse en cada página

# 2- ¿Por qué es necesario para las aplicaciones web utilizar bases de datos en lugar de
# variables?

Básicamente por la persistencia. Las variables en PHP son temporales y "mueren" en cuanto la página
termina de cargar o el usuario la cierra. Si usáramos solo variables, los datos se perderían para siempre.
La base de datos nos permite que la información quede guardada físicamente en el servidor, de modo que podamos 
consultarla mañana, el próximo mes o compartirla con otros usuarios que entren al sistema.

# 3- ¿En qué casos sería mejor utilizar bases de datos para su solución y en cuáles utilizar
# otro tipo de datos temporales como cookies o sesiones?

El uso depende de qué tanto tiempo necesitemos la información:
# Bases de Datos:
Son para la información "pesada" y permanente, como la lista de usuarios o los registros que ingresamos en la tabla.
# Sesiones: 
Son ideales para datos que solo importan mientras el usuario está navegando, como saber quién está conectado en ese momento.
# Cookies:
Las usamos para guardar pequeñas preferencias en el navegador del cliente (como un "recuérdame" o el idioma), que pueden durar incluso después de cerrar el navegador.

# 4- Describa brevemente sus tablas y los tipos de datos utilizados en cada campo;
# justifique la elección del tipo de dato para cada uno.

Para este sistema configuramos dos tablas principales:

# Tabla usuarios:

id: Un entero (INT) que se aumenta solo, para que cada usuario tenga un número único.
username: Un texto corto (VARCHAR), ideal para nombres de usuario.
password: Un texto largo (VARCHAR de 255), para que quepa una contraseña encriptada (hash), lo cual es mucho más seguro que guardar el texto plano.

# Tabla datos:

id: Identificador único del registro.
name y email: Usé VARCHAR porque son campos de texto de longitud variable.
age: Un entero (INT), ya que es un valor numérico con el que podríamos hacer cálculos después.
created_at: Un TIMESTAMP para que el sistema anote automáticamente el día y la hora exacta en que se guardó la información.
