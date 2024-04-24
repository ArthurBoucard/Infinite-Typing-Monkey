<template>
  <div id="fulltext">
    <div class="header">
      <img src="./assets/monkey.gif" alt="Monkey" class="gif-monkey" />
      <div class="content">
        <h1>Infinite Typing Monkey</h1>
        <p><a href="https://en.wikipedia.org/wiki/Infinite_monkey_theorem">The Infinite Typing Monkey Theorem</a> states that a monkey hitting keys at random on a typewriter keyboard for an infinite amount of time will almost surely type a given text, such as the complete works of William Shakespeare.</p>
        <div class="column-flex">
          <WordSearcher 
            :initial-search-query="searchQuery" 
            :initial-text="storedText"
            @update:search-query="handleSearchQueryUpdate"
            @word-pos="wordPositions"
          />
          <div class="router">
            <h3><RouterLink to="/">⌨️ Go to live typing</RouterLink></h3>
          </div>
        </div>
      </div>
    </div>
    <div class="divider"></div>
    <div class="storedText">
      <p v-html="wordPos.length > 0 ? this.boldText : this.storedText"></p>
    </div>
  </div>
</template>
  
<script>
import WordSearcher from './components/WordSearcher.vue';
  import axios from 'axios';
  
  export default {
    name: 'FullText',
    components: {
      WordSearcher,
    },
    data: () => ({
      input: "",
      storedText: "",
      searchQuery: '',
      wordPos: [],
      boldText: ''
    }),
    mounted() {
      let apiText = '';
      axios.get('http://127.0.0.1:8000/text')
        .then((response) => {
          response.data.forEach(element => {
            apiText += element.content
          });
          apiText = apiText.match(/.{1,205}/g).join('\n');
  
          this.storedText = apiText;
        })
        .catch((error) => {
          console.error(error);
        });
      window.addEventListener('scroll', this.handleScroll);
    },
    methods: {
      handleSearchQueryUpdate(newQuery) {
        this.searchQuery = newQuery;
      },
      wordPositions(pos) {
        this.wordPos = pos;
        this.formattedText();
      },
      formattedText() {
        const textArray = this.storedText.split('');
        for (let i = 0, a = 1; i < this.wordPos.length; i++) {
          const index = this.wordPos[i];
          if (textArray[index]) {
            textArray[index] = `<b><a id="word-${a}">${textArray[index]}`;
            textArray[index + this.searchQuery.length - 1] = `${textArray[index + this.searchQuery.length - 1]}</a></b>`;
            a++;
          }
        }
        this.boldText = textArray.join('');
      }
    },
  };
</script>
  
<style>
  #fulltext {
    margin: 0;
    padding: 0;
    background-color: #ffcc99;
    height: 100%;
    font-size: 1.8vh;
    font-family: monospace;
  }
  
  .divider {
    width: 98%;
    margin-left: 1%;
    margin-top: 1vh;
    height: 2px;
    background-color: #000;
  }

  .header {
    display: flex;
    align-items: center;
  }
  
  .gif-monkey {
    width: 30vh;
    height: auto;
    margin-right: 2vh;
  }
  
  .content {
    flex: 1;
  }
  
  .column-flex {
    display: flex;
    flex-direction: row;
    margin-top: 3vh;
  }

  .router {
    margin-left: 5vh;
  }
  
  .storedText {
    margin: 2vh;
    width: 203vh;
    word-break: break-all;
    overflow-wrap: break-word;
    white-space: pre-wrap;
  }
  </style>
  