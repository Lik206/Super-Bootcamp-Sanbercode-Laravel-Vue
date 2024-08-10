<template>
    <div class="container mx-auto p-5">
        <h1 class="text-xl font-bold mb-5">Dashboard</h1>
        <section class="mb-24">
            <ListBooks />
        </section>
        <section class="mb-24">
            <ListCategory />
        </section>
        <section class="mb-24">
            <ListRole />
        </section>
        <section class="mb-24">
            <ListBorrows />
        </section>
    </div>
</template>
<script setup>
import ListBooks from './ListBooks.vue';
import ListCategory from './ListCategory.vue';
import ListRole from './ListRole.vue';
import ListBorrows from './ListBorrows.vue';
</script>