<template>
    <table class="table table-striped">
        <HeaderRow :columns="Object.keys(response['data']['data'][0])" />
        <BodyRow v-for="row in response['data']['data']" :data="row" 
        :current="response['data']['data'].indexOf(row)" :total="response['data']['data'].length" 
        @move-cell-up="onMoveCellUp"
        @move-cell-down="onMoveCellDown"/>
    <footer>
        <Pagination v-model="response['data']['meta']['page']" 
                            :records="response['data']['meta']['total_number']"
                            :perPage="response['data']['meta']['per_page']"
                             @paginate="onPaginate"/>
    </footer>
    </table>
</template>

<script setup lang="ts">
    import HeaderRow from "./HeaderRow.vue";
    import BodyRow from "./BodyRow.vue";
    import Pagination from 'v-pagination-3';
    import { defineProps, defineEmits, ref, Ref } from 'vue';
    import { AxiosResponse } from "axios";

    const props = defineProps<{
        response: AxiosResponse
        }>();

    const emit = defineEmits<{
        'move-cell-up': [index: number],
        'move-cell-down': [index: number],
        'receive-data': [order: Ref]
    }>();
    
    function range(start, end) {
        if(start === end) return [start];
        return [start, ...range(start + 1, end)];
    }

    const base_url: string = window.location.origin;
    const order = ref(range(0, props.response['data']['meta']['per_page'] - 1));

    async function onMoveCellUp(index: number) {
        let tmp = order.value[index];
        order.value[index] = order.value[index + 1];
        order.value[index + 1] = tmp;
        onPaginate();
    }

    async function onMoveCellDown(index: number) {
        let tmp = order.value[index];
        order.value[index] = order.value[index - 1];
        order.value[index - 1] = tmp;
        onPaginate();
    }

    async function onPaginate() {
            let new_url = base_url;
            let response = props.response['data'];

            new_url += '?page=' + response['meta']['page'];
            new_url += '&per_page=' + response['meta']['per_page'];

            window.history.replaceState(document.title, Object(), new_url);

            emit('receive-data', order.value)

    }
</script>