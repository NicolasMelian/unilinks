<template>
      <Navbar />

  <div class="flex flex-col max-w-5xl flex-row mx-auto justify-center mt-10 mb-20">
    
    <h1 class="text-2xl text-center items-center font-bold mb-8 mt-6">Appearance</h1>

    <div class="flex mt-10 mb-10 items-center justify-center">
      <p class="mr-4 font-bold text-lg">Your Landing Page: </p>
      <a class="btn btn-neutral" :href="`/${appearance.slug}`">/{{appearance.slug}}</a>
    </div>

    <div class="flex flex-col md:flex-row">
    <div class="flex-1">
      <form @submit.prevent="submit" class="flex flex-col gap-6 items-center justify-center">

        <div class="w-full">
          <label for="slug" class="text-lg font-bold">Slug: </label>
          <input id="slug" v-model="form.slug" placeholder="Slug" class="mt-2 mb-2 input input-bordered w-full max-w-xs" />
          <div v-if="form.errors.slug">{{ form.errors.slug }}</div>
        </div>
  
        <div class="w-full">
        <label for="profile_image" class="text-lg font-bold">Profile Image: </label>
        <div v-if="appearance && appearance.profile_image" class="mb-2 mt-2">
          <img :src="appearance.profile_image" class="w-24 h-24 rounded-full object-cover" alt="Profile Image">
        </div>        
        <input type="file" @input="form.profile_image = $event.target.files[0]" class="mt-2 mb-2 file-input file-input-bordered w-full max-w-xs"/>
      </div>
  
        <div class="w-full">
          <label for="profile_title" class="text-lg font-bold">Profile Title: </label>
          <input id="profile_title" v-model="form.profile_title" placeholder="Profile Title" class="mt-2 mb-2 input input-bordered w-full max-w-xs" />
          <div v-if="form.errors.profile_title">{{ form.errors.profile_title }}</div>
        </div>
  
        <div class="w-full flex flex-col">
          <label for="bio" class="text-lg font-bold">Bio: </label>
          <input id="bio" v-model="form.bio" placeholder="Bio" class="mt-2 mb-2 input input-bordered w-full max-w-xs" />
          <div v-if="form.errors.bio">{{ form.errors.bio }}</div>
        </div>
        <div class="w-full">
          <label for="theme" class="text-lg font-bold">Theme: </label>
          <div class="flex gap-2 mt-2 mb-2">
            <div v-for="theme in themes" :key="theme.name" class="theme-option">
              <img :src="theme.image" @click="setTheme(theme.name)" :class="{'border-2 w-24 rounded border-primary-content': form.theme === theme.name}" class="w-24 h-24 object-cover cursor-pointer">
            </div>
          </div>
          <div v-if="form.errors.theme">{{ form.errors.theme }}</div>
        </div>
  
        <button type="submit" class="btn btn-neutral w-full justify-center text-center items-center" :disabled="form.processing">Save</button>
      </form>
    </div>
    <div class="flex-1 mx-auto justify-center items-center text-center">
        
         <!-- Vista previa con tema aplicado -->
        <div class="mockup-phone">
          <div class="camera"></div>
          <div class="display">
          <div :class="themeClass" class="artboard artboard-demo bg-cover phone-1">
          <h2 class="text-xl font-bold mb-4">Live Preview</h2>
          <img :src="appearance.profile_image" class="w-24 h-24 rounded-full object-cover mx-auto" alt="Profile Image">
          <h3 class="text-lg font-semibold">{{ form.profile_title }}</h3>
          <p>{{ form.bio }}</p>

          <div class="mt-8 flex items-center justify-center">
            <ul>
              <li v-for="link in links" :key="link.id" class="relative my-2">
                <a :href="link.url" target="_blank" class="relative flex py-2 bg-neutral hover:bg-accent-content hover:grow  hover:scale-105 transition-transform duration-200 items-center w-72 px-2 pt-2 pb-2  border rounded font-bold">
                  <img v-if="link.image" :src="link.image" class="absolute left-2 w-10 h-10 flex-shrink-0 rounded-full object-cover" alt="Link Image">
                  <p class="w-full text-white text-center">{{ link.name }}</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
        </div>
      </div>
    </div>
  </div>

  </template>
  
  <script setup>
  import { useForm, usePage } from '@inertiajs/vue3'
  import { computed, watch } from 'vue'
import Navbar from "@/Components/Navbar.vue";
  
  const page = usePage()
  const appearance = computed(() => page.props.appearance)
  const links = computed(() => page.props.links) // Asume que los enlaces se pasan como prop


  // Inicializa el formulario con los valores de la apariencia actual
  const form = useForm({
    slug: appearance.value?.slug || '',
    profile_image: null,
    profile_title: appearance.value?.profile_title || '',
    bio: appearance.value?.bio || '',
    theme: appearance.value?.theme || '',
  })

  const themes = [
  { name: 'theme1', image: '/images/themes/theme1.png' },
  { name: 'theme2', image: '/images/themes/theme2.png' },
  { name: 'theme3', image: '/images/themes/theme3.png' },
]

  function setTheme(theme) {
  form.theme = theme
}
  
  // Actualiza los valores del formulario cuando la apariencia cambia
  watch(appearance, (newAppearance) => {
    form.profile_title = newAppearance?.profile_title || ''
    form.bio = newAppearance?.bio || ''
    form.theme = newAppearance?.theme || ''
    form.slug = newAppearance?.slug || ''
  })
  
  function submit() {
    if (appearance.value && appearance.value.id) {
      form.post(`/appearances/${appearance.value.id}`, {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => {
          form.reset('profile_image')
        },
        data: {
          _method: 'patch'
        }
      })
    } else {
      form.post('/appearances', {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => {
          form.reset('profile_image')
        }
      })
    }
  }

  // Computed property to determine the theme class
const themeClass = computed(() => {
  return appearance.value?.theme ? appearance.value.theme : ''
})
  </script>
  <style>
  .theme1 {
    background-image: url('/images/themes/theme1.png');
    background-position: center;
  }
  
  .theme2 {
    background-image: url('/images/themes/theme2.png');
    background-position: center;
  }
  
  .theme3 {
    background-image: url('/images/themes/theme3.png');
    background-position: center;
  }
  </style>
  