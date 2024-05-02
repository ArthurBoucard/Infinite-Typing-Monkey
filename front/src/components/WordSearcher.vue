<template>
  <div class="search">
    <h3>🔍 Search for a word :</h3>
    <input type="text" v-model="searchQuery" @input="updateSearch" placeholder="Search for a word" />
    <p>Total occurrences: <b>{{ wordPos.length == 100 ? "> 100" : wordPos.length == -1 ? 0 : wordPos.length }}</b></p>
  </div>
</template>
  
<script>
  export default {
    name: 'WordSearcher',
    props: {
      initialSearchQuery: String,
      initialText: String
    },
    data() {
      return {
        searchQuery: this.initialSearchQuery,
        wordPos: []
      };
    },
    methods: {
      updateSearch() {
        this.$emit('update:search-query', this.searchQuery);
        this.wordPositions();
      },
      wordPositions() {
        if (this.searchQuery === '') {
          this.wordPos = [];
          this.$emit('word-pos', []);
          return;
        }
        const pos = [];
        let index = this.initialText.indexOf(this.searchQuery);

        while (index !== -1) {
          pos.push(index);
          index = this.initialText.indexOf(this.searchQuery, index + 1);

          if (pos.length >= 100) {
            index = -1;
          }
        }
        console.log(pos);

        this.wordPos = pos;
        this.$emit('word-pos', pos);
      }
    },
    mounted() {
      this.wordPositions();
    }
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
  font-size: 1.5vh;
}

.search p {
  margin-left: 4vh;
  font-size: 1.5vh;
}
</style>
  