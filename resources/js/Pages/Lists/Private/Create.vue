<template>
    <Head title="Create a new list"/>

    <AuthenticatedLayout>
        <div class="mx-auto max-w-md sm:max-w-lg md:max-w-xl lg:max-w-4xl">
            <div class="mt-4">
                <div class="mt-5 md:mt-0">
                    <div class="shadow sm:overflow-hidden sm:rounded-md">
                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <InputLabel value="List name" />
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <TextInput
                                            placeholder="Name"
                                            v-model="form.name"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <InputLabel value="Short description" />
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <TextInput
                                            v-model="form.excerpt"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="sm:col-span-6">
                                <InputLabel value="Description" />
                                <div class="mt-1">
                                    <textarea
                                        id="about" name="about" rows="8"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        v-model="form.description"
                                    />
                                </div>
                            </div>
                            <InputLabel value="Thumbnail" />
                            <div class="relative overflow-hidden w-40 lg:block">
                                <img
                                    class="relative h-40 w-40"
                                    :src="thumbnailPreview || defaultThumbnail"
                                    alt=""
                                />
                                <label for="desktop-user-photo" class="absolute inset-0 flex h-full w-full items-center justify-center bg-black bg-opacity-75 text-sm font-medium text-white opacity-0 focus-within:opacity-100 hover:opacity-100">
                                    <span>Choose</span>
                                    <span class="sr-only"> user photo</span>
                                    <input
                                        type="file"
                                        id="desktop-user-photo"
                                        name="user-photo"
                                        class="absolute inset-0 h-full w-full cursor-pointer rounded-md border-gray-300 opacity-0"
                                        @change="changeThumbnail($event.target.files[0])"
                                    />
                                </label>
                            </div>
                        </div>
                    </div>
                    <button
                        type="submit"
                        class="my-4 inline-flex py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        @click="create"
                    >
                        Create
                    </button>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>

<script>
import {Head, useForm} from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/FormElements/TextInput.vue";
import InputLabel from "@/Components/FormElements/InputLabel.vue";
export default {
    name: "Create",
    components: {
        InputLabel,
        TextInput,
        Head,
        AuthenticatedLayout
    },
    data () {
        return {
            defaultThumbnail: '/images/list.png',
            thumbnailPreview: null,
        }
    },
    setup() {
        const form = useForm(
            {
                name: '',
                excerpt: '',
                description: '',
                thumbnail: null
            });

        return {form}
    },
    methods: {
        changeThumbnail(file) {
            this.thumbnailPreview = URL.createObjectURL(file);
            this.form.thumbnail = file;
        },
        create() {
            this.form.post(route('lists.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.$inertia.reload();
                }
            });
        }
    }
}
</script>
