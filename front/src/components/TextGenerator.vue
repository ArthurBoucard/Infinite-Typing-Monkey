<template>
  <div class="text-generator">
    <div class="text-area">
      <p>{{ generatedTextPreview }}</p>
    </div>
  </div>
</template>
  
<script>
  import axios from 'axios';

  export default {
    name: 'TextGenerator',
    data() {
      return {
        generatedText: '',
        generatedTextPreview: '',
      };
    },
    mounted() {
      this.generateText();
      this.interval = setInterval(this.generateText, 10);
    },
    beforeUnmount() {
      clearInterval(this.interval);
    },
    methods: {
      generateText() {
        const apiUrl = process.env.VUE_APP_API_URL;

        this.generatedText += getRandomText();
        this.$emit('textGenerated', this.generatedText);
        this.generatedTextPreview = this.generatedText.slice(-10);

        if (this.generatedText.length % 255 === 0) {
          axios.post(`${apiUrl}/stats/text`, {
            content: this.generatedText.slice(-255)
          })
            .then((response) => {
              console.log(response);
            })
            .catch((error) => {
              console.error(error);
            });
        }
      }
    }
  };
  
  function getRandomText() {
    // const text = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789      -.,;:!?()';
    const text = 'abcdefghijklmnopqrstuvwxyz';
    return Array.from({ length: 1 }, () => text[Math.floor(Math.random() * text.length)]).join('');
  }
</script>

<style scoped>
  /* .text-generator {
  }
  
  .text-area {
  } */
</style>
  