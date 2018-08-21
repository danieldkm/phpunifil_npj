self.addEventListener('message', function(e) {
  
  var data = e.data;
  switch (data.cmd) {
    case 'start':
//      self.postMessage('WORKER STARTED: ' + data.msg);
//      popularTabela(data.clientes);
      break;
    case 'stop':
      self.postMessage('WORKER STOPPED: ' + data.msg + '. (buttons will no longer work)');
      self.close(); // Terminates the worker.
      break;
    default:
      self.postMessage('Unknown command: ' + data.msg);
  };
}, false);

function arrayElements(element, index, array) {
//    console.log("a[" + index + "] = " + element.NM_CLIENTE);
    self.postMessage(element);
}

function popularTabela(clientes){
    clientes.forEach(arrayElements);
}


//popularTabela(data.clientes);