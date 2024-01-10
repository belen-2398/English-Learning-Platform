<template>
    <Head title="Profile" />
    <div>
        <div class="short-line">
            <h1 class="pt-5 font-bold">Profile</h1>
            <h2 class="mx-2 text-sm md:text-lg pb-4 uppercase">Manage your account</h2>
        </div>
    </div>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                <UpdateProfileInformationForm :user="$page.props.auth.user" />

                <SectionBorder />
            </div>

            <div v-if="$page.props.jetstream.canUpdatePassword">
                <UpdatePasswordForm class="mt-10 sm:mt-0" />

                <SectionBorder />
            </div>

            <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                <TwoFactorAuthenticationForm :requires-confirmation="confirmsTwoFactorAuthentication"
                    class="mt-10 sm:mt-0" />

                <SectionBorder />
            </div>
            <!-- TODO: fix LogoutOtherBrowserSessionsForm -->
            <!-- <LogoutOtherBrowserSessionsForm :sessions="sessions" class="mt-10 sm:mt-0" /> -->

            <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                <SectionBorder />

                <DeleteUserForm class="mt-10 sm:mt-0" />
            </template>
        </div>
    </div>
</template>
 
<script>
import { Head } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';

export default {
    name: 'Profile',
    components: {
        Head,
    },
    layout: FrontendLayout
}
</script>
<script setup>
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import DeleteUserForm from '@/Pages/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Partials/LogoutOtherBrowserSessionsForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import TwoFactorAuthenticationForm from '@/Pages/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Partials/UpdateProfileInformationForm.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>
