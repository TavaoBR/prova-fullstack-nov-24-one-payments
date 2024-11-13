<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>

<div id="app">
  <h1>{{ message }}</h1>
</div>



<script type="module">
const { createApp, ref } = Vue

createApp({
  setup() {
    const message = ref('Hello World!')
    return { message }
  }
}).mount('#app')
</script>

</body>
</html>
