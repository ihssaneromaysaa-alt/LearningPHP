1. ¿Qué método HTTP utiliza nuestra aplicación?
POST.

2. ¿Dónde localizamos los datos enviados mediante POST? 
En Payload (Chrome/Edge) o Datos de la petición (Firefox).

3. ¿Diferencia entre cabeceras de petición y respuesta? 
Las primeras las envía el navegador al servidor y las segundas las devuelve el servidor al navegador.

4. ¿Qué contiene Content-Type? 
Indica el formato de los datos enviados. En nuestro formulario será normalmente application/x-www-form-urlencoded.

5. ¿Diferencia entre cuerpo de petición y respuesta? 
El primero contiene los datos que enviamos; el segundo contiene el contenido que devuelve el servidor.

6. ¿Por qué el ID no aparece en la URL? 
Porque POST envía los datos en el cuerpo de la petición.

7. ¿Qué código devuelve si encuentra el artículo? 
200 OK.

8. ¿Y si no existe? 
404 Not Found.

9. ¿Por qué no basta con mostrar un mensaje 404 en HTML? 
Porque también debemos enviar el código HTTP 404 mediante http_response_code(404).

10. ¿Qué encontramos en Response? 
El HTML que devuelve PHP, ya sea la información del artículo o el mensaje de error.