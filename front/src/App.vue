<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style>
  body, html, #app {
    margin: 0;
    padding: 0;
    background-color: #ffcc99;
    height: 100%;
    font-size: 1.8vh;
    font-family: monospace;
  }
</style>
