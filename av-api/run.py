import sys
import BaseHTTPServer
from SimpleHTTPServer import SimpleHTTPRequestHandler
import json
import unicodedata

adventures = {}
adventures['adventures'] = [
    {'id': '2', 'title': 'a', 'desc': 'b'},
    {'id': '3', 'title': 'c', 'desc': 'd'}
]

gifts = {}
gifts['gifts'] = [
    {'id': '4', 'title': 'a', 'desc': 'b'},
    {'id': '5', 'title': 'c', 'desc': 'd'}
]

init = {}
init['init'] = {
    'id': '1',
    'thing': 'a',
    # 'adventures': ['2','3'],
    # 'gifts': ['4', '5']
}
# init['adventures'] = [
#     {'id': '2', 'title': 'a', 'desc': 'b', 'init': '1'},
#     {'id': '3', 'title': 'c', 'desc': 'd', 'init': '1'}
# ]
# init['gifts'] = [
#     {'id': '4', 'title': 'a', 'desc': 'b', 'init': '1'},
#     {'id': '5', 'title': 'c', 'desc': 'd', 'init': '1'}
# ]



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
            adventures_data = json.dumps(adventures, separators=(',',':'))
            self.wfile.write(adventures_data)
        elif self.path.startswith('/api/adventures/'):
            # TODO find the actual adventure
            adventure_data = json.dumps({"adventures":[adventures['adventures'][0]]}, separators=(',',':'))
            self.wfile.write(adventure_data)
        elif self.path == '/api/gifts':
            gifts_data = json.dumps(gifts, separators=(',',':'))
            self.wfile.write(gifts_data)
        elif self.path.startswith('/api/gifts/'):
            # TODO find the actual gift
            gift_data = json.dumps({"gifts":[gifts['gifts'][0]]}, separators=(',',':'))
            self.wfile.write(gift_data)

    def do_POST(self):
        self._set_headers()
        self.send_header('Content-type', 'application/json')
        self.end_headers()

        data_string = self.rfile.read(int(self.headers['Content-Length']))
        post_data = self._json_loads_byteified(data_string)

        if post_data.has_key('adventure'):
            adventures['adventures'].append(post_data['adventure'])
        elif post_data.has_key('gift'):
            gifts['gifts'].append(post_data['gift'])

        self.wfile.write('{}')

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
            adventure_record = [x for x in adventures['adventures'] if x['id'] == record_id][0]
            adventures['adventures'].remove(adventure_record)
        elif params[2] == 'gifts':
            gift_record = [x for x in gifts['gifts'] if x['id'] == record_id][0]
            gifts['gifts'].remove(gift_record)

        self.wfile.write('{}')


HandlerClass = VendingRequestHandler
ServerClass  = BaseHTTPServer.HTTPServer
Protocol     = "HTTP/1.0"

if sys.argv[1:]:
    port = int(sys.argv[1])
else:
    port = 8000
server_address = ('127.0.0.1', port)

HandlerClass.protocol_version = Protocol
httpd = ServerClass(server_address, HandlerClass)

sa = httpd.socket.getsockname()
print "Serving HTTP on", sa[0], "port", sa[1], "..."
httpd.serve_forever()

