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
- **XAMPP**: Entorno de desarrollo local

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

### Instalación

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

## Estado de Despliegue

El proyecto está configurado para funcionar en un entorno local con XAMPP. Para el despliegue en producción, se recomienda:

1. Configurar un servidor web como Nginx o Apache
2. Asegurar que la configuración de la base de datos sea segura para producción
3. Establecer variables de entorno adecuadas
4. Configurar HTTPS para peticiones seguras

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
GET http://localhost:8000/movies

# Crear una nueva película
POST http://localhost:8000/movies
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
