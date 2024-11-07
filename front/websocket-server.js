const WebSocket = require('ws');
require('dotenv').config({ path: '.env.local' });

const wss = new WebSocket.Server({ port: process.env.VUE_APP_WS_PORT });

let activeUsers = 0;

wss.on('connection', (ws) => {
  activeUsers++;
  console.log(`New connection. Active users: ${activeUsers}`);

  wss.clients.forEach((client) => {
    if (client.readyState === WebSocket.OPEN) {
      client.send(JSON.stringify({ activeUsers }));
    }
  });

  ws.on('close', () => {
    activeUsers--;
    console.log(`User disconnected. Active users: ${activeUsers}`);

    wss.clients.forEach((client) => {
      if (client.readyState === WebSocket.OPEN) {
        client.send(JSON.stringify({ activeUsers }));
      }
    });
  });
});

console.log('WebSocket server is running on port ' + process.env.VUE_APP_WS_PORT);
