# Proyecto SQL (MySQL)

El siguiente proyecto consiste en elaborar una aplicación web funcional que permite realizar operaciones CRUD (Create, Read, Update, Delete) utilizando **MySQL** como sistema de base de datos relacional, la aplicación web fue desarrollada en un entorno web, utilizando PHP con HTML.

Los puertos locales usados fueron:

- <http://localhost:8085/>  Utilizado para la aplicación web.
- <http://localhost:8086/>  Usado para phpmyAdmin
- Puerto 3306  Puerto correspondiente al servidor de base de datos MySQL.

En lugar de colecciones (como en NoSQL), en MySQL se definieron **tres tablas principales** que almacenan datos relacionados:

---

## Tabla `cafes`

Contiene información sobre los distintos tipos de café disponibles. Cada fila posee un campo `id_cafe` único que permite su identificación.

**Ejemplo de inserción de datos:**

```sql
INSERT INTO cafes (id_cafe, nombre_cafe, origen, tipo_lavado, precio_base)
VALUES (2, 'Americano', 'México', 'Natural', 40.0);
```

En la ruta <http://localhost:8085/cafes/index.php>, se puede visualizar el contenido de esta tabla en un formato amigable. Además, se incluyen botones que permiten realizar las operaciones básicas de CRUD:

- Agregar un nuevo café.
- Editar los datos de un café existente.
- Eliminar un registro de la tabla.
- Ver contenido de la tabla.

Estas funciones permiten gestionar fácilmente la información de los cafés almacenados en MySQL a través de una interfaz web intuitiva.

## Tabla `metodos`

Describe los distintos métodos de preparación del café. Cada fila incluye un campo id_metodo único que lo identifica.

**Ejemplo de inserción de datos:**
```sql
INSERT INTO metodos (id_metodo, nombre_metodo, descripcion)
VALUES (1, 'V60', 'Método de goteo con filtro de papel');
```

En la ruta <http://localhost:8085/metodos/index.php>, es posible visualizar los métodos registrados en la base de datos. La interfaz muestra la información de manera estructurada e incluye botones para realizar operaciones CRUD:

- Agregar un nuevo método de preparación.
- Editar la descripción o el nombre de un método existente.
- Eliminar registros de la tabla.
- Ver contenido de la tabla.

Esto permite mantener actualizada la lista de métodos de preparación y gestionar fácilmente los datos desde la aplicación web, de una manera más intuitiva.

## Tabla `ventas` 

Registra las transacciones realizadas. Cada fila incluye dos campos clave que hacen referencia a las otras tablas:

- id_cafe: identifica el café vendido.
- id_metodo: indica el método de preparación utilizado.

**Ejemplo de inserción de datos:**
```sql
INSERT INTO ventas (id_cafe, id_metodo, fecha, precio_total)
VALUES (1, 2, '2025-06-25 19:00:00', 52.5);
```
En la ruta <http://localhost:8085/ventas/index.php>, se puede visualizar un listado de las ventas registradas con detalles relevantes. La interfaz incluye botones que permiten:

- Agregar una nueva venta.
- Editar los datos de una transacción existente.
- Eliminar registros de ventas.
- Visualizar el contenido de ventas, haciendo referencia a las otras tablas.

Estas funcionalidades permiten gestionar el historial de ventas, relacionando cafés y métodos de preparación, todo desde una interfaz web intuitiva conectada a MySQL.

**Nota:** Todas tabla en MySQL en su campo id, no es necesario incluirlo en la inserción, ya que se genera automáticamente.

## Adicionales
Las estructura de los directorios de este proyecto son:

```
SQLPROYECTO/
├── app/                                                        
│   ├── cafes/
│   |   ├── create.php    # Script PHP para crear nuevos documentos en la colección 'cafes'
│   |   ├── delete.php    # Script PHP para eliminar documentos de 'cafes'
│   |   ├── index.php     # Vista principal para listar y mostrar los cafés registrados
│   |   ├── update.php    # Script para actualizar documentos existentes en 'cafes'
│   ├── metodos/
│   |   ├── create.php    # Crear nuevos métodos de preparación
│   |   ├── delete.php    # Eliminar métodos de preparación
│   |   ├── index.php     # Listar métodos existentes
│   |   ├── update.php    # Actualizar información de métodos
│   ├── ventas/
│   |   ├── create.php    # Registrar nuevas ventas
│   |   ├── delete.php    # Eliminar registros de ventas
│   |   ├── index.php     # Mostrar listado de ventas realizadas
│   |   ├── update.php    # Modificar registros de ventas existentes
│   ├── ICONOS/           # Carpeta que contiene iconos usados en la interfaz web
│   ├── db.php            # Script para la conexión y configuración de la base de datos MySQL
│   └── index.php         # Página principal o punto de entrada de la aplicación web
├── Dockerfile            # Define cómo construir la imagen Docker del backend 
└── docker-compose.yml    # Archivo para orquestar los contenedores Docker (MySQL,Phpyadmind y backend Apache-PHP)
```
