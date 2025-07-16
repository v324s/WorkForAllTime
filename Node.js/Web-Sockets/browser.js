if (!window.WebSocket) {
	document.body.innerHTML = 'WebSocket в этом браузере не поддерживается.';
}
var socket;


// Отключиться
document.forms.connect.onsubmit = function() {
  socket.close();
};

// Подключиться
document.forms.connect.onsubmit = function() {
  id = this.id.value;
  name = this.name.value;
  socket = new WebSocket(`ws://localhost:8081/?name=${name}&id=${id}`);

  // обработчик входящих сообщений
  socket.onmessage = function(event) {
    incomingMessage = event.data;
    showMessage(incomingMessage); 
  };
  return false;
};

// отправить сообщение из формы publish
document.forms.publish.onsubmit = function() {
  var outgoingMessage = this.message.value;

  socket.send(JSON.stringify({"author":this.name.value,"text":outgoingMessage}));
  return false;
};


var mess
function showMessage(message) {
  var messageElem = document.createElement('div');
  mess = JSON.parse(message);
  console.log(message);
  //newBuffer = bufferFromBufferString(mess['message']['data']);
  messageElem.appendChild(document.createTextNode(mess["author"]+": "+mess["message"]));
  document.getElementById('subscribe').prepend(messageElem);
}
