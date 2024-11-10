<template>
    <table class="table table-striped">
        <HeaderRow :columns="columns" />
        <BodyRow v-for="row in row_data" :data="row" 
        :current="row_data.indexOf(row)" :total="row_data.length" 
        @move-cell-up="(index) => this.$emit('move-cell-up', index)"
        @move-cell-down="(index) => this.$emit('move-cell-down', index)"/>
    </table>
</template>

<script setup lang="ts">
    import HeaderRow from "./HeaderRow.vue";
    import BodyRow from "./BodyRow.vue";
    import { IRowGroupData } from './TableTypes.types';
    import { defineProps, defineEmits } from 'vue';

    defineProps<{
        columns: Array<string>,
        row_data: Array<IRowGroupData>,
        }>();

    defineEmits<{
        'move-cell-up': [index: number],
        'move-cell-down': [index: number]
    }>();
</script>