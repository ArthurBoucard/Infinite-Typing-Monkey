<template>
  <div id="fulltext">
    <div class="header">
      <img src="./assets/monkey.gif" alt="Monkey" class="gif-monkey" />
      <div  v-if="isModalVisible" class="modal-mask">
        <div class="modal">
          <h3>🐒 Go to word</h3>
          <div class="column-flex">
            <img src="./assets/arrow-up.svg" alt="arrow-up" class="arrow" @click="arrowUp" />
            <p>{{ wordNumber }}</p>
            <img src="./assets/arrow-down.svg" alt="arrow-down" class="arrow" @click="arrowDown" />
          </div>
        </div>
      </div>
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
      boldText: '',
      isModalVisible: false,
      wordNumber: 0,
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
        if (this.wordPos.length > 0) {
          this.isModalVisible = true;
        } else {
          this.isModalVisible = false;
        }
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
      },
      arrowUp() {
        let word = document.getElementById('none');

        if (this.wordNumber > 1) {
          this.wordNumber--;
          word = document.getElementById('word-' + this.wordNumber);
          word.scrollIntoView({ behavior: 'smooth' });
        } else {
          this.wordNumber--;  
          window.scrollTo({ top: 0, behavior: 'smooth' });
        }
      },
      arrowDown() {
        let word = document.getElementById('none');

        if (this.wordNumber < this.wordPos.length) {
          this.wordNumber++;
          word = document.getElementById('word-' + this.wordNumber);
          word.scrollIntoView({ behavior: 'smooth' });
        }
      },
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

  .modal-mask {
    position: fixed;
    top: 0;
    left:0;
    right: 0;
    bottom: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 100;
    pointer-events: none;
  }

  .modal {
    position: fixed;
    top: 2vh;
    right: 2vh;
    background-color: #FAFAFA;
    display: flex;
    flex-direction: column;
    align-items: center;
    pointer-events: auto;
    z-index: 101;
  }

  .modal h3 {
    margin: 1vh;
  }

  .arrow {
    width: 2vh;
    margin-left: 2vh;
    margin-right: 2vh;
  }
  
  .arrow:hover {
    cursor: pointer;
  }

</style>
  