<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DateInput from '@/Components/DateInput.vue';

const addContactModalOpenState = ref(false);

const form = useForm({
    fullname: '',
    birthdate: '',
    relation: '',
    address: '',
    phone: '',
    email: '',
});

const closeModal = () => {
    addContactModalOpenState.value = false;
    form.clearErrors();
    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <PrimaryButton @click="addContactModalOpenState = true">Add Contact</PrimaryButton>

        <Modal :show="addContactModalOpenState" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">Add Contact</h2>
                <br>
                <form @submit.prevent="form.post(route('contacts.store'), { onSuccess: () => closeModal() })">
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
                            <select id="relation" v-model="form.relation" class="mt-1 rounded-md w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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

                        <div class="flex justify-end space-x-2">
                            <SecondaryButton @click="addContactModalOpenState = false">Cancel</SecondaryButton>
                            <PrimaryButton>Add Contact</PrimaryButton>
                        </div>
                    </div>
                </form>
            </div>
        </Modal>
    </section>
</template>