<template>
    <Head :title="list.name" />
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
                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <InputLabel value="Visibility" />
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <select
                                            v-model="form.status"
                                            class="block w-full flex-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        >
                                            <option value="public">Public</option>
                                            <option value="private">Private</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <InputLabel value="Thumbnail" />
                            <div class="relative overflow-hidden w-40 lg:block">
                                <img
                                    class="relative h-40 w-40"
                                    :src="thumbnailPreview || this.list.thumbnail"
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
                            <div class="flex items-center gap-4">
                                <PrimaryButton
                                    class="ml-4 mb-4"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                    @click.prevent="update"
                                >
                                    Save
                                </PrimaryButton>

                                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                    <p v-if="form.recentlySuccessful" class="text-sm text-green-400">Profile Saved.</p>
                                </Transition>

                                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                    <p v-if="form.isDirty" class="text-sm text-red-400">Unsaved Changes.</p>
                                </Transition>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import {Head, useForm} from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
    name: "Edit",
    components: {
        PrimaryButton,
        InputLabel,
        TextInput,
        Head,
        AuthenticatedLayout
    },
    props: {
        list: {
            type: Object,
            required: true
        }
    },
    data () {
        return {
            thumbnailPreview: null,
        }
    },
    setup(props) {
        const values = {
            name: props.list.name,
            excerpt: props.list.excerpt,
            description: props.list.description,
            status: props.list.status,
        }
        const form = useForm(
            {
                ...values
            });

        const thumbnailForm = useForm(
            {
                thumbnail: null
            });

        return {form, thumbnailForm}
    },
    methods: {
        changeThumbnail(file) {
            this.thumbnailForm.thumbnail = file;
        },
        update() {
            this.form.patch(route('lists.update', this.list), {
                preserveScroll: true,
                onSuccess: () => {
                    this.updateThumbnail();
                }
            });
        },
        updateThumbnail() {
            if (this.thumbnailForm.thumbnail) {
                this.thumbnailForm.post(route('lists.updateThumbnail', this.list), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.thumbnailPreview = null;
                    }
                });
            }
        }
    },
    watch: {
        'thumbnailForm.thumbnail': function (file) {
            if (file) {
                this.thumbnailPreview = URL.createObjectURL(file);
            }
        },
    }
}
</script>
