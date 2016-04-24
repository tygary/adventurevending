import sys
import BaseHTTPServer
from SimpleHTTPServer import SimpleHTTPRequestHandler
import json

init = {}
init['init'] = {
    'id': 1,
    'thing': 'a'
}

adventures = {}
adventures['adventures'] = [
    {'id': 2, 'title': 'a', 'desc': 'b'},
    {'id': 3, 'title': 'c', 'desc': 'd'}
]

gifts = {}
gifts['gifts'] = [
    {'id': 4, 'title': 'a', 'desc': 'b'},
    {'id': 5, 'title': 'c', 'desc': 'd'}
]



class VendingRequestHandler(SimpleHTTPRequestHandler):

    def do_GET(self):
        #if self.path == '/api/adventures':
        self.send_response(200)
        self.send_header('Content-type', 'application/json')
        self.send_header('Access-Control-Allow-Origin', 'http://localhost:4200')
        self.end_headers()
        if self.path == '/api/init':
            data = json.dumps(init, separators=(',',':'))
            self.wfile.write(data)
        elif self.path == '/api/adventures':
            data = json.dumps(adventures, separators=(',',':'))
            self.wfile.write(data)
        elif self.path.startswith('/api/adventures/'):
            # TODO find the actual adventure
            data = json.dumps({"adventures":[adventures['adventures'][0]]}, separators=(',',':'))
            self.wfile.write(data)
        elif self.path == '/api/gifts':
            data = json.dumps(gifts, separators=(',',':'))
            self.wfile.write(data)
        elif self.path.startswith('/api/gifts/'):
            # TODO find the actual gift
            data = json.dumps({"gifts":[gifts['gifts'][0]]}, separators=(',',':'))
            self.wfile.write(data)

    def do_POST(self):
        self.data_string = self.rfile.read(int(self.headers['Content-Length']))

        self.send_response(200)
        self.send_header('Content-type', 'application/json')
        self.end_headers()

        print self.data_string

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

