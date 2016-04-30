import sys
import BaseHTTPServer
from SimpleHTTPServer import SimpleHTTPRequestHandler
import json
import unicodedata
from threading import Thread
import os

tmpfilepath = os.path.join(os.path.dirname(__file__), 'avdatatmp')

av_data = {}
av_data['adventures'] = []
av_data['gifts'] = []
av_data['slots'] = []

init = {}
init['init'] = {
    'id': '1',
    'thing': 'a'
}



class VendingRequestHandler(SimpleHTTPRequestHandler):



    def _set_headers(self):
        self.send_response(200)
        self.send_header('Access-Control-Allow-Origin', 'http://localhost:4200')
        self.send_header('Access-Control-Allow-Headers', 'Content-type')

    def _json_loads_byteified(self, json_text):
        return self._byteify(
            json.loads(json_text, object_hook=self._byteify),
            ignore_dicts=True
        )

    def _onchange(self):
        try:
            os.remove(tmpfilepath)
        except OSError:
            pass
        f = open(tmpfilepath, 'w')
        f.write(json.dumps(av_data, separators=(',',':')))
        f.close()

    def _byteify(self, data, ignore_dicts = False):
        # if this is a unicode string, return its string representation
        if isinstance(data, unicode):
            return data.encode('utf-8')
        # if this is a list of values, return list of byteified values
        if isinstance(data, list):
            return [ self._byteify(item, ignore_dicts=True) for item in data ]
        # if this is a dictionary, return dictionary of byteified keys and values
        # but only if we haven't already byteified it
        if isinstance(data, dict) and not ignore_dicts:
            return {
                self._byteify(key, ignore_dicts=True): self._byteify(value, ignore_dicts=True)
                for key, value in data.iteritems()
            }
        # if it's anything else, return it in its original form
        return data

    def do_GET(self):
        self._set_headers()
        self.send_header('Content-type', 'application/json')
        self.end_headers()
        if self.path == '/api/init':
            init_data = json.dumps(init, separators=(',',':'))
            self.wfile.write(init_data)
        elif self.path == '/api/adventures':
            adventures_data = json.dumps(av_data['adventures'], separators=(',',':'))
            self.wfile.write('{"adventures":' + adventures_data + '}')
        elif self.path.startswith('/api/adventures/'):
            # TODO find the actual adventure
            # adventure_data = json.dumps({"adventures":[adventures['adventures'][0]]}, separators=(',',':'))
            # self.wfile.write(adventure_data)
            self.wfile.write('{}')
        elif self.path == '/api/gifts':
            gifts_data = json.dumps(av_data['gifts'], separators=(',',':'))
            self.wfile.write('{"gifts":' + gifts_data + '}')
        elif self.path.startswith('/api/gifts/'):
            # TODO find the actual gift
            # gift_data = json.dumps({"gifts":[gifts['gifts'][0]]}, separators=(',',':'))
            # self.wfile.write(gift_data)
            self.wfile.write('{}')
        elif self.path == '/api/slots':
            slots_data = json.dumps(av_data['slots'], separators=(',',':'))
            self.wfile.write('{"slots":' + slots_data + '}')

    def do_POST(self):
        self._set_headers()
        self.send_header('Content-type', 'application/json')
        self.end_headers()

        data_string = self.rfile.read(int(self.headers['Content-Length']))
        post_data = self._json_loads_byteified(data_string)

        if post_data.has_key('adventure'):
            av_data['adventures'].append(post_data['adventure'])
        elif post_data.has_key('gift'):
            av_data['gifts'].append(post_data['gift'])
        elif post_data.has_key('slot'):
            av_data['slots'].append(post_data['slot'])

        self.wfile.write('{}')
        self._onchange()

    def do_OPTIONS(self):
        self._set_headers()
        # Send empty JSON object to appease ember
        self.send_header("Content-Length", 0)
        # Ember will only make OPTIONS requests when asking to delete
        self.send_header("Access-Control-Allow-Methods", "DELETE,POST")
        self.end_headers()

    def do_DELETE(self):
        self._set_headers()
        self.send_header('Content-type', 'application/json')
        self.end_headers()

        # get id
        params = self.path.split('/')
        record_id = params[3]

        if params[2] == 'adventures':
            adventure_record = [x for x in av_data['adventures'] if x['id'] == record_id][0]
            av_data['adventures'].remove(adventure_record)
        elif params[2] == 'gifts':
            gift_record = [x for x in av_data['gifts'] if x['id'] == record_id][0]
            av_data['gifts'].remove(gift_record)
        elif params[2] == 'slots':
            slot_record = [x for x in av_data['slots'] if x['id'] == record_id][0]
            av_data['slots'].remove(slot_record)

        self.wfile.write('{}')
        self._onchange()


try:
    with open(tmpfilepath) as data_file:
        av_data = json.load(data_file)
except IOError:
    pass


HandlerClass = VendingRequestHandler
ServerClass  = BaseHTTPServer.HTTPServer
Protocol     = "HTTP/1.0"

if sys.argv[1:]:
    port = int(sys.argv[1])
else:
    port = 8080
server_address = ('127.0.0.1', port)

HandlerClass.protocol_version = Protocol
httpd = ServerClass(server_address, HandlerClass)

sa = httpd.socket.getsockname()
print "Serving HTTP on", sa[0], "port", sa[1], "..."
def start_server():
    httpd.serve_forever()
thread = Thread(target = start_server)
thread.start()
