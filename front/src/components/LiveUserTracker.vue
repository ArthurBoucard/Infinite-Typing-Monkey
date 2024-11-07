<template>
    <div>
      <h3>🐒 Active Monkeys: {{ activeUsers }}</h3>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        activeUsers: 0,
        socket: null,
      };
    },
    mounted() {
      this.socket = new WebSocket(process.env.VUE_APP_WS_URL);
  
      this.socket.onmessage = (event) => {
        const data = JSON.parse(event.data);
        this.activeUsers = data.activeUsers;
      };
    },
    beforeUnmount() {
      if (this.socket) {
        this.socket.close();
      }
    },
  };
  </script>
  