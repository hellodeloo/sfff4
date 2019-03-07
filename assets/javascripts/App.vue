<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>


<script>
  import Router from './router'

  let vm = {
    name: 'app',
    delimiters: ['${', '}'],
    router: Router,
  };

  export default vm;
</script>
