<template>    
  <Navbar />
    <div class="flex flex-col py-10 text-center justify-center mx-auto max-w-4xl">
      <h1 class="text-2xl mt-6 mb-6 font-bold">Links</h1>
      <div class="w-full">
        <form @submit.prevent="submit" class="flex justify-center items-center gap-2">
          
          <div>
          <p>Name:</p>
          <input v-model="form.name" placeholder="Link Name" class="input input-bordered w-full max-w-xs"/>
          <div v-if="form.errors.name">{{ form.errors.name }}</div>
        </div>

        <div>
          <p>Url:</p>
          <input v-model="form.url" placeholder="URL" class="input input-bordered w-full max-w-xs"/>
          <div v-if="form.errors.url">{{ form.errors.url }}</div>
        </div>
  
          <div>
          <p>Image(optional):</p>
          <input type="file" class="file-input file-input-bordered w-full max-w-xs" @input="form.image = $event.target.files[0]" />
          </div>

          <progress v-if="form.progress" :value="form.progress.percentage" max="100">
            {{ form.progress.percentage }}%
          </progress>
          
          <div class="flex items-center content-center justify-center mt-6">
            <button type="submit" :disabled="form.processing" class="btn btn-outline mr-3">
              Add Link
            </button>


          
          </div>
        </form>
      </div>

  
      <div class=" mt-16 w-full items-center justify-center">
        <div v-if="user">
          <p class="text-lg font-bold mb-6">Your Links:</p>
          <ul>
            <li v-for="link in links" :key="link.id">
              <div v-if="editingLinkId === link.id" class="flex flex-col items-center justify-center mx-auto">
                <div class="flex gap-2 mr-4">
                  <input v-model="editForm.name" placeholder="Link Name" class="file-input file-input-bordered max-w-xs" />
                  <div v-if="editForm.errors.name">{{ editForm.errors.name }}</div>
  
                  <input v-model="editForm.url" placeholder="URL" class="file-input file-input-bordered max-w-xs" />
                  <div v-if="editForm.errors.url">{{ editForm.errors.url }}</div>
  
                  <input type="file" @input="editForm.image = $event.target.files[0]" class="file-input file-input-bordered w-full max-w-xs"/>
                </div>
                <div class="flex gap-2 mt-2">
                  <button @click="updateLink(link.id)" class="btn btn-outline">Update</button>
                  <button @click="cancelEdit" class="btn btn-error">Cancel</button>
                </div>
              </div>
  
              <div v-else class="flex mb-6">

              <div class="flex ml-24 w-full gap-2 items-center">
                <img v-if="link.image" :src="link.image" class="w-16 h-16 rounded-full object-cover" alt="Link Image">
                <p class="mr-4 ml-2">{{ link.name }}</p>
                <a :href="link.url" class="mr-4">{{ link.url }}</a>

              </div>

                <div class="flex items-center mr-2">
                  <button @click="editLink(link)" class="btn btn-outline mr-3">Edit</button>
                  <button @click="deleteLink(link.id)" class="btn btn-error">Delete</button>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div v-else>
          Please log in to view links.
        </div>
      </div>
    </div>


  </template>
  
<script setup>
import { useForm, usePage, router } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import Navbar from "@/Components/Navbar.vue";

const page = usePage()
const user = computed(() => page.props.auth.user)
const links = computed(() => user.value ? user.value.links : [])

const form = useForm({
  name: '',
  url: '',
  image: null
})

const editForm = useForm({
  id: null,
  name: '',
  url: '',
  image: null
})

const editingLinkId = ref(null)

function submit() {
  form.post('/links', {
    preserveScroll: true,
    onSuccess: () => {
      form.reset()
      refreshLinks()
    },
    onError: () => {
      console.error("Error submitting the form")
    }
  })
}

function deleteLink(linkId) {
  form.delete(`/links/${linkId}`, {
    onSuccess: () => {
      refreshLinks()
    },
  })
}

function editLink(link) {
  editingLinkId.value = link.id
  editForm.id = link.id
  editForm.name = link.name
  editForm.url = link.url
  editForm.image = null
}

function updateLink(linkId) {
  const formData = new FormData()
  formData.append('name', editForm.name)
  formData.append('url', editForm.url)
  if (editForm.image) {
    formData.append('image', editForm.image)
  }

  editForm.post(`/links/${linkId}`, {
    preserveScroll: true,
    onSuccess: () => {
      editingLinkId.value = null
      editForm.reset()
      refreshLinks()
    },
    onError: () => {
      console.error("Error updating the form")
    }
  })
}

function cancelEdit() {
  editingLinkId.value = null
  editForm.reset()
}

function refreshLinks() {
  page.props.links = user.value.links
}
</script>
