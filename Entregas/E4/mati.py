from flask import Flask, render_template, request, abort, json
from pymongo import MongoClient

URL = "mongodb://grupo59:grupo59@gray.ing.puc.cl/grupo59"
client = MongoClient(URL)
db = client.get_database()
messages = db.messages

# Iniciamos la aplicación de flask
app = Flask(__name__)


@app.route("/messages/<int:uid>")
def get_messsage(uid):
    shown = list(messages.find({"id": uid}, {"_id": 0}))
    return json.jsonify(shown)

@app.route("/messages/project-search")
def project_search():
    param = request.args.get('nombre', False)
    resultado = list(messages.find({"$or": [{"metadata.sender": param},
            {"metadata.receiver": param}]}, {"_id": 0}))
    return json.jsonify(resultado)


@app.route("/messages/content-search")
def content_search():
    if not request.json:
        abort(400)
    
    desired = request.json["desired"]
    required = request.json["required"]
    forbidden = request.json["forbidden"]

    if not (desired or required or forbidden):
        found = list(messages.find({}, {"_id": 0}))
    else:
        desired = " ".join(desired)
        required = "" .join("\"{}\"".format(r) for r in required)
        forbidden = " ".join("-{}".format(f) for f in forbidden)

        search_query = "{} {} {}".format(desired, required, forbidden)
        
        found = list(messages.find({"$text": {"$search": search_query}}, {"_id": 0}))
    
    return json.jsonify(found)


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


if __name__ == "__main__":
    app.run()
