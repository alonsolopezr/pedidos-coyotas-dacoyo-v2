<template>
  <div>
   <qr-capture @decode="onDecode" class="mb"></qr-capture>
<div class="result">
  Result: {{data}}
</div>
  </div>
</template>

<script>

// globally
import { createApp } from 'vue';
import App from './App.vue'
import QrReader from 'vue3-qr-reader';
const app = createApp(App);
app.use(QrReader);
app.mount('#app')

// Locally
import { QrStream, QrCapture, QrDropzone } from 'vue3-qr-reader';

export default {
  components: {
    QrStream,
    QrCapture,
    QrDropzone
  },
};

export default defineComponent({
  name: 'QrCaptureExample',
  components: {
    QrCapture
  },
  setup() {
    const state = reactive({
      data: null
    })
    function onDecode(data) {
      state.data = data
    }
    return {
      ...toRefs(state),
      onDecode
    }
  }
});
</script>
