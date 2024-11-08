<template>
    <TableComponent />
</template>

<script lang="ts">
    interface IRowData {
        name: string,
        amount: int,
        source: string,
        lazer: int,
        welding: int,
        electricity: int
    };

    import TableComponent from './Table.vue';
    export default {
        props: {
            columns: Array<string>,
            row_data: Array<IRowData>
        }
    };
</script>
