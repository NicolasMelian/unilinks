<template>
  <div class="max-w-4xl mx-auto navbar bg-base-100">
    <div class="flex-1">
      <a href="/" class="flex justify-center items-center">
        <img class="h-9 w-9 mr-1" src="/icon.png" />
        <h1 class="text-xl font-bold text-black">Unilinks.bio</h1>
      </a>
    </div>
    <div class="flex-none">
      <ul class="menu menu-horizontal px-1">
        <li v-if="!auth.user"><a href="/register">Register</a></li>
        <li v-if="!auth.user"><a href="/login">Login</a></li>
        <li v-if="auth.user"><a href="/links">Links</a></li>
        <li v-if="auth.user"><a href="/appearance">Appearance</a></li>
      </ul>
    </div>
  </div>
</template>

  
  <script>
  export default {
    computed: {
      auth() {
        console.log(this.$page.props.auth); // Agrega esta línea para depuración
        return this.$page.props.auth;
      }
    }
  }
  </script>
  