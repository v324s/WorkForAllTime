var http = require('http');
var Static = require('node-static');
var WebSocketServer = new require('ws');

var clients = new Map();
var webSocketServer = new WebSocketServer.Server({port: 8081});

webSocketServer.on('connection', function(ws, req) {
  url = new URL(req.url, `http://${req.headers.host}`);  
  ws.user = {
    id: url.searchParams.get('id'),
    name: url.searchParams.get('name')
  };
  clients.set(ws.user.id, ws);

  console.log(`✔️ ${ws.user.name}(${ws.user.id}) connected.`);
  clients.forEach((client) => {
    if (client.readyState === WebSocketServer.OPEN) {
      client.send(JSON.stringify({
        author: 'SYSTEM',
        message: `✔️ ${ws.user.name}(${ws.user.id}) connected.`
      }));
    }
  });

  ws.on('message', function(message) {
    message=JSON.parse(message);
    if (message.text=='/getUsers'){
      console.log(`Список пользователей (${clients.size}):`);
      let index = 1;
      clients.forEach((client, id) => {
        console.log(`${index}. ${client.user.name} (${id})`);
        index++;
      });
    }else{
      console.log(`🗨 ${ws.user.name}: ${message.text}`);
      clients.forEach((client) => {
        if (client.readyState === WebSocketServer.OPEN) {
          client.send(JSON.stringify({
            author: ws.user.name,
            message: message.text
          }));
        }
      });
    }
  });

  ws.on('close', function() {
    console.log(`❌ ${ws.user.name}(${ws.user.id}) disconnected.`);
    clients.delete(ws.user.id)
  });

});


// статический сервер
var fileServer = new Static.Server('.');
http.createServer(function (req, res) { 
  fileServer.serve(req, res);
}).listen(8080);

console.log("Сервер запущен на портах 8080 (HTTP), 8081 (WebSocket)");

