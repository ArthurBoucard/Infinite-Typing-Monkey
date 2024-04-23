<template>
  <div id="fulltext">
    <div class="header">
      <img src="./assets/monkey.gif" alt="Monkey" class="gif-monkey" />
      <div class="content">
        <h1>Infinite Typing Monkey</h1>
        <p><a href="https://en.wikipedia.org/wiki/Infinite_monkey_theorem">The Infinite Typing Monkey Theorem</a> states that a monkey hitting keys at random on a typewriter keyboard for an infinite amount of time will almost surely type a given text, such as the complete works of William Shakespeare.</p>
        <div class="column-flex">
          <WordSearcher />
          <div class="router">
            <h3><RouterLink to="/">⌨️ Go to live typing</RouterLink></h3>
          </div>
        </div>
      </div>
    </div>
    <div class="divider"></div>
    <div class="storedText">
      <p>{{ storedText }}</p>
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
  