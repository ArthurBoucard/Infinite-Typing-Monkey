<template>
  <div class="text-generator">
    <div class="text-area">
      <p>{{ generatedTextPreview }}</p>
    </div>
  </div>
</template>
  
<script>
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
        this.generatedText += getRandomText();
        this.$emit('textGenerated', this.generatedText);
        this.generatedTextPreview = this.generatedText.slice(-10);
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
  