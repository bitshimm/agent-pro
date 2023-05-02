<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { useForm } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue';
import WysiwigTextarea from "@/Components/WysiwigTextarea.vue";
// import Editor from '@tinymce/tinymce-vue'
const form = useForm({
    title: null,
    content: null,
    sort: 100,
    visibility: 1
})

</script>
<template>
    <DashboardLayout>
        <form @submit.prevent="form.post(route('articles.store'))">
            <label for="title">title:</label>
            <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus />
            
            <!-- <input id="title" v-model="form.title" /> -->
            <label for="content">Content:</label>
            <WysiwigTextarea v-model="form.content" id="content" />
            <!-- <Editor api-key="no-api-key" :init="{
                    height: 500,
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar:
                        'undo redo | formatselect | bold italic backcolor | \
                       alignleft aligncenter alignright alignjustify | \
                       bullist numlist outdent indent | removeformat | help'
                }" v-model="form.content" id="content" /> -->
            <label for="sort">Sort:</label>
            <input id="sort" v-model="form.sort" />
            <label for="visibility">Visibility:</label>
            <input id="visibility" v-model="form.visibility" />
            <button type="submit">Submit</button>
        </form>
    </DashboardLayout>
</template>
