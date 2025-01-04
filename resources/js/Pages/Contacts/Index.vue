<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AddContact from './Partials/AddContact.vue';
import { ref } from 'vue';
import dayjs from 'dayjs';
import EditContact from './Partials/EditContact.vue';
import DangerButton from '@/Components/DangerButton.vue';
import ConfirmDeleteContact from './Partials/ConfirmDeleteContact.vue';

defineProps(['contacts']);

const selectedContact = ref(null);
const editContactModalOpenState = ref(false);
const deleteContactModalOpenState = ref(false);

const openEditModal = (contact) => {
    selectedContact.value = contact;
    editContactModalOpenState.value = true;
};

const closeEditModal = () => {
    editContactModalOpenState.value = false;
    selectedContact.value = null;
};

const openDeleteModal = (contact) => {
    selectedContact.value = contact;
    deleteContactModalOpenState.value = true;
};

const closeDeleteModal = () => {
    deleteContactModalOpenState.value = false;
    selectedContact.value = null;   
};

const capitalize = (value) => {
    if (!value) return '';
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
};
</script>

<template>
    <Head title="Contacts" />
    <AuthenticatedLayout>
        <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
            <AddContact />
            <br>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Birthdate</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Relation</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="contact in contacts" :key="contact.id">
                        <td class="px-6 py-4 whitespace-nowrap">{{ contact.fullname }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ dayjs(contact.birthdate).format('DD-MM-YYYY') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ capitalize(contact.relation) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap space-x-2">
                            <PrimaryButton @click="openEditModal(contact)">Edit</PrimaryButton>
                            <DangerButton @click="openDeleteModal(contact)">Delete</DangerButton>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <EditContact :contact="selectedContact" :editContactModalOpenState="editContactModalOpenState" @close="closeEditModal" />
        <ConfirmDeleteContact :contact="selectedContact" :deleteContactModalOpenState="deleteContactModalOpenState" @close="closeDeleteModal" />
    </AuthenticatedLayout>
</template>