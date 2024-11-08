<template>
    <table class="table table-striped">
        <HeaderRow :columns="columns" />
            <BodyRow v-for="row in row_data" :data="row" />
    </table>
</template>

<script setup lang="ts">
    import HeaderRow from "./HeaderRow.vue";
    import BodyRow from "./BodyRow.vue";
    import { IRowData } from './TableTypes.types';
    import { defineProps } from 'vue';

    defineProps<{
        columns: Array<string>,
        row_data: Array<IRowData>
    }>();
</script>