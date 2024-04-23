<template>
  <div class="search">
    <h3>🔍 Search for a word :</h3>
    <input type="text" v-model="input" placeholder="Search for a word" />
  </div>
</template>
  
<script>
  export default {
    name: 'WordSearcher',
  };
</script>

<style scoped>
.search {
  margin-left: 5vh;
}

.search input {
  margin-left: 4vh;
  width: 20vh;
  height: 2.2vh;
}
</style>
  