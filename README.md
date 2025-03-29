# Catálogo de Películas API

Un sistema de administración de catálogo de películas desarrollado con Laravel, que proporciona una API RESTful para crear, leer, actualizar y eliminar información sobre películas.

## Estructura del Proyecto

El proyecto sigue la estructura estándar de Laravel, con algunas personalizaciones:

- **app/Models**: Contiene el modelo `Movie` que define la estructura y relaciones para películas.
- **app/Http/Controllers**: Contiene `MovieController` que maneja todas las operaciones CRUD para películas.
- **database**: Contiene migraciones y configuración de la base de datos.
- **BD_ctalogo.sql**: Archivo SQL para la creación y población inicial de la base de datos.
- **routes**: Define los endpoints de la API en `web.php` y/o potencialmente en `api.php`.

## Funcionalidades Principales

Este proyecto permite:

1. **Gestión completa de películas**:
   - Crear nuevas películas con título, sinopsis, año de lanzamiento y portada
   - Listar todas las películas disponibles
   - Ver detalles de una película específica
   - Actualizar información de películas existentes
   - Eliminar películas del catálogo

2. **API RESTful**:
   - Endpoints bien definidos siguiendo principios REST
   - Validación de datos en las operaciones de creación y actualización
   - Respuestas JSON estructuradas con códigos HTTP adecuados
   - Manejo de errores con mensajes descriptivos

## Tecnologías Utilizadas

- **Laravel**: Framework PHP para el backend
- **MySQL**: Sistema de gestión de base de datos
- **Railway**: Plataforma de despliegue para backend y base de datos
- **Angular**: Framework para el frontend (desplegado en Railway)

## Modelo de Datos

La entidad principal es `Movie` con los siguientes atributos:
- `id`: Identificador único
- `title`: Título de la película
- `synopsis`: Resumen o sinopsis de la película
- `year`: Año de lanzamiento
- `cover`: URL o ruta a la imagen de portada
- `created_at` y `updated_at`: Timestamps automáticos de Laravel

## Configuración del Proyecto

### Requisitos Previos
- PHP >= 8.0
- Composer
- MySQL
- XAMPP o entorno similar

### Instalación Local

1. Clonar el repositorio
```
git clone [url-del-repositorio]
```

2. Instalar dependencias
```
composer install
```

3. Configurar entorno
```
cp .env.example .env
php artisan key:generate
```

4. Configurar base de datos en `.env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=catalogo
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

5. Importar la base de datos
```
mysql -u tu_usuario -p catalogo < BD_ctalogo.sql
```

6. Iniciar el servidor
```
php artisan serve
```

## Despliegue en Railway

Este proyecto está configurado para ser desplegado en Railway, conectándose con el frontend Angular ya desplegado en `cataangularcas-production.up.railway.app`.

### Configuración de la Base de Datos MySQL en Railway

1. **Crear una base de datos MySQL en Railway**:
   - Iniciar sesión en [Railway](https://railway.app/)
   - Crear un nuevo proyecto
   - Seleccionar "Provision MySQL"
   - Railway generará automáticamente las credenciales de conexión

2. **Obtener credenciales de conexión**:
   - En el dashboard de Railway, selecciona tu base de datos MySQL
   - Ve a la pestaña "Connect"
   - Encontrarás todas las variables de entorno necesarias (MYSQLHOST, MYSQLPORT, MYSQLDATABASE, MYSQLUSER, MYSQLPASSWORD)
   - Estas variables serán utilizadas automáticamente por nuestro archivo `.env.railway`

3. **Importar datos iniciales** (opcional):
   - Puedes usar la consola SQL proporcionada por Railway
   - O conectarte remotamente usando un cliente MySQL con las credenciales obtenidas
   - Importa el archivo `BD_ctalogo.sql` o ejecuta las migraciones de Laravel

### Despliegue del Backend (API Laravel) en Railway

1. **Conectar el repositorio Git**:
   - En el dashboard de Railway, crea un nuevo servicio
   - Selecciona "Deploy from GitHub"
   - Conecta tu repositorio de GitHub que contiene este código

2. **Configurar variables de entorno**:
   - Railway detectará automáticamente que es un proyecto Laravel
   - Asegúrate de establecer `APP_KEY` (o se generará automáticamente durante el despliegue)
   - Añade la variable `RAILWAY_DOCKERFILE_PATH` y déjala en blanco para usar Nixpacks

3. **Conectar con la base de datos**:
   - En el dashboard de Railway, haz clic en "New" → "Link existing service"
   - Selecciona tu instancia de MySQL

4. **Despliegue**:
   - Railway usará automáticamente la configuración en `railway.json` y `.env.railway`
   - El servicio se desplegará y estará disponible en una URL proporcionada por Railway
   - Guarda esta URL, la necesitarás para configurar el frontend

### Conectar Frontend Angular con el Backend

1. **Actualizar la configuración del frontend**:
   - En tu proyecto Angular desplegado (`cataangularcas-production.up.railway.app`)
   - Actualiza la URL de la API para que apunte a tu backend recién desplegado
   - Esto se hace generalmente en el archivo de entorno o de configuración del proyecto Angular
   
2. **Configurar CORS en el backend**:
   - El backend ya está configurado para permitir solicitudes desde el dominio del frontend
   - Si es necesario modificar esto, edita el middleware CORS en tu proyecto Laravel

3. **Verificar la conexión**:
   - Una vez desplegados ambos servicios, prueba que el frontend pueda comunicarse correctamente con el backend
   - Verifica todas las funcionalidades: listado, creación, edición y eliminación de películas

## Endpoints de la API

| Método | Ruta | Descripción |
|--------|------|-------------|
| GET | /movies | Obtener todas las películas |
| GET | /movies/{id} | Obtener detalles de una película específica |
| POST | /movies | Crear una nueva película |
| PUT/PATCH | /movies/{id} | Actualizar una película existente |
| DELETE | /movies/{id} | Eliminar una película |

## Uso

Para utilizar la API, puedes realizar solicitudes HTTP a los endpoints mencionados. Por ejemplo:

```
# Listar todas las películas
GET https://[tu-api-url]/movies

# Crear una nueva película
POST https://[tu-api-url]/movies
Content-Type: application/json

{
  "title": "El Padrino",
  "synopsis": "Don Vito Corleone es el respetado y temido jefe de una de las cinco familias de la mafia de Nueva York...",
  "year": 1972,
  "cover": "https://ejemplo.com/imagen.jpg"
}
```

## Contribuciones

Las contribuciones son bienvenidas. Para contribuir:

1. Hacer fork del repositorio
2. Crear una rama para tu característica (`git checkout -b feature/nueva-caracteristica`)
3. Hacer commit de tus cambios (`git commit -m 'Añadir nueva característica'`)
4. Hacer push a la rama (`git push origin feature/nueva-caracteristica`)
5. Crear un Pull Request

## Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo LICENSE para más detalles.
