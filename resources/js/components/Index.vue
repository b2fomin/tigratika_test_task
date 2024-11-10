<template>
    <TableComponent v-if="isMounted" :response="response"
                    @receive-data="getData"/>
</template>

<script setup lang="ts">
    import TableComponent from './Table/Table.vue';
    import { defineEmits, ref } from 'vue';
    import axios from 'axios';

    defineEmits<{
        'receive-data': [order: Array<number>]
    }>();
    const isMounted = ref(false);    
    const response = ref();

    async function getData(order) {
        let params = new URLSearchParams(document.location.search);
        let page = Number(params.get('page'));
        let per_page = Number(params.get('per_page'));
        await axios.get(`./api/v1/group`, {params: {order: order, page: page, per_page: per_page}})
        .then((response_from) => {
            response.value = response_from;
            isMounted.value = true;
        });
    }
    getData(null);
</script>
