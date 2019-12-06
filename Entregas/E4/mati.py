from flask import Flask, render_template, request, abort, json
from pymongo import MongoClient
import pandas as pd
import matplotlib.pyplot as plt
import os
import atexit
import subprocess

USER_KEYS = ['name', 'last_name', 'occupation', 'follows', 'age']

URL = "mongodb://grupo59:grupo59@gray.ing.puc.cl/grupo59"
client = MongoClient(URL)
db = client.get_database()
messages = db.messages


# Iniciamos la aplicación de flask
app = Flask(__name__)

@app.route("/")
def home():
    return "<h1>HELLO</h1>"

# Mapeamos esta función a la ruta '/plot' con el método get.
@app.route("/plot")
def plot():
    # Export la figura para usarla en el html
    pth = os.path.join('static', 'plot.png')

    # Retorna un html "rendereado"
    return render_template('plot.html')

@app.route("/users")
def get_users():
    # Omitir el _id porque no es json serializable
    resultados = ['Pedro', 'Juan', 'Diego']
    return json.jsonify(resultados)

@app.route("/users", methods=['POST'])
def create_user():
    '''
    Crea un nuevo usuario en la base de datos
    Se  necesitan todos los atributos de model, a excepcion de _id
    '''
    return json.jsonify({'success': True, 'message': 'Usuario con id 1 creado'})

@app.route("/messages", methods=['POST'])
def create_message():
    if "content" not in request.json.keys() or "metadata" not in request.json.keys():
        abort(400)
    else:
        if "time" not in request.json["metadata"].keys():
            abort(400)
    data = {key: request.json[key] for key in ["content", "metadata"]}
    count = messages.count_documents({})
    data["id"] = count + 1
    result = messages.insert_one(data)
    datox = {key: value for key, value in data.items() if key != "_id"}
    return json.jsonify(datox)

@app.route("/messages/<int:id>", methods=['DELETE'])
def delete_message(id):
    result = messages.delete_one({"id": id})
    if result.deleted_count == 0:
        abort(400)
    else:
        message = f'Mensaje con id={id} ha sido eliminado'
        return json.jsonify(message)

@app.route("/test")
def test():
    # Obtener un parámero de la URL
    param = request.args.get('name', False)
    print("URL param:", param)

    # Obtener un header
    param2 = request.headers.get('name', False)
    print("Header:", param2)

    # Obtener el body
    body = request.data
    print("Body:", body)

    return "OK"

if __name__ == "__main__":
    app.run()
