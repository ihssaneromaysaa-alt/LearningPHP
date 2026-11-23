# enunciado:

se solicita el desarrollo de una aplicación web completa en php utilizando el patrón mvc y un sistema de enrutamiento propio. la aplicación debe **permitir el registro de usuarios** y el **acceso autenticado** sin utilizar cookies ni sesiones de php en ningún momento. 

toda la información de usuarios se almacenará y consultará exclusivamente mediante **archivos json**. las contraseñas deben almacenarse de forma segura empleando **password_hash** y verificarse con **password_verify**.la aplicación debe disponer de formularios para el **registro de nuevos usuarios** y para **el inicio de sesión**. tras un inicio de sesión correcto el usuario autenticado debe poder acceder a una zona restringida donde se muestre **información personal básica obtenida del almacenamiento json**. 

debe existir también la posibilidad de **cerrar la sesión** de forma coherente con las restricciones impuestas (sin cookies ni sesiones). es obligatorio organizar el código en modelos, controladores y vistas. el enrutamiento debe gestionar las diferentes urls de la aplicación y dirigir las peticiones a los controladores correspondientes. 

no se permite el uso de frameworks externos ni de librerías de terceros para el enrutamiento, la autenticación o el almacenamiento. se valorará especialmente:

el correcto uso del patrón mvc
la implementación funcional del router
el manejo seguro de contraseñas con las funciones nativas indicadas
la ausencia total de cookies y de sesiones de php
la persistencia de datos exclusivamente mediante json
la correcta separación entre modelos, controladores y vistas
la existencia y correcto funcionamiento de los formularios de registro e inicio de sesión
la coherencia general de la aplicación y la ausencia de errores graves