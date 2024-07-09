<template>
  <Head :title="appearance.profile_title" />

  <Navbar />

  <div :class="themeClass" class="flex items-center flex-col h-screen justify-center mx-auto">
    <div class="text-center">
        <img :src="appearance.profile_image" class="w-24 h-24 rounded-full object-cover mx-auto" alt="Profile Image">
        <h1 class="mt-6 text-3xl font-bold">{{ appearance.profile_title }}</h1>
        <p>{{ appearance.bio }}</p>
      </div>
  
      <div class="mt-8 flex items-center justify-center">
      <ul>
        <li v-for="link in links" :key="link.id" class="relative my-4">
          <a :href="link.url" target="_blank" class="relative flex py-2 bg-neutral hover:bg-accent-content hover:grow  hover:scale-105 transition-transform duration-200 items-center w-96 px-2 pt-3 pb-3  border border-black rounded font-bold">
            <img v-if="link.image" :src="link.image" class="absolute left-3 w-10 h-10 flex-shrink-0 rounded-full object-cover" alt="Link Image">
            <p class="w-full text-white text-center text-lg">{{ link.name }}</p>
          </a>
        </li>
      </ul>
    </div>



    </div>
  </template>
  
  <script setup>
  import { computed } from 'vue'
  import { usePage, Head } from '@inertiajs/vue3'
import Navbar from "@/Components/Navbar.vue";
  
  const page = usePage()
  const appearance = computed(() => page.props.appearance)
  const links = computed(() => page.props.links)


// Computed property to determine the theme class
const themeClass = computed(() => {
  return appearance.value?.theme ? appearance.value.theme : ''
})
  </script>
  

  <style>
  /* Puedes agregar estas clases en tu archivo CSS principal o dentro de <style> en el componente Vue */
.theme1 {
  background-image: url('/images/themes/theme1.png');
  background-size: cover;
  background-position: center;
}

.theme2 {
  background-image: url('/images/themes/theme2.png');
  background-size: cover;
  background-position: center;
}

.theme3 {
  background-image: url('/images/themes/theme3.png');
  background-size: cover;
  background-position: center;
}


</style>