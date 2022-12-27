<template>
    <div class="flex items-center">
        <div class="mt-6 w-10 h-10 rounded-full mr-4 mb-4">
            <div>
                <img class="w-10 h-10 rounded-full bg-gray-200 border-2" :src="avatarPreview || avatar" alt="profile_image">
            </div>
        </div>
        <div class="flex items-center relative cursor-pointer rounded-md font-medium text-indigo-600 focus-within:outline-none hover:text-indigo-500">
            <input type="file" @change="uploadAvatarPreview($event.target.files[0])"/>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <button
            type="submit"
            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
            @click.prevent="updateAvatar"
            :disabled="form.processing"
            :class="{'opacity-50 cursor-not-allowed': form.processing}"
        >
            Save avatar
        </button>

        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
            <p v-if="form.recentlySuccessful" class="text-sm text-green-400">Avatar Saved.</p>
        </Transition>
    </div>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    name: "UpdateProfileAvatarForm",
    props: {
        user: {
            type: Object,
            required: true,
        },
        errors: {
            type: Object,
            required: false,
        },
        avatar: {
            type: String,
        }
    },
    data () {
        return {
            status: null,
            avatarPreview: null,
        };
    },
    setup() {
        const form = useForm({
            avatar: null,
        });

        return {
            form
        };
    },
    methods: {
        uploadAvatarPreview(file) {
            this.form.avatar = file;
        },
        updateAvatar() {
            this.form.post(route('avatar.update'), {
                preserveScroll: true,
                preserveState: false,
                onSuccess: () => {
                    this.form.avatar = null;
                },
            });
        },
    },
    watch: {
        'form.avatar': function (file) {
            if (file) {
                this.avatarPreview = URL.createObjectURL(file);
            }
        },
    },
}
</script>
