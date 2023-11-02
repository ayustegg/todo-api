# INSTALACION DE LA API
Se ha utilizado la versión de Node.js -> 21.1.0
## Instalación de node con nvm
Para instalar nvm usamos los siguientes comandos:
```sh
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
```
Ahora vamos a activar la variable de entorno para NVM con el siguiente comando:
```sh
source ~/.bashrc
```
Para ver si tenemos nvm instalado hacemos:
```sh
nvm --version
```
Para descargar, compilar, y instalar la ultima versión de node haz esto:
```sh
nvm install node # "node" es un alias para instalar la ultima versión
```

Para instalar una versión especifica de node:
```sh
nvm install 21.1.0 # or 16.3.0, 12.22.1, etc
```

Puedes ver las que tienes instaladas haciendo `nvm list`:
```sh
nvm list
```

Y puedes seleccionar la versión que quieras de esta manera.
```sh
nvm use 21.1.0
```

## Descargar el proyecto

Para instalar el repositorio en local haremos:
```sh
$ git clone https://github.com/ayustegg/todo-api.git
```

Una vez descargado node en usaremos el comando `npm install` en la raiz del proyecto para instalar las dependencias. 

```sh
$ npm install
```
También podemos utilizar los siguientes comandos para instalar las dependencias `npm run build` y para iniciar el servidor `npm run start`:

```sh
$ npm run build
$ npm run start
```
# METODOS DE LA API
JSON que almacenamos en la api, si hacemos un GET recibiremos una lista de Todo con esta estructura:
```json
{
  "id" :"Generado con UUID4",
  "title": "Titulo del Todo",
  "completed": "true/false"
}
```

El backend se encarga de añadir el `completed` y `id`.

## Metodos de la api:

Para obtener todos los TODO hacemos la siguiente llamada:
```sh
GET http://localhost:3000/api/v1/todo
```
Para obtener un TODO por id pasandolo por parametro:
```sh
GET http://localhost:3000/api/v1/todo
```
Al post le tenemos que pasar el `title` que queremos añadir al todo en el body en formato json:
```sh
POST http://localhost:3000/api/v1/todo
```
**Ejemplo del body**
```json
{
  "title": "Titulo del Todo"
}
```
Al patch nos permite modificar el `title` pasando el id del todo por parametro
```sh
PATCH http://localhost:3000/api/v1/todo/:id
```
**Ejemplo del body**

```json
{
  "title": "Titulo Nuevo"
}
```
Enviando el id del Todo con DELETE lo eliminamos.
```sh
DETELE http://localhost:3000/api/v1/todo/:id
```


