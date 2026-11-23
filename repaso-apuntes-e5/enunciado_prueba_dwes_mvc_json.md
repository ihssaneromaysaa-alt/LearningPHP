# enunciado completo de la prueba práctica  
## desarrollo web en entorno servidor  
**duración estimada: 2 horas**

una agencia inmobiliaria necesita una aplicación web en php que permita a sus agentes registrar viviendas en venta, calcular el beneficio que obtendría la empresa en caso de venderlas y gestionar el acceso de los propios agentes mediante un sistema de usuarios.

la aplicación debe construirse obligatoriamente siguiendo el patrón mvc y utilizando un router propio escrito en php puro. no se permite el uso de frameworks ni de librerías externas.

todos los datos de usuarios y de viviendas se almacenarán exclusivamente en archivos json. está prohibido el uso de cookies y de sesiones de php en cualquier parte de la aplicación. por tanto no existirá mecanismo de cierre de sesión.

---

## funcionalidades obligatorias

### 1. sistema de usuarios
debe existir un formulario de **registro** que recoja al menos **nombre**, **correo electrónico** y **contraseña**. las contraseñas se almacenarán únicamente con `password_hash`.  

debe existir un formulario de **inicio de sesión** que verifique las credenciales con `password_verify`.  
tras un inicio de sesión correcto el usuario autenticado podrá acceder a las **funcionalidades** de gestión de viviendas.  
toda la información de usuarios residirá en un archivo json.

### 2. formulario de inserción de viviendas
el formulario debe permitir introducir exactamente los siguientes datos:

- tipo de vivienda (piso, adosado, chalet, casa)
- zona (centro, zaidín, chana, albaicín, sacromonte, realejo)
- dirección
- número de dormitorios (1 a 5)
- precio
- tamaño en metros cuadrados
- extras (piscina, jardín, garage) – pueden marcarse varios
- foto
- observaciones

### 3. validación y tratamiento de errores
todos los campos deben validarse de forma rigurosa. se mostrarán mensajes de error claros y concretos cuando los datos no sean correctos (campos vacíos, valores fuera de rango, tipos incorrectos, etc.).  
las fotos se guardarán en una carpeta llamada **fotos** situada dentro del directorio de la práctica. si el archivo supera los **100 kb** se producirá un error y no se almacenará.  
antes de trabajar con cualquier archivo o directorio debe comprobarse siempre que existen.

### 4. almacenamiento y cálculo del beneficio
cada vivienda insertada correctamente se guardará en un archivo json junto con el resto de viviendas ya existentes.  
además del resto de datos se calculará y almacenará el beneficio que obtiene la empresa. el porcentaje se obtiene de la siguiente tabla según la zona y si la vivienda tiene menos o más de 100 m²:

| zona        | menos de 100 m² | más de 100 m² |
|-------------|-----------------|---------------|
| centro      | 30 %            | 35 %          |
| zaidín      | 25 %            | 28 %          |
| chana       | 22 %            | 25 %          |
| albaicín    | 20 %            | 35 %          |
| sacromonte  | 22 %            | 25 %          |
| realejo     | 25 %            | 28 %          |

el porcentaje se aplica sobre el precio de la vivienda. el beneficio calculado debe mostrarse junto con el resto de datos de la vivienda recién insertada.

### 5. visualización de la vivienda insertada
una vez insertados correctamente los datos se mostrará una página con toda la información almacenada (incluido el beneficio) y, si se subió foto, un enlace que permita verla en una página independiente.

### 6. router, modelos, controladores y vistas
debe existir un sistema de enrutamiento propio que interprete las urls y dirija las peticiones a los controladores correspondientes.  
el código se organizará obligatoriamente en modelos, controladores y vistas.  
se utilizarán `htmlspecialchars()` para mostrar cualquier dato de forma segura y se gestionarán códigos http cuando proceda (por ejemplo 400 o 404 en situaciones de error de datos o recursos no encontrados).

---

## requisitos técnicos adicionales

- patrón mvc estricto
- router propio
- almacenamiento exclusivo en json
- `password_hash` y `password_verify`
- ausencia total de cookies y de sesiones de php
- validación completa de formularios
- manejo correcto de subida de imágenes (tamaño máximo 100 kb y carpeta fotos)
- cálculo del beneficio según la tabla facilitada
- comprobación de existencia de archivos y directorios antes de usarlos

---

## funcionalidades voluntarias  
*(solo si se ha terminado completamente el ejercicio obligatorio)*

1. listado de todas las viviendas almacenadas en el json, mostrando al menos tipo, zona, dirección, precio y beneficio.
2. búsqueda de viviendas por zona o por tipo mediante un formulario que envíe los datos por get y devuelva los resultados o un mensaje de “no encontrado”.
3. posibilidad de eliminar una vivienda concreta del archivo json (protegida por el sistema de usuarios).
4. generación de un pequeño informe que muestre el total de beneficios potenciales de todas las viviendas registradas.

---

## criterios de evaluación

se valorará especialmente la correcta separación en modelos-controladores-vistas, el funcionamiento del router, el uso seguro de las contraseñas, la ausencia de cookies y sesiones, la validación exhaustiva, el manejo de las imágenes, el cálculo correcto del beneficio y la coherencia general de la aplicación.
