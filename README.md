# TPE 2024 - Base de Datos para Guitarras

## Integrantes

Valentin Fernandez Carlomagno (DNI: 46555388)
Tomas Rios (DNI: 46568155)

## Descripción del Proyecto

Este proyecto consiste en el diseño y desarrollo de una base de datos relacional para almacenar y gestionar información de guitarras clasificadas en diferentes categorías. La base de datos está estructurada para cumplir con una relación de **1 a N**, lo que significa que cada categoría puede contener varios ítems (guitarras). 

El propósito de esta base de datos es poder ser utilizada y administrada a través de una plataforma web, permitiendo al usuario gestionar diferentes tipos de guitarras de una manera sencilla y organizada.

## Modelo de Datos

El modelo de datos propuesto sigue una relación **uno a muchos (1:N)** entre las tablas principales:

1. **Categoría**: Cada guitarra pertenece a una categoría (e.g., eléctrica, acústica, electroacústica).
2. **Guitarra**: Esta tabla contiene información detallada sobre cada guitarra, como el nombre, la categoría a la que pertenece y su precio.

### Tablas

- **Categoría**:
  - `id_categoria`: Identificador único para cada categoría.
  - `nombre`: Nombre de la categoría (e.g., Eléctrica, Acústica, Electroacústica).

- **Guitarra**:
  - `id_guitarra`: Identificador único para cada guitarra.
  - `nombre`: Nombre del modelo de guitarra (e.g., Stratocaster, Yamaha).
  - `categoria_id`: Identificador que referencia a la tabla `Categoría` (relación de clave foránea).
  - `precio`: Precio de la guitarra.

### Diagrama de la Base de Datos

A continuación se incluye un diagrama de la base de datos:

![Diagrama de la Base de Datos](/Diagrama__de_tablas.png)

**INFORMACION**

PK = Primary Key (Clave primaria)

FK = Foreign Key (Clave foránea)

## Instalación y Uso

### Requisitos Previos

- Un servidor MySQL.
- Acceso a una herramienta de administración de base de datos como phpMyAdmin.

### Configuración

1. Clonar el repositorio del proyecto:
   ```bash
   git clone https://github.com/FdezCarlomagno/tp_web2.git  

2. Importar el archivo .sql proporcionado en tu base de datos local usando phpMyAdmin o la terminal de MySQL:
    tp_web2/centro_guitarras.sql

3. La base de datos se creará con datos de ejemplo que incluyen algunas guitarras y sus respectivas categorías.

Ejemplos de Datos
Categorías:

Eléctrica
Acústica
Electroacústica
Guitarras:

Stratocaster (Eléctrica)
Yamaha (Acústica)
Ovation (Electroacústica)
    
