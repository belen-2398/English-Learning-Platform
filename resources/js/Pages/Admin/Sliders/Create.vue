
<template>
    <Head title="Create Slider" />
    <div class="m-6 p-4 flex justify-between">
        <h3 class="font-semibold text-xl text-gray-600 ml-10">Add slider
        </h3>
        <Link href="/admin/sliders" class="color-button float-end font-semibold">Back</Link>
    </div>
    
    <form class="w-full max-w-sm m-auto justify-center" @submit.prevent="form.post(route('sliders.store'))">
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="title">
                    Title
                </label>
            </div>
            <div class="md:w-2/3">
                <input v-model="form.title" type="text" id="title"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                <div v-if="errors.title">{{ errors.title }}</div>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="description">
                    Description
                </label>
            </div>
            <div class="md:w-2/3">
                <textarea v-model="form.description" type="text" id="description" rows="3"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </textarea>
                <div v-if="errors.description">{{ errors.description }}</div>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="image">
                    Images
                </label>
            </div>
            <div class="md:w-2/3">
                <input type="file" id="image" @input="form.image = $event.target.files" accept="image/jpg, image/jpeg, image/png" multiple 
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                <div v-if="errors.image">{{ errors.image }}</div>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3"></div>
            <label class="md:w-2/3 block text-gray-500 font-bold" for="status">
                Status
                <br />
                <input v-model="form.status" type="checkbox" id="status" class="mr-2 leading-tight">
                <span class="text-sm"> <br />
                    Checked = Hidden, Unchecked = Visible
                </span>
                <div v-if="errors.status">{{ errors.status }}</div>
            </label>
        </div>
        <div class="md:flex md:items-center">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3">
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>
                <div class="color-button font-semibold text-center">
                    <button type="button" :disabled="form.processing" >
                        Create
                    </button>
                </div>
            </div>
        </div>
    </form>
    
   
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';

    export default {
        name: 'Create Slider',
        components: {
            Head, Link
        },
        layout: AdminLayout,
        props: {
            errors: Object
        },
        setup() {
            const form = useForm({
                title: '',
                description: '',
                image: [],
                status: '0'
            })

            return { form }
        }
    };
</script>
