# **Clasicos 80/90**

### - Descripción

Esta API permite acceder a los datos (**canciones, albums**, y los respectivos **comentarios**) de la correspondiente base de datos. Ademas se permite el alta y baja de **comentarios**.
Todas las respuestas de la **API** tienen el siguiente formato:

```json
{
  "data": "Respuesta del endpoint",
  "status": "Estado de la respuesta"
}
```

_Aclaraciones:_

- Los únicos valores posibles de **"status"** son **"success"** y **"error"**.

- Ante cualquier error encontrado, todas las respuestas tendrán el siguiente formato:

  ```json
  {
    "data": "Mensaje del error",
    "status": "error"
  }
  ```

- La dirección base de la API es la siguiente:

  - **{ruta_serividor_apache}/api**

    - \*En adelante nos referiremos a la ruta del servidor como **BASE_URL.\***

---

### - Requerimientos

Contar con la base de datos correspondiente:

- [_Ver archivo SQL_](./database/musica.sql)

---

- #### Albums

  ```json
  {
    "album_id": 43,
    "album_nombre": "Album",
    "anio": 1992,
    "artista": "Artista",
    "discografica": "Sello discografico"
  }
  ```

  ##### - GET: /albums

  - Este Endpoint devuelve la lista de albums de la base de datos dentro de **"data"**. Puede recibir distintas opciones para **filtrar** la lista a través de parametros:

    - **?name** : recibe un **string** y devuelve una lista con todos los albums que lo **contengan dentro de su nombre**.

    - **?older** : recibe un número de tipo **int** y devuelve una lista con todos los albums que tengan un **año igual o anterior al indicado**.

    - **?newer** : recibe un número de tipo **int** y devuelve una lista con todos los albums que tengan un **año igual o posterior al indicado**.

    -**?artist** : recibe un **string** y devuelve una lista con todos los albums que lo **contengan dentro del nombre de su artista**.

    -**?label** : recibe un **string** y devuelve una lista con todos los albums que lo **contengan dentro del nombre de su sello discografico**.

  ##### - GET: /albums/:ID

  - Este Endpoint devuelve el album con el ID indicado dentro de **"data"**.

  ##### - POST: /comments

  - Este endpoint recibe un objeto **JSON** en el body del **HTTP Request** del siguiente formato:

    ```json
    {
      "comentario": "este disco esta buenisimo!",
      "puntuacion": "5",
      "album": "29" //ID del album que se desea comentar
    }
    ```

    La respuesta incluirá en **"data"** el album agregado en el formato antes mostrado (Que incluye el **ID** asignado).

  ##### - PUT: /comments/:ID

  - Este endpoint recibe un objeto igual al anterior en el body y modifica el elemento con el **ID** dado en la base de datos. Devuelve en **"data"** el album ya modificado.

  ##### - DELETE: /comments/:ID

  - Este endpoint elimina el comentario con el **ID** indicado. De realizarse correctamente, devuelve un mensaje de confirmacion dentro del atributo **"data"** de la respuesta.

- #### Songs

  ```json
  {
    "cancion_id": "55",
    "cancion_nombre": "nombre",
    "album": "ID del album al cual pertenece la cancion",
    "duracion": "555", //en segundos
    "track": "1" //numero de track
  }
  ```

  ##### - GET: /songs

  - Este Endpoint devuelve dentro de **"data"** una lista de la tabla songs guardada en la base de datos.

  ##### - GET: /songs/:ID

  - Este Endpoint devuelve dentro de **"data"** una canción solicitada mediante su **ID**.

  ##### - POST: /songs **[TP]**

  - Este Endpoint crea una nueva canción a partir de los siguientes datos introducidos en el body:

    ```json
    /*los parametros requeridos son "title" y "album_id" */
    {
      "title": "nombre de la canción",
      "rel_date": "año-mes-dia de publicación",
      "album_id": "N° de id del album al que pertenece",
      "lyrics": "letra de la canción"
    }
    ```

    Dentro de **"data"** se devolverá la canción creada en el mismo formato.

  ##### - PUT: /songs/:ID **[TP]**

  - Este Endpoint permite modificar una canción seleccionada mediante su **ID**, introduciendo los parámetros en formato JSON desde el body.
    Dentro de **"data"** se devolvera la canción con todos sus datos incluídas las modificaciones.
  - **\*Aclaración**: se deben respetar los **campos obligatorios\***.

  ##### - DELETE: /songs/:ID **[TP]**

  - Este Endpoint elimina la canción mediante el **ID** proporcionado. Dentro de **"data"** se leerá **"la cancion con N° de id = el id proporcionado se eliminó con exito"**.

- #### Autorización

  ##### - POST: /auth

  - Este Endpoint recibe en el body del **HTTP Request** un objeto de tipo **JSON** con las propiedades **"name"** y **"password'**. De ser correctos los datos introducidos, se proporcionará dentro de **"data"** un token que permite identificarse.

  - _Ejemplo_:

    ```json
        //Objeto a incluir en el body del HTTP Request
        {
            "name": "nombre_de_usuario",
            "password": "password"
        }

        //Ejemplo de la respuesta
        {
            "data": "token generado",
            "status": "success"
        }
    ```

  - El **token** generado mediante este endpoint será requerido para todos los request de tipo **POST, PUT, o DELETE** de las entidades de datos. Deberá agregarse a los **Headers** del request en el siguiente formato:

          Autorization: Bearer <Token generado>

- #### Parámemtros de ordenamiento:

  Al solicitar una lista de entidades **_(ver [GET: /albums](#--get-albums) y [GET: /songs](#--get-songs))_** podemos usar los siguientes query params para controlar cómo se muestra la lista incluída en el altributo **"data"** de la respuesta:

  - **?sort_by** : Este parámetro recibe un string que **debe corresponder** con uno de los **campos de la entidad solicitada**. (De no corresponder se enviará la respuesta ordenada por el campo por defecto).

  - **?order** : Este parámetro recibe un número entero que puede ser 1 o 0. Si es **1** se ordenará la lista de manera **descendiente**. De ser **0 o cualquier otro número** se ordenara **ascendentemente**.

- #### Parámetros de paginado:

  Al solicitar una **lista de entidades**, podemos usar los siguientes query params para paginar la respuesta

  - **?per_page** : Recibe un **número entero** que define la cantidad de elementos que contendrá cada página. **El valor por defecto es de 10**.

  - **?page** : Indica la página que se quiere recuperar.

  _Un ejemplo de respuestas por página pudiera ser:_

  ```json
  /*
  Respuesta de request con verbo GET a:
      BASE_URL/api/albums?per_page=3page=1sort_by=title
  */
  {
      "data" :
      {
          {
              "id": 43,
              "title": "Album 1",
              [...]
          },
          {
              "id": 4,
              "title": "Album 2",
              [...]
          },
          {
              "id": 34,
              "title": "Album 3",
              [...]
          }
      },
      "status": "success"
  }

  /*
  Respuesta de request con verbo GET a:
      BASE_URL/api/albums?per_page=3page=2sort_by=title
  */
  {
      "data":
      {
          {
              "id": 3,
              "title": "Album 4",
              [...]
          },
          {
              "id": 434,
              "title": "Album 5",
              [...]
          },
          {
              "id": 343,
              "title": "Album 6",
              [...]
          }
      },
      "status": "success"
  }
  ```

  ***
