<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import DateInput from '@/Components/DateInput.vue';

const props = defineProps({
    contact: {
        type: Object,
    },
});

const form = useForm({
    fullname: props.contact.fullname,
    birthdate: props.contact.birthdate,
    relation: props.contact.relation,
    address: props.contact.address,
    email: props.contact.email ? props.contact.email : '',
    phone: props.contact.phone ? props.contact.phone : '',
});

function submit() {
    form.put(route('contacts.update', props.contact.id));
}

function sendBirthdayNotificationTest() {
    // form.post(route('contacts.sendbirthdaynotification', props.contact));
    // USING router
    router.post('/contacts/sendbirthdaynotification', props.contact, { preserveScroll: true });
}
</script>

<template>

    <Head title="Edit Contact" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Contact
            </h2>
        </template>

        <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="submit">
                <div class="space-y-6">
                    <div>
                        <InputLabel for="fullname">Full Name</InputLabel>
                        <TextInput id="fullname" v-model="form.fullname" class="mt-1 w-full" />
                        <InputError :message="form.errors.fullname" />
                    </div>

                    <div>
                        <InputLabel for="birthdate">Birthdate</InputLabel>
                        <DateInput id="birthdate" v-model="form.birthdate" class="mt-1 w-full" />
                        <InputError :message="form.errors.birthdate" />
                    </div>

                    <div>
                        <InputLabel for="relation">Relation</InputLabel>
                        <select id="relation" v-model="form.relation"
                            class="mt-1 rounded-md w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Relation</option>
                            <option value="wife">Wife</option>
                            <option value="friend">Friend</option>
                            <option value="lecturer">Lecturer</option>
                            <option value="parent">Parent</option>
                        </select>
                        <InputError :message="form.errors.relation" />
                    </div>

                    <div>
                        <InputLabel for="phone">Phone Number</InputLabel>
                        <TextInput id="phone" v-model="form.phone" class="mt-1 w-full" />
                        <InputError :message="form.errors.phone" />
                    </div>

                    <div>
                        <InputLabel for="email">Email</InputLabel>
                        <TextInput id="email" v-model="form.email" class="mt-1 w-full" />
                        <InputError :message="form.errors.email" />
                    </div>

                    <div>
                        <InputLabel for="address">Address</InputLabel>
                        <TextInput id="address" v-model="form.address" class="mt-1 w-full" />
                        <InputError :message="form.errors.address" />
                    </div>

                </div>
                <div class="mt-4 flex justify-end space-x-2">
                    <PrimaryButton type="submit">Save</PrimaryButton>
                    <DangerButton type="button">Cancel</DangerButton>
                    <SecondaryButton type="button" @click="sendBirthdayNotificationTest">Test Send Email</SecondaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>