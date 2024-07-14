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
        
        <li>
        <form v-if="auth.user" class="flex" @submit.prevent="logout">
          <button class="mt-4 lg:inline-block lg:mt-0 hover:text-gray-600">Log out</button>
        </form>
      </li>

      </ul>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { usePage, router } from '@inertiajs/vue3';

const { props } = usePage();
const auth = computed(() => props.auth);

const logout = async () => {
    await router.post(
        route("logout"),
        {},
        {
            preserveState: false, // Esta opción fuerza a Inertia a recargar completamente el estado de la página
            onSuccess: () => {
                isAuthenticated.value = false; // Actualiza el estado de autenticación
                router.replace("/"); // Opcional: redirige al usuario a la página de inicio de sesión
            },
        }
    );
};

console.log(auth.value); // Agrega esta línea para depuración
</script>

  